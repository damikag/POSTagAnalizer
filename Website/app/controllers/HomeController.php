<?php

class HomeController extends Controller{
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        
    }

    public function indexAction() {                   //queryParam will be passed into the method 

        $this->view->render('home/index');
    }

    public function allwordsAction(){
        $_db=DB::getInstance();
//        $this->view->searchResults=$_db->query("SELECT * from AllWords",[]);

        $results=[];

        $resultsQuery = $_db->query("SELECT * from AllWords WHERE ID<10",[]);
        $resultsQuery=$resultsQuery->results();
        if($resultsQuery){
//            dnd(($resultsQuery));
            foreach($resultsQuery as $result) {

                $obj = new Model('AllWords');
//                dnd($obj);
                $obj->populateObjData($result);
                $results[] =$obj;
            }
        }
//        dnd($resultsQuery);
        $this->view->searchResults=$results;
//        dnd($this->view->searchResults);
        $this->view->render('home/allwords');
    }

}

