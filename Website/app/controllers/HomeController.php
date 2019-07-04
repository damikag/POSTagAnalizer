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
        $this->view->searchResults=$_db->query("SELECT * from AllWords",[]);
        dnd($this->view->searchResults);
        $this->view->render('home/allwords');
    }

}

