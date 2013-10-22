<?php

class Selection extends Controller {
    function __construct() {
        parent::__construct();
        $this->view->js = array('models/js/masonry.pkgd.min.js','models/js/custom.js');
        $this->view->css = array('models/css/style.css');
        $this->view->SIU=new SIU();
        $this->view->footerMenu=true;
    }
    
    function index() {
        $this->view->js = array('');
        $this->view->css = array('');
        $this->model->checkBook();
        $package=$this->model->getPackage(PACKAGE_ID);
        $this->view->image=$this->model->getPackageImage($package[0]['photo_id']);
        $this->view->render('index/index');
    }
    public function all() {
        $package=$this->model->getPackage(PACKAGE_ID);
        $deliver=$this->model->getDeliver(DELIVER_ID);
        $this->view->title=($deliver[0]['name'])?$deliver[0]['name']:$package[0]['name'];
        $this->model->_where="WHERE sex!=0";
        $this->model->_orden="pm.position";
        $this->view->modelsGallery=$this->model->getModels();
        $this->view->render('models/list');
    }
    public function men() {
        $package=$this->model->getPackage(PACKAGE_ID);
        $deliver=$this->model->getDeliver(DELIVER_ID);
        $this->view->title=($deliver[0]['name'])?$deliver[0]['name']:$package[0]['name'];
        $this->model->_where="WHERE sex=2";
        $this->model->_orden="pm.position";
        $this->view->modelsGallery=$this->model->getModels();
        $this->view->render('models/list');
    }
    public function women() {
        $package=$this->model->getPackage(PACKAGE_ID);
        $deliver=$this->model->getDeliver(DELIVER_ID);
        $this->view->title=($deliver[0]['name'])?$deliver[0]['name']:$package[0]['name'];
        $this->model->_where="WHERE sex=1";
        $this->model->_orden="pm.position";
        $this->view->search=true;
        $this->view->path='/models/women';
        $this->view->modelsGallery=$this->model->getModels();
        $this->view->modelsSearch=$this->model->getModelsSearch();
        $this->view->render('models/list');
    }
    public function special_booking($selection=null) {
        $package=$this->model->getPackage(PACKAGE_ID);
        $deliver=$this->model->getDeliver(DELIVER_ID);
        $this->view->title=($deliver[0]['name'])?$deliver[0]['name']:$package[0]['name'];
        $this->model->_where=(!$selection || $selection=='women')?"WHERE sex=1":"WHERE sex=2";
        $this->model->_where.=' AND category_id=2 AND show_in_headsheet=1 and public=1';
        $this->model->_orden="m.position";
        $this->model->_selection=null;
        $this->view->linkTo='http://celebrities.sight-management.com/';
        $this->view->linkToText='Visit Special Bookinig Blog';
        $this->view->_sectionClass=$this->model->_sectionClass='special';
        $this->view->_flipbook=$this->model->_flipbook='http://files.flipsnack.com/iframe/embed.html?hash=fznlo8ip&wmode=window&bgcolor=EEEEEE&t=1350665108';
        $this->view->path='/models/special_booking/'.$selection;
        $this->view->modelsGallery=$this->model->getModels();
        $this->view->modelsSearch=$this->model->getModelsSearch();
        $this->view->alphabetic=false;
        $this->view->render('models/list');
    }
    public function sports() {
        $package=$this->model->getPackage(PACKAGE_ID);
        $deliver=$this->model->getDeliver(DELIVER_ID);
        $this->view->title=($deliver[0]['name'])?$deliver[0]['name']:$package[0]['name'];
        $this->model->_where=' WHERE category_id=4 AND show_in_headsheet=1 and public=1';
        $this->model->_orden="pm.position";
        $this->model->_selection=null;
        $this->view->_sectionClass=$this->model->_sectionClass='special';
        $this->view->_flipbook=$this->model->_flipbook='http://files.flipsnack.com/iframe/embed.html?hash=fzcjyutv&wmode=window&bgcolor=EEEEEE&t=1350295210';
        $this->view->path='/models/sports/';
        $this->view->modelsGallery=$this->model->getModels();
        $this->view->modelsSearch=$this->model->getModelsSearch();
        $this->view->alphabetic=false;
        $this->view->render('models/list');
    }
    public function model($idmodel=null) {
        $package=$this->model->getPackage(PACKAGE_ID);
        $deliver=$this->model->getDeliver(DELIVER_ID);
        $this->view->modelInfo=$idmodel;
        $this->view->title=($deliver[0]['name'])?$deliver[0]['name']:$package[0]['name'];
        $this->view->js = array('gallery/js/modernizr.js','gallery/js/sly.min.js','gallery/js/custom.js');
        $this->view->css = array('gallery/css/style.css');
        $model=explode('-',$idmodel);
        $this->view->idmodel=$this->model->_idmodel=$model[0];
        $this->view->model=$this->model->getModel();
        $this->view->booker=$this->model->getBooker($package[0]['user_id']);
        $this->view->hasComposite=$this->model->hasComposite($model[0]);
        if($this->view->model['category_id']!=2 || $this->view->model['category_id']!=3)  $this->view->SIU=new SIU();
        $this->view->modelGallery=$this->model->getModelPhoto();
        $this->view->render('gallery/index');
    }
    public function composite($idmodel=null) {
        $model=explode('-',$idmodel);
        $this->model->_idmodel=$model[0];
        $this->model->_model=$this->view->model=$this->model->getModel();
        if($this->view->model['category_id']!=2 || $this->view->model['category_id']!=3) $this->view->SIU=$this->model->SIU=true;
        $this->model->lang= $this->view->lang;
        $this->view->composite=$this->model->getComposite($model[0]);
    }
    public function pdfPhotos($idmodel=null) {
        $model=explode('-',$idmodel);
        $this->model->_idmodel=$model[0];
        $this->model->_model=$this->view->model=$this->model->getModel();
        if($this->view->model['category_id']!=2 || $this->view->model['category_id']!=3) $this->view->SIU=$this->model->SIU=true;
        $this->model->lang= $this->view->lang;
        $this->view->composite=$this->model->getPdfPhotos($model[0]);
    }
    public function PdfFav($idmodel=null) {
        $this->model->lang= $this->view->lang;
        $models=explode('-',$idmodel);
        $this->model->_idmodel=$models;
        $this->view->composite=$this->model->getFavsComposite($this->model->_model);
    }
    public function sentFav($idmodel=null) {
        $this->model->lang= $this->view->lang;
        $models=explode('-',$idmodel);
        $this->model->_idmodel=$models;
        $this->view->composite=$this->model->sentFav($this->model->_model);
        header('location: ' . URL  . PACKAGE.'/'.TYPEBOOKING.'/all');   
    }
    function downloadZip($idmodel) {
        $model=explode('-',$idmodel);
        $this->model->_idmodel=$model[0];
        $this->model->_modelo=$this->model->getModel();
        $this->model->_modelGallery=$this->model->getModelPhoto();
        $this->model->downloadZip();
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