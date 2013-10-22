<?php

class Form extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('index/js/contact.js', 'index/js/jquery.ez-bg-resize.js');
    }
    function index() {
    }
    function contact() {
        $this->model->contact();
        header("location:".URL."page/view/contact");
    }
    function register() {
        $this->model->register();
        header("location:".URL);
    }
    
}