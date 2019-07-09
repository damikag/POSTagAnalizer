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

    public function wordAction(){
        $results_per_page = 50;

        if(isset($_POST["search-submit"])){
//            $this->view->render('home/word');
            $word=new Word();
            if (empty($_POST["search_key"])){
                $this->view->searchResults=[];
            }else{
                $this->view->searchResults=$word->searchWord($_POST["search_key"]);
            }


            $this->view->total_pages = 0;

            $this->view->render('home/word');
//            Router::route('home/word');
        }
        else{
            if (isset($_GET["page"])) {
                $page  = $_GET["page"];
            }
            else{
                $page=1;
            };
            $start_from = ($page-1) * $results_per_page;
            $word=new Word();

            $this->view->searchResults=$word->getWords($start_from,$results_per_page);

            $this->view->total_pages = ceil($word->getRecordCount() / $results_per_page);

            $this->view->render('home/word');
        }


    }

    public function loadtagsAction(){
        if(isset($_POST["word"])){
            $tag=new Tag();
            $res=$tag->getUniqueTags($_POST["word"]);
//            dnd($res);
            echo Table::getTagTable($res);
//            $this->view->searchResults=$word->getUniqueTags();
//            dnd("bye");
        }
//        dnd("hey");
    }

    public function loadtagIDsAction(){
//        dnd($_POST);
        if(isset($_POST["word"])and isset($_POST["tag"])){
            $tag=new Tag();
            $res=$tag->getTagIDs($_POST["word"],$_POST["tag"]);
//            dnd($res);
            echo Table::getTagIDTable($res);
//            $this->view->searchResults=$word->getUniqueTags();
//            dnd("bye");
        }
//        dnd("hey");
    }

}

