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

    public function delete (&$errors = null)
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
            $errors[] = 'Error deleting '.get_called_class();
        }
        return false;
    }   
    
    public function __set($key, $value)
    {
        
        if(array_key_exists($key,$this->schema))
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
}

