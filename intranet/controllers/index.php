<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        if(Session::get('loggedIn')) header('location: '.URL.LANG.'/models');
    }
    
    function index() {
        $this->view->render('login/index',true);
    }
    
    function details() {
        $this->view->render('index/index');
    }
    
}