<?php

class Packages extends Controller {
    function __construct() {
        parent::__construct();
        
        $this->view->js = array('models/js/masonry.pkgd.min.js','packages/js/custom.js');
        $this->view->css = array('packages/css/style.css');
    }
    
    function index() {
        $this->view->msg = 'This page doesnt exist';
        $this->view->render('error/index');
    }
    public function view($package) {
        $this->view->packageId=$package;
        $this->model->packageId=$package;
        $this->view->package=$this->model->getPackage($package);
        $this->view->modelsPackage=$this->model->getModelsPackage($package);
        $this->view->render('head',true);
        $this->view->render('headerPackage',true);
        $this->view->render('packages/package',true);
        $this->view->render('footerPackage',true);
    }
    public function model($package,$model) {
        $package=explode('-',$package);
        $model=explode('-',$model);
        $this->model->packageId=$package[0];
        $this->model->modelId=$model[0];
        $this->view->packageId=$package[0];
        $this->view->model=$this->model->getModel($this->model->modelId);
        $this->view->modelPhotos=$this->model->getModelPhoto($this->model->modelId);
        $this->view->render('head',true);
        $this->view->render('headerPackage',true);
        $this->view->render('packages/model',true);
        $this->view->render('footerPackage',true);
        
    }
   
    
}