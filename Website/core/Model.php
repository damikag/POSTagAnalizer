 <?php

/**
 * $_softdelete attribute is to unable user by a boolean value 
 * without deleting it from the database
 */
class Model {
    protected $_db,
              $_table,
              $_modelName,
              $_softDelete = false,
              $_columnNames = [];
    public $id;

    public function __construct($table) {
        $this->_db = DB::getInstance();
        $this->_table = $table;
        $this->_setTableColumns();
        $this->_modelName = str_replace(' ','', ucwords(str_replace('_',' ',$this->_table)));
    }

    /**
     * populate each column with null
     */
    protected function _setTableColumns() {
        $columns = $this->get_columns();                    //column objects of a table, in each object it contains all the properties such as Field,defult,int/varchar...,type,null,key....etc
        foreach($columns as $column) {
            $columnName = $column->Field;                   //field is the name of a particular column eg: in promotions id,title,pr_username,end_date are those names
            $this->_columnNames[] = $column->Field;
            $this->{$columnName} = null;                    //initially we set them to null then later populate them
        }
    }


    public function get_columns() {
        return $this->_db->get_columns($this->_table);      // get_column is a method in php , since modles dont directly communicate with db this method was created
    }

    /**
     * for each row in a table in the DB find() create a relavant object
     * 
     * eg: from user table find() return a list of objects of
     *     Users for each entry of users in the table
     */
    public function find($params = []) {
        $results = [];
        $resultsQuery = $this->_db->find($this->_table,$params);
        if($resultsQuery){
            foreach($resultsQuery as $result) {
                $obj = new $this->_modelName($this->_table);
                $obj->populateObjData($result);
                $results[] =$obj;
            }
        } 
        return $results;
    }

    public function findFirst($params = []) {
        $resultQuery = $this->_db->findFirst($this->_table,$params);
        $result = new $this->_modelName($this->_table);
        if($resultQuery) {
            $result->populateObjData($resultQuery);
        }
        return $result;        
    }

    public function findById($id) {
        return $this->findFirst(['conditions'=>"id = ?", 'bind'=>[$id]]);
    }

    public function save() {
        $fields = [];
        foreach($this->_columnNames as $column) {
            $fields[$column] = $this->$column;
        }

        //determine whether to update or insert
        if(property_exists($this,'id') && $this->id != '') {
            return $this->update($this->id, $fields);
        } else {
            return $this->insert($fields);
        }
    }

    public function insert($fields) {
        if(empty($fields)) return false;
        return $this->_db->insert($this->_table,$fields);
    }

    public function update($id,$fields) {
        if(empty($fields) || $id == '') return false;
        return $this->_db->update($this->_table, $id, $fields);
    }

    public function delete($id = '') {
        if($id == '' && $this->id == '') return false;
        $id = ($id == '') ? $this->id : $id;
        if ($this->_softDelete) {
            return $this->update($id, ['deleted' => 1]);
        }
        return $this->_db->delete($this->_table, $id);
    }

    public function query($sql, $bind = []) {
        return $this->_db->query($sql,$bind);
    }

    public function data() {
        $data = new stdClass();
        foreach($this->_columnNames as $column) {
            $data->column = $this->column;
        }
        return $data;
    }

    public function assign($params) {
        if(!empty($params)) {
            foreach($params as $key =>$val) {
                if(in_array($key, $this->_columnNames)) {
                    $this->$key = sanitize($val);
                }
            }
            return true;
        }
        return false;
    }

    public function populateObjData($result) {
        foreach($result as $key => $val) {
            $this->$key = $val;
        }
    }

}
