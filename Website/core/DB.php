<?php

    /* 
    **********query($sql, $params = array()) *********************************
    $sql could be of any form
    if we use a ? to bind value these binding value must be inserted 
    as an array in the respective order

    **********insert(($table, $fields = array()) *****************************
    
    Use when we want to insert something

    $user = DB::getInstance()->insert('users', array(
        'username' => 'Dale',
        'password' => 'password',
        'salt' => 'salt',
    ));
    would resuult in

    INSERT INTO users (`username`, `password`, `salt`) VALUES ('Dale', 'password', 'salt');

    * the for loop creates the ()

    ***********update($table, $id, $fields = array()) ***************************

    When we need to update a specific data in a table

    $user = DB::getInstance()->update('users',3,array(
    'username' => 'ruchin',
    'password' => 'newpassword',
    'name' => 'ruchin Barrett'
    ));

    this would result in

    UPDATE users SET username = 'ruchin', password = 'newpassword', name = 'ruchin Barrett' WHERE id = 3

    $fieldString will get a string like (" fname =?, lname =?, address =?")

    ***********find($table,$params=array()) **************************************

    when we need to find a particular details 

    $contact =DB::getInstance()->find('contacts', [
            'conditions' => ['lname => ?', 'fname => ?' ],
            'bind' => ['Subasinghe'],
            'order' => "lname,fname",
            'limit' => 5
        ]);

    */ 


class DB {
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0,
            $_lastInsertID = null;


    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host=' .DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
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
//                dnd($this);
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

    

}

















