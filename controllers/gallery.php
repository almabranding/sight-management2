<?php

class Gallery extends Controller {
    function __construct() {
        parent::__construct();
        $this->view->js = array('gallery/js/modernizr.js','gallery/js/sly.min.js','gallery/js/custom.js');
        $this->view->css = array('gallery/css/style.css');
    }
    
    function index() {
        $this->view->msg = 'This page doesnt exist';
        $this->view->render('error/index');
    }
    public function model($idmodel=null) {
        $model=explode('-',$idmodel);
        $SIU=new SIU();
        $this->model->_idmodel=$model[0];
        $this->view->hasComposite=$this->model->hasComposite($model[0]);
        $this->model->_model=$this->view->model=$this->model->getModel();
        if($this->view->model['category_id']!=2 || $this->view->model['category_id']!=3)$this->view->SIU=true;
        $this->view->siteName=$this->view->model['name'];
        $this->view->siuList=$SIU->getListAttr();
        $this->view->siu=$SIU->getSiu($this->view->model);
        $this->view->modelGallery=$this->model->getModelPhoto();
        $this->view->render('gallery/index');
    }
    public function composite($idmodel=null) {
        $model=explode('-',$idmodel);
        $SIU=new SIU();
        $this->model->_idmodel=$model[0];
        $this->model->_model=$this->view->model=$this->model->getModel();
        if($this->view->model['category_id']!=2 || $this->view->model['category_id']!=3) $this->view->SIU=$this->model->SIU=true;
        $this->model->lang= $this->view->lang;
        $this->view->composite=$this->model->getComposite($model[0]);
    }
    
    
}