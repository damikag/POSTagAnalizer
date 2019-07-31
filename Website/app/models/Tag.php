<?php


class Tag extends Model {

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

        if($resultsQuery){
            foreach($resultsQuery as $result) {


                $this->_tagList[] =$result->Tag;
            }
        }

    }

    public function getUniqueTags($word){

//        $sql = "SELECT DISTINCT Tag FROM AllWords WHERE Word=?";
        $sql = "SELECT * FROM WordList WHERE Word=?";
        $results=[];
        $this->query($sql,[$word]);
        $resultsQuery = $this->_db->results();

        if($resultsQuery){
            foreach($resultsQuery as $result) {

                $obj = new Word();
                $obj->populateObjData($result);
                $results[] =$obj;
            }
        }
//        dnd($results);
        $res=[];
        foreach ($results as $result){
            $res[]=$result->Tags;
            $res[]=$result->Counts;
        }
//        dnd($res);
        return $res;
    }

    public function getWordTagCount($word,$tag){
        $sql = "SELECT COUNT(ID) AS total FROM AllWords WHERE Word=? AND Tag=?";
        $this->query($sql,[$word,$tag]);
        $resultsQuery = $this->_db->results();
        return $resultsQuery[0]->total;
    }

    public function getTagIDs($word,$tag){

        $sql = "SELECT * FROM AllWords WHERE Word=? AND Tag=?";
        $results=[];
        $this->query($sql,[$word,$tag]);
        $resultsQuery = $this->_db->results();

        if($resultsQuery){
            foreach($resultsQuery as $result) {

                $obj = new Word();
                $obj->populateObjData($result);
                $results[] =$obj;
            }
        }
        $res=[];
        foreach ($results as $result){
            $res[]=[$result->Line_number,$result->Filename];
//            $res[]=[$result->Line_number];
        }

        return $res;
    }

    public function getTagIDsFull($word,$tag){

        $sql = "SELECT * FROM Full WHERE Word=? AND Tag=?";
        $results=[];
        $this->query($sql,[$word,$tag]);
        $resultsQuery = $this->_db->results();

        if($resultsQuery){
            foreach($resultsQuery as $result) {

                $obj = new Word();
                $obj->populateObjData($result);
                $results[] =$obj;
            }
        }
        $res=[];
        foreach ($results as $result){
            $res[]=[$result->Line_number,$result->Filename];
//            $res[]=[$result->Line_number];
        }

        return $res;
    }

    public function getTagList(){
        return $this->_tagList;
    }

    public function  getTagtoWordList($tag){
        $sql = "SELECT DISTINCT Word FROM AllWords WHERE Tag=?";
        $results=[];
        $this->query($sql,[$tag]);
        $resultsQuery = $this->_db->results();

        if($resultsQuery){
            foreach($resultsQuery as $result) {

                $obj = new Tag();
                $obj->populateObjData($result);
                $results[] =$obj;
            }
        }
        $res=[];
        foreach ($results as $result){
            $res[]=$result->Word;
        }

        return $res;
    }

    public function  getTagtoWordListFull($tag){
        $sql = "SELECT DISTINCT Word FROM Full WHERE Tag=?";
        $results=[];
        $this->query($sql,[$tag]);
        $resultsQuery = $this->_db->results();

        if($resultsQuery){
            foreach($resultsQuery as $result) {

                $obj = new Tag();
                $obj->populateObjData($result);
                $results[] =$obj;
            }
        }
        $res=[];
        foreach ($results as $result){
            $res[]=$result->Word;
        }

        return $res;
    }

    public function searchTag($tag){
        $sql = "SELECT DISTINCT Tag FROM AllWords WHERE Tag=? ORDER BY ID ";

        $results=[];
        $this->query($sql,[$tag]);
        $resultsQuery = $this->_db->results();

        if($resultsQuery){
            foreach($resultsQuery as $result) {

//                $obj = new Tag();
//                $obj->populateObjData($result);
                $results[] =$result->Tag;
            }
        }
//        dnd($results);
        return $results;
    }

}