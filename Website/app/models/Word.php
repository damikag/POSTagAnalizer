<?php


class Word extends Model {

    public $_taList=[];
    public static $currentLoggedInUser = null;


    public function __construct() {
        $table = 'WordList';
        parent::__construct($table);

    }

    public function acls() {
        if(empty($this->acl)) return [];
        return json_decode($this->acl,true);
    }

    public function getWords($start_from,$results_per_page){
        $sql = "SELECT * FROM ".$this->_table." ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;

        $results=[];
        $this->query($sql,[]);
        $resultsQuery = $this->_db->results();

        if($resultsQuery){
            foreach($resultsQuery as $result) {

                $obj = new Word();
                $obj->populateObjData($result);
                $results[] =$obj;
            }
        }
//        dnd($results);
        return $results;
    }

    public function getRecordCount(){
        $sql = "SELECT COUNT(ID) AS total FROM ".$this->_table;
        $this->query($sql,[]);
        $resultsQuery = $this->_db->results();
        return $resultsQuery[0]->total;
    }

}