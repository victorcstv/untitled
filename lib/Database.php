<?php

    class Database {
        private static $dbtype = "";
        private static $host = "";
        private static $port = "";
        private static $user = "";
        private static $password = "";
        private static $db = "";

        public function __construct(
            $db_type = type,
            $host = host,
            $port = port,
            $user = user,
            $password = password,
            $db = db){
                self::$dbtype = $db_type;
                self::$host = $host;
                self::$port = $port;
                self::$user = $user;
                self::$password = $password;
                self::$db = $db;
        }

        public function __clone(){}

        public function __destruct(){
            $this->disconnect();
            foreach($this as $key => $value){
                unset($this->$key);
            }
        }

        private function getDBType(){ return self::$dbtype; }
        private function getHost(){ return self::$host; }
        private function getPort(){ return self::$port; }
        private function getUser(){ return self::$user;}
        private function getPassword(){ return self::$password; }
        private function getDB(){ return self::$db; }

        public function connect(){
            try{
                if ($this>getDBType() == 'mysql'){
                    $this->connect = new PDO(
                        $this->getDBType().":host=".
                        $this->getHost().";port=".
                        $this->getPort().";dbname=".
                        $this->getDB(),
                        $this->getUser(),
                        $this->getPassword());
                }
            } catch(PDOException $i) {
                die("Error: <code>" . $i->getMessage() . "</code>");
            }

            return ($this->connect);
        }

        private function disconnect(){
            $this->connect = null;
        }

        public function dbSelect($sql, $params = null){            
            $query = $this->connect()->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $query->execute($params);
            $result = $query;
            
            self::__destruct();
            
            return $result;
        }

        public function dbInsert($sql, $params = null){
            $connect = $this->connect();
            $query = $connect->prepare($sql);
            $query->execute($params);
            
            $result = $connect->lastInsertId();
            
            self::__destruct();
            
            return $result;
        }

        public function dbUpdate($sql, $params = null){
            $query=$this->connect()->prepare($sql);
            $query->execute($params);                        
            $result = $query->rowCount() or die(print_r($query->errorInfo(), true));

            self::__destruct();            
            
            return $result;
        }

        public function dbDelete($sql,$params=null){
            $query=$this->connect()->prepare($sql);
                        
            try{  
                $query->execute($params);
                $result = $query->rowCount(); 
            } catch(Exception $err){
                echo "Erro ao excluir registro!" . $err->getTraceAsString();
            }

            self::__destruct();
            
            $result == array() ? false : $result;
        }

        public function dbSearchData($search){
            return $search->fetch(PDO::FETCH_OBJ);
        }

        public function dbSearchAllData($search){
            return $search->fetchAll(PDO::FETCH_OBJ);
        }

        public function dbSearchArray($search){
            return $search->fetch(PDO::FETCH_ASSOC);
        }
        
        public function dbSearchAllArray($search){
            return $search->fetchall(PDO::FETCH_ASSOC);
        }

        public function dbRowCount($search){
            return $search->rowCount();
        }

        public function dbColumnCount($search){
            return $search->columnCount();
        }

        public function dbResult($search, $return){
            $rowRes = $this->dbSearchMatrix($search);
            
            return $rowRes[$return];
	    }  
    }

?>