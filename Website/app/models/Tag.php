<?php


class Tag extends Model {
    private $_isLoggedIn,
        $_sessionName,
        $_cookieName;

    public $_tagList=[];
    public static $currentLoggedInUser = null;


    public function __construct() {
        $table = 'Tags';
        parent::__construct($table);
        $this->createTagList();
    }

    public function acls() {
        if(empty($this->acl)) return [];
        return json_decode($this->acl,true);
    }

    private function createTagList(){
        $sql="SELECT * FROM ".$this->_table;
        $resultsQuery = $this->_db->query($sql,[]);
        $resultsQuery=$resultsQuery->results();
//        dnd($resultsQuery);
        if($resultsQuery){
            foreach($resultsQuery as $result) {


                $this->_tagList[] =$result->Tag;
            }
        }
//        dnd($results);
    }

}