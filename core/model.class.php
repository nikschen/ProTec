<?php


namespace protec\core;

abstract class Model 
{
    const TYPE_STRING   = 'string';
    const TYPE_INT      = 'int';
    const TYPE_DECIMAL  = 'dec';
    const TYPE_DATE     = 'date';
    const TYPE_BOOL     = 'bool';
    const TYPE_ENUM     = 'enum';
    
    protected $scheme = [];
    protected $data=[];//geändert von Protected auf private im Rahmen der Fehlersuche

    private $values = [];
    
    public static function tablename()
    {
        $class = get_called_class();
        if(defined($class.'::TABLENAME'))
        {
            return $class::TABLENAME;
        }
        return null;
    }
    
    public function __construct($values)
    {
        try
        {
            foreach($this->scheme as $key => $value)
            {
                if(isset($values[$key]))
                {
                    $this->$key = $values[$key];
                }
                else
                {
                    $this->$key = null;
                }
            }
            
        }
        catch(\Exception $error)
        {
            print_r($error);
            exit(1);
        }
    }

    public function __destruct()
    {
        foreach ($this->scheme as $key => $value)
        {
            if(isset($values[$key]))
            {
                $this->{$key}=null;
            }
        }
    }

    public static function find($where='1')
    {
        
        
        $db = $GLOBALS['db'];
        $sqlStr = 'SELECT * FROM `'.self::tablename().'` WHERE '.$where.';';
        $results = [];
        try
        {
            echo "SQL STATEMENT:       " .$sqlStr;
            $results = $db->query($sqlStr)->fetchAll();
            $count = count($results);
            for ($i=0; $i < $count; ++$i)
            { 
                $class = get_called_class();
                $results[$i] = new $class($results[$i]);
            }
        }
        catch(\PDOException $error)
        {
            print_r($error);
        }

        return $results;
        
    }

    public static function findOne($where='1')
    {
        
        $results = self::find($where);

        if(count($results) > 0)
        {
            return $results[0];
        }

        return null;
        
    }

    public function delete (&$occuringErrors = null)
    {
        $db=$GLOBALS['db'];

        try
        {
            $nameOfIDAttribute= lcfirst(self::tablename());  //name of the table, but with lower case on first letter
            $sql = 'DELETE FROM '. self::tablename() . ' WHERE ' . $nameOfIDAttribute . ' = ' . $this->ID;
            $db->exec($sql);
            return true;
        }
        catch (\PDOException $e)
        {
            $occuringErrors[] = 'Error deleting '.get_called_class();
        }
        return false;
    }   
    
    public function __set($key, $value)
    {
        /*echo "KEY: ";
        echo "<pre>";
        echo $key;
        echo "</pre>";
        echo "VALUES: ";
        echo "<pre>";
        echo $value;
        echo "</pre>";*/
        
        if(isset($this->scheme[$key]))
        {
            $this->values[$key] = $value;
        }
        else
        {
            $className = get_called_class();
            throw new \Exception(`${key} does not exist in this class ${className}`);
        }
    }

    public function __get($key)
    {
    
        if(isset($this->scheme[$key]))
        {
            return $this->values[$key];
        }
        else
        {
            $className = get_called_class();
            throw new \Exception(`${key} does not exists in this class ${className}`);
        }
    }


    public function validate(&$occuringErrors = null)
    {
       foreach ($this->scheme as $key => $schemeOptions)
       {
           if(isset($this->data[$key]) && is_array($schemeOptions))
           {
               $valueErrors = $this->validateValue($key, $this->data[$key], $schemeOptions);

               if($valueErrors !==true)
               {
                   array_push($occuringErrors, ...$valueErrors);
               }
           }
       }

       if(count($occuringErrors)===0)
       {
           return true;
       }
       else
       {
           return false;
       }
    }

    protected function validateValue($attribute,&$value, &$schemeOptions)
    {
        $type = $schemeOptions['type'];
        $ValidEnums= $schemeOptions['values'];
        $occuringErrors = [];

        switch ($type)
        {
           case Model::TYPE_STRING:
           {
               if(isset($schemeOptions['min']) && mb_strlen($value) < $schemeOptions['min'])
               {
                   $occuringErrors[]=$attribute.': String needs min. '. $schemeOptions['min']. ' characters!';
               }
               if(isset($schemeOptions['max']) && mb_strlen($value) < $schemeOptions['max'])
               {
                   $occuringErrors[]=$attribute.': String can have max. '. $schemeOptions['max']. ' characters!';
               }
           }
           break;
           case Model::TYPE_INT:
           break;
           case Model::TYPE_DECIMAL:
               {
                   if(!is_float($value)) {$occuringErrors[] =$attribute.': decimal must be in  (X.Y) format!';}
                   if(isset($schemeOptions['min']) && $value < $schemeOptions['min'])
                   {
                       $occuringErrors[]=$attribute.': Value must be greater than or equal to' . $schemeOptions['min'] . '!';
                   }
                   if(isset($schemeOptions['max']) && $value < $schemeOptions['max'])
                   {
                       $occuringErrors[]=$attribute.': Value must be less than or equal to' . $schemeOptions['min'] . '!';
                   }
               }
           break;
           case Model::TYPE_DATE:
           break;
           case Model::TYPE_BOOL:
               {
                   if (!($value || !$value)) {$occuringErrors[] =$attribute.': Booleans must be either true or false!';}
               }
           break;
           case Model::TYPE_ENUM:
               {
                   if(!in_array($value,$ValidEnums)) {$occuringErrors[] =$attribute.': This Value is not valid for this attribute';}
               }
           break;
        }

        return count($occuringErrors) <0 ? $occuringErrors : true;
    }

    public function insert()
    {
        
             // TODO: Implement insert
             $db = $GLOBALS['db'];
             $tableName = self::tablename();
             $sqlStr = "INSERT INTO `${tableName}` (";
             $valuesStr = "(";
             foreach($this->scheme as $key => $value)
             {
                 $sqlStr.=$key.',';
                 $valuesStr.=':'.$key.',';
             }
     
             $sqlStr = rtrim($sqlStr, ',');
             $valuesStr = rtrim($valuesStr, ',');
     
             $sqlStr = $sqlStr.') VALUES '.$valuesStr.');';
             echo "EINFÜGEN BEFEHL: " . $sqlStr;
     
             try
             {
                 $stmt=$db->prepare($sqlStr);
                 $stmt->execute($this->values);
                 $this->id = $db->lastInsertId();
             }
             catch(\PDOException $e)
             {
                 print_r($e);
             }
    }








    
    public function update ($values) //takes values of an array with entries in scheme "AttributeToBeChanged=Value" and converts them into string in scheme: "Attribute=Value, Attribute=Value, Attribute=Value, ..."
     {
        $db=$GLOBALS['db'];
        $valueList=implode(',', $values);
        
        try
        {
            $sql = 'UPDATE ' . self::tablename() . ' SET ' . $valueList . 'WHERE id = ' . $this->data['id'];
            
            $statement = $db->prepare($sql);
            $statement->execute();

            return true;
        }
        catch(\PDOException $e)
        {
            $errors[]='Error updating '.get_called_class();

        }
        return false;
     }

    //TODO: Secure Update and Insert Methods
}

