<?php

/**
 * Depending on action there are different views for a page
 * eg: Home page will differ according to the user loged in 
 *      - normal user view 
 *      - promoter view
 *      - admin view
 * 
 * In the view folder, every page has a seperate folder with different files for different views
 * 
 * in any file in view folder $this is referred to the view class
 */

class View {
    protected $_head,
              $_body,
              $_siteTitle  = SITE_TITLE,
              $_outputBuffer,
              $_layout = DEFAULT_LAYOUT;
    public $diplayErrors,
           $searchResults,
           $currentUser;
    

    public function __construct() {
        // $this->_layout = DEFAULT_LAYOUT;
        // $this->_siteTitle = SITE_TITLE;
    }

    public function render($viewName) {
        $viewAry = explode('/',$viewName);
        $viewString = implode(DS , $viewAry);
       
        if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $viewString .'.php')) {
            
            include(ROOT . DS . 'app' . DS . 'views' . DS . $viewString .'.php');
            include(ROOT . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->_layout .'.php'); 
        
        } else {
            die('The view \"' . $viewName . '\" does not exist.');
        }
    }

    public function content($type) {
        if ($type == 'head') {
            return $this->_head;
        } elseif($type == 'body') {
            return $this->_body;
        }
        return false;
    }

    public function start($type) {
        $this->_outputBuffer =$type;
        ob_start();                                     //start the outputBuffer 
    }

    /**
     * This method render all the data in the buffer
     * clean them
     * output them 
     */
    public function end() {
        if($this->_outputBuffer == 'head') {
            $this->_head = ob_get_clean();
        } elseif($this->_outputBuffer == 'body') {
            $this->_body = ob_get_clean();
        } else {
            die('You must first run the start method.');
        }
    }

    public function siteTitle() {
        return $this->_siteTitle; 
    }

    public function setSiteTitle($title) {
        $this->_siteTitle = $title;
    }

    public function setLayout($layout) {
        $this->_layout = $layout;
    }

}