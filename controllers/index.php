<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('index/js/froogaloop.min.js','index/js/responsiveslides.min.js','index/js/custom.js');
        //$this->view->js = array('index/js/responsiveslides.min.js','index/js/custom.js');
        $this->view->css = array('index/css/style.css');
    }
    
   function index() {
       $this->model->_where='WHERE pm.section_id = 5';
       $this->model->_limit='';
       $this->view->banner=$this->model->modelsSection();
       $this->model->_where='WHERE pm.section_id = 1';
       $this->model->_limit='LIMIT 0,5';
       $this->view->latest=$this->model->modelsSection();
       $this->model->_where='WHERE pm.section_id = 2';
       $this->model->_limit='LIMIT 0,6';
       $this->view->wanted=$this->model->modelsSection();
       $this->model->_where='WHERE pm.section_id = 3';
       $this->model->_limit='LIMIT 0,1';
       $this->view->vimeo=$this->model->modelsSection();
       $this->model->_where='WHERE pm.section_id = 4';
       $this->model->_limit='LIMIT 0,4';
       $this->view->cover=$this->model->modelsSection();
       $this->view->latestPosts=$this->model->getLatestPosts();
       $this->view->render('index/index');
    }
    
}