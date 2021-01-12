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
    protected $data=[];

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
        foreach ($this->scheme as $key => $value)
        {
            if(isset($values[$key]))
            {
                $this->{$key}=$values[$key];
            }
            else
            {
                $this->{$key}=null;
            }
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

    public static function find($where='')
    {
        
        
        $db=$GLOBALS['db'];
        $results=null;
        
        try 
        {
            $sql='SELECT * FROM ' . self::tablename();
            
            if(!empty($where))
            {
                $sql .= ' WHERE ' . $where . ';';
            }

            $results=$db->query($sql)->fetchAll();;
        }
        catch(\PDOException $e)
        {
            die('Select statement failed: ' . $e->getMessage());
        }
        return $results;
        
    }

    public static function findOne($where='')
    {
        
        $db=$GLOBALS['db'];
        $result=null;

        try 
        {
            $sql='SELECT * FROM ' . self::tablename();
            
            if(!empty($where))
            {
                $sql .= ' WHERE ' . $where . ';';
            }

            $result=$db->query($sql)->fetchAll();;
            if(count($result)>1)
            {
                $result = $result[0];
            }
        
        }
        catch(\PDOException $e)
        {
            die('Select statement failed: ' . $e->getMessage());
        }
        return $result;
        
    }

    public function delete (&$occuringErrors = null)
    {
        $db=$GLOBALS['db'];

        try
        {
            $nameOfIDAttribute= lcfirst(self::tablename().toString());  //name of the table, but with lower case on first letter
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
        
        if(array_key_exists($key,$this->scheme))
        {
            $this->data[$key] = $value;
            return;
        }
        throw new \Exception('You can not write to property "'.$key.'"" for the class "'.get_called_class());
    }

    public function __get($key)
    {
    
        if(array_key_exists($key,$this->data))
        {
            return $this->data[$key];
        }
        throw new \Exception('You can not access to property "'.$key.'"" for the class "'.get_called_class());
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

    public function insert($values, $toBeChanged)
    {
        
        $db=$GLOBALS['db'];
        $columnList='(`';
        $columnList.=implode('`, `', $toBeChanged); //takes values of an array and converts them into string in scheme: "attribute, attribute, attribute, ..."
        $valueList=implode(', ', $values); //takes values of an array and converts them into string in scheme: "Value, Value, Value, ..."
        $columnList.='`)';

//        foreach($this->scheme as $key =>$schemeOptions)
//        {
//            $columnList .= '`'.$key.'`,';
//        }

        $columnList=trim($columnList,',');

        try 
        {
            $sql='INSERT INTO ' . self::tablename() . $columnList . 'VALUES (' . $valueList . ')';
            $statement = $db->prepare($sql);
            $statement->execute();
            
            return true;

        }
        catch(\PDOException $e)
        {
            $errors[]='Error inserting '.get_called_class();
        }
        return false;
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

