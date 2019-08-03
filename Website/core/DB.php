<?php


class DB {
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0,
            $_lastInsertID = null;


    private function __construct() {
        try{
            $conn = new PDO("mysql:host=".DB_HOST, DB_USER, DB_PASSWORD);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn>exec("set names utf8");

            $sql="CREATE DATABASE IF NOT EXISTS ".DB_NAME." CHARACTER SET utf8 COLLATE utf8_bin;";



            $result=$conn->exec($sql);
            $sql="CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`AllWords` ( `ID` INT(255) NOT NULL AUTO_INCREMENT ,  `Word` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,  `Tag` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,  `Line_number` INT(255) NOT NULL ,  `Filename` VARCHAR(500) NOT NULL ,    PRIMARY KEY  (`ID`)) ENGINE = InnoDB;";
            $result=$conn->exec($sql);

            $sql="CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`Tags` ( `Tag` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,    PRIMARY KEY  (`Tag`)) ENGINE = InnoDB;";
            $result=$conn->exec($sql);

            $sql="CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`WordList` ( `ID` INT(255) NOT NULL AUTO_INCREMENT ,  `Word` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,  `Tags` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,  `Counts` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,    PRIMARY KEY  (`ID`)) ENGINE = InnoDB;";
            $result=$conn->exec($sql);

            $sql="CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`Full` ( `ID` INT(255) NOT NULL AUTO_INCREMENT ,  `Word` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,  `Tag` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,  `Line_number` INT(255) NOT NULL ,  `Filename` VARCHAR(500) NOT NULL ,    PRIMARY KEY  (`ID`)) ENGINE = InnoDB;";
            $result=$conn->exec($sql);

        }catch (PDOException $e){
            die($e->getMessage());
        }
        try {
            $this->_pdo = new PDO('mysql:host=' .DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->_pdo->exec("set names utf8");
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance(){
        if(!isset(self::$_instance)) {
            self::$_instance = new DB();
        } 
        return self::$_instance;
    }   

    public function query($sql, $params = array()){
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){                 // check wether the query prepared correctly
            $x = 1;
            if(count($params)){                                         // checking for param.
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);               // Assigning value to the ?
                    $x++;
                }
            }

            if($this->_query->execute()){                                   // checking whether query executed successfully
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ); //fetching data as object
                $this->_count = $this->_query->rowCount();
                $this->_lastInsertID = $this->_pdo->lastInsertId();
            }
            else{
                $this->_error = true;
            }

        }

        return $this;
    }


    public function insert($table, $fields = array()){                   
        if(count($fields)){
            $keys = array_keys($fields);
            $values = '';
            $x = 1;

            foreach ($fields as $field){                                                        
                $values .= "?";
                if ($x <count($fields)){
                    $values .= ', ';
                }
                $x++;
            }

            //backtickes to define the fields / not nessasary 
            $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values}) ";
            if(!$this->query($sql, $fields)->error()) {
                return true;
            }

        }
        return false;
    }

    protected function _read($table, $params= array()) {
        $conditionString = '';
        $bind = []; 
        $order = '';  
        $limit = '';

        //conditions
        if(isset($params['conditions'])) {
            if(is_array($params['conditions'])) {
                foreach($params['conditions'] as $condition) {
                    $conditionString .= ' ' . $condition . ' AND';
                }
                $conditionString = trim($conditionString);
                $conditionString = rtrim($conditionString, ' AND');
            } else {
                $conditionString = $params['conditions'];
            }
            if($conditionString != '') {
                $conditionString = ' WHERE ' . $conditionString;
            }
        }
        
        //bind
        if(array_key_exists('bind', $params)) {
            $bind = $params['bind'];
        }
        //order
        if(array_key_exists('order', $params)) {
            $limit = ' ORDER BY ' . $params['order'];
        }
        //limit
        if(array_key_exists('limit', $params)) {
            $limit = ' LIMIT ' . $params['limit'];
        }
        $sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
        // test($sql);
        if($this->query($sql,$bind)) {
            if(!$this->count()) return false;
            return true;
        }
        return false;

    }
    
    public function find($table, $params = array()) {
        if($this->_read($table,$params)) {
            return $this->results();
        }
        return false;
    }

    public function findFirst($table, $params = array()) {
        if($this->_read($table,$params)) {
            return $this->first();
        }
        return false; 
    }


    public function update($table, $id, $fields = array()) {
        $fieldString = '';
        $values = array();

        foreach($fields as $field => $value) {
            $fieldString .= ' ' . $field . ' = ?,';
            $values[] = $value;
        }
        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString,',');
        $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
        // dnd($sql);
        // dnd($values);
        if(!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM {$table} WHERE id = {$id}";
        if(!$this->query($sql)->error()) {
            return true;
        }
        return false;
    }

    public function results() {
        return $this->_results;
    }

    public function error(){
        return $this->_error;
    }

    public function count() {
        return $this->_count;
    }

    public function lastID() {
        return $this->_lastInsertID;
    }

    public function first() {
        return (!empty($this->_results)) ? $this->_results[0] : [];
    }

    public function get_columns($table) {
        return $this->query("SHOW COLUMNS FROM {$table}")->results();
    
    }


    public static function reloadDB()
    {
        try {
            $conn = new PDO('mysql:host=' .DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::MYSQL_ATTR_LOCAL_INFILE,true);
            $conn->exec("set names utf8");
            
            $sql="TRUNCATE TABLE `AllWords`";
            $result = $conn->exec($sql);

            $sql="TRUNCATE TABLE `Tags`";
            $result = $conn->exec($sql);

            $sql="TRUNCATE TABLE `WordList`";
            $result = $conn->exec($sql);

            $sql="TRUNCATE TABLE `Full`";
            $result = $conn->exec($sql);
            
            $sql="LOAD DATA INFILE '".ROOT.DS."newCorpus.txt' INTO TABLE AllWords FIELDS TERMINATED BY ' ' LINES TERMINATED BY '\n' (Word,Tag,Line_number,Filename);";
            $sql=str_replace("\\","\\\\",$sql);
            $result = $conn->exec($sql);
            
            $sql="INSERT INTO Tags SELECT DISTINCT Tag FROM AllWords;";
            $result = $conn->exec($sql);

            $sql="LOAD DATA INFILE '".ROOT.DS."uniqueWords.txt' INTO TABLE WordList FIELDS TERMINATED BY ' ' LINES TERMINATED BY '\n' (Word,Tags,Counts);
";
            $sql=str_replace("\\","\\\\",$sql);
            $result = $conn->exec($sql);

            $sql="LOAD DATA INFILE '".ROOT.DS."SortedCorpus.txt' INTO TABLE Full FIELDS TERMINATED BY ' ' LINES TERMINATED BY '\n' (Word,Tag,Line_number,Filename);";
            $sql=str_replace("\\","\\\\",$sql);
            $result = $conn->exec($sql);


            return true;
        } catch (PDOException $e) {
            return false;
            die($e->getMessage());
        }

    }

}

















