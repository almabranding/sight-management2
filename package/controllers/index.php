<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('index/js/custom.js');
    }
    
    function index() {
        $this->view->footerMenu=true;
        $this->view->package=$this->model->getPackage(PACKAGE_ID);
        $this->view->render('index/index');
    }
    
}