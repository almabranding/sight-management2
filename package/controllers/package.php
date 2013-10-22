<?php

class Package extends Controller {
    function __construct() {
        parent::__construct();
        $this->view->js = array('models/js/masonry.pkgd.min.js','models/js/custom.js');
        $this->view->css = array('models/css/style.css');
    }
    
    function index($selection=null) {
        $package=$this->model->getPackage(PACKAGE_ID);
        $deliver=$this->model->getDeliver(DELIVER_ID);
        $this->view->title=($deliver[0]['name'])?$deliver[0]['name']:$package[0]['name'];
        $this->model->_where="WHERE sex!=0";
        $this->model->_orden="pm.position";
        $this->model->_selection=$selection;
        $this->view->modelsGallery=$this->model->getModels();
        $this->model->checkBook();
        $this->view->render('models/list');
    }
    public function model($idmodel=null) {
        $package=$this->model->getPackage(PACKAGE_ID);
        $deliver=$this->model->getDeliver(DELIVER_ID);
        $this->view->title=($deliver[0]['name'])?$deliver[0]['name']:$package[0]['name'];
        $this->view->js = array('gallery/js/modernizr.js','gallery/js/sly.min.js','gallery/js/custom.js');
        $this->view->css = array('gallery/css/style.css');
        $this->view->modelInfo=$idmodel;
        $model=explode('-',$idmodel);
        $this->model->_idmodel=$model[0];
        $this->view->model=$this->model->getModel();
        $this->view->hasComposite=$this->model->hasComposite($model[0]);
        $this->view->booker=$this->model->getBooker($package[0]['user_id']);
        if($this->view->model['category_id']!=2 || $this->view->model['category_id']!=3)  $this->view->SIU=new SIU();
        $this->view->modelGallery=$this->model->getModelPhoto();
        $this->view->render('gallery/index');   
    }
    function all($selection=null) {
        $package=$this->model->getPackage(PACKAGE_ID);
        $deliver=$this->model->getDeliver(DELIVER_ID);
        $this->view->title=($deliver[0]['name'])?$deliver[0]['name']:$package[0]['name'];
        $this->model->_where="WHERE sex!=0";
        $this->model->_orden="m.position";
        $this->model->_selection=$selection;
        $this->view->modelsGallery=$this->model->getModels();
        $this->view->render('models/list');
    }
    function favourites($ids) {
        $package=$this->model->getPackage(PACKAGE_ID);
        $deliver=$this->model->getDeliver(DELIVER_ID);
        $this->view->title=($deliver[0]['name'])?$deliver[0]['name']:$package[0]['name'];
        $this->view->ids=$ids;
        $models= explode('-', $ids);
        $this->model->_where=' WHERE (';
        foreach($models as $model)
            $this->model->_where.='m.id='.$model.' OR ';
        $this->model->_where = substr($this->model->_where, 0, -4);
        $this->model->_where.=') ';
        $this->model->_orden="name";
        $this->model->_selection=null;
        $this->view->_sectionClass=$this->model->_sectionClass='favourite';
        $this->view->modelsGallery=$this->model->getModels();
        $this->view->isFav=true;
        $this->view->booker=$this->model->getBooker($package[0]['user_id']);
        $this->view->render('models/list');
    }
    
    
}