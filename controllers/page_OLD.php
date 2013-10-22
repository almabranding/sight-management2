<?php

class Page extends Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->view->msg = 'This page doesnt exist';
        $this->view->render('error/index');
    }
    public function contact() {
        $this->view->render('page/contact');
    }
    
    
}