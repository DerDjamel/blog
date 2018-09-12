<?php
class Database {
    private static $DB = null;
    private $result, $query,
            $count = 0, 
            $error = false;
    
    
    
    
    public function __construct(){
        $config = Config::get('database');
        try{
            self::$DB = new PDO(
                'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], 
                $config['username'], 
                $config['password']);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function getPDO(){
        if(isset(self::$DB)){
            return self::$DB;
        }
        self::$DB = new Database();
        return self::$DB;
    }
    
    public function getCount(){
        return $this->count;
    }
    
    
    public function select($table, $col, $where = null, $params = array()){
        $this->error = false;
        $this->query  = 'SELECT '   . $col      . ' ';
        $this->query .= 'FROM '     . $table    . ' ';
        
        if(!is_null($where)) { $this->query .= 'WHERE ' . $where . ' '; }

        if($statement = self::$DB->prepare($this->query)){
            $i = 1;
            if(!empty($params)){ 
                foreach($params as $param){
                    $statement->bindValue($i, $param);
                    $i++;
                }
            } 
        }
        
        
        if($statement->execute()){ 
            $this->result = $statement->fetchAll();
            $this->count  = $statement->rowCount();
            $statement->closeCursor();
        } else {
            $this->error = true;
        }
        return $this->result;
    }
    
    
    public function insert($table, $params = array()){
        $this->error    = false;
        $this->query    = 'INSERT INTO '   . $table     . ' ';
        $this->query   .= 'VALUES (';
        
        if(!empty($params)){ 
            for($i = 0; $i < count($params); $i++){
                $this->query   .= '?,';
            }
        }
        
        $this->query   = substr($this->query, 0, strlen($this->query) - 1);
        $this->query   .= ')';
        
        
        if($statement = self::$DB->prepare($this->query)){
            $i = 1;
            if(!empty($params)){ 
                foreach($params as $param){
                    $statement->bindValue($i, $param);
                    $i++;
                }
            } 
        }

        if($statement->execute()){ 
            $statement->closeCursor();
            echo 'good';
        } else {
            echo 'not good';
            $this->error = true;
        }
    }
    
    
    public function update($table, $col, $where = null, $params = array()){
        $this->error = false;
        $this->query  = 'UPDATE ' .  $table . ' ';
        $this->query .= 'SET ' .  $col . ' ';
        
        if(!is_null($where)) { $this->query .= 'WHERE ' . $where . ' '; }        
        
        if($statement = self::$DB->prepare($this->query)){
            $i = 1;
            if(!empty($params)){ 
                foreach($params as $param){
                    $statement->bindValue($i, $param);
                    $i++;
                }
            } 
        }
        
        
        if($statement->execute()){ 
            $statement->closeCursor();
        } else {
            $this->error = true;
        }
        return $this->error;
    }
    
    public function delete($table, $where = null, $params = array()){
        $this->error = false;
        $this->query  = 'DELETE FROM ' .  $table . ' ';
        if(!is_null($where)) { $this->query .= 'WHERE ' . $where . ' '; } 
        
        echo $this->query;
        
        if($statement = self::$DB->prepare($this->query)){
            $i = 1;
            if(!empty($params)){ 
                foreach($params as $param){
                    $statement->bindValue($i, $param);
                    $i++;
                }
            } 
        }
        
        
        if($statement->execute()){ 
            $statement->closeCursor();
        } else {
            $this->error = true;
        }
        return $this->error;
    }
    
    
    
    
    
}