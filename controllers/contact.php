<?php

class Contact extends Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->view->siteName='Contact';
        $this->view->render('page/contact');
    }
    
    
}