<?php

class RestrictedController extends Controller {
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        
    }

    public function indexAction() {                   //queryParam will be passed into the method 
        $this->view->render('restricted/index');
    }
}