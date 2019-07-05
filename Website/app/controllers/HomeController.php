<?php

class HomeController extends Controller{
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        
    }

    public function indexAction() {                   //queryParam will be passed into the method 

        $this->view->render('home/index');
    }

    public function allwordsAction(){
        $results_per_page = 50;
        $datatable='AllWords';

        if (isset($_GET["page"])) {
            $page  = $_GET["page"];
        }
        else{
            $page=1;
        };
        $start_from = ($page-1) * $results_per_page;
        $sql = "SELECT * FROM ".$datatable." ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;
        $_db=DB::getInstance();

        $results=[];
        $resultsQuery = $_db->query($sql,[]);
        $resultsQuery=$resultsQuery->results();

        if($resultsQuery){
            foreach($resultsQuery as $result) {

                $obj = new Model('AllWords');
                $obj->populateObjData($result);
                $results[] =$obj;
            }
        }

        $this->view->searchResults=$results;

        $sql = "SELECT COUNT(ID) AS total FROM ".$datatable;
        $resultsQuery = $_db->query($sql,[]);
        $row = $resultsQuery->results();
        $this->view->total_pages = ceil($row[0]->total / $results_per_page);

        $this->view->render('home/allwords');
    }

    public function tagAction() {                   //queryParam will be passed into the method

        $tag=new Tag();
        $this->view->searchResults=$tag->_tagList;
//        dnd($tag->_tagList);
        $this->view->render('home/tag');
    }

}

