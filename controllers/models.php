<?php
class Models extends Controller {
    function __construct() {
        parent::__construct();
        $this->view->js = array('models/js/masonry.pkgd.min.js','models/js/custom.js');
        $this->view->css = array('models/css/style.css');
        Session::set('LASTHEADSHEET',LANG.PATH);
    }
    
    function index() {
        $this->view->msg = 'This page doesnt exist';
        $this->view->render('error/index');
    }
    public function men($selection=null) {
        $this->view->siteName='Men';
        $this->model->_alphabetic=$this->view->alphabetic=true;
        $where="WHERE sex=2 and public=1 AND category_id!=3 AND category_id!=2 AND category_id!=4";
        $this->model->_where=$where;
        $this->model->_orden="name";
        $this->view->_selection=$this->model->_selection=$selection;
        $this->view->path='/models/men';
        $this->view->modelsGallery=$this->model->getModels();
        $this->model->_where=$where;
        $this->view->modelsSearch=$this->model->getModelsSearch();
        $this->view->render('models/list');
    }
    public function women($selection=null) {
        $this->view->siteName='Women';
        $this->model->_alphabetic=$this->view->alphabetic=true;
        $where="WHERE sex=1 and public=1 AND category_id!=3 AND category_id!=2 AND category_id!=4";
        $this->model->_where=$where;
        $this->model->_orden="name";
        $this->view->_selection=$this->model->_selection=$selection;
        $this->view->path='/models/women';
        $this->view->modelsGallery=$this->model->getModels();
        $this->model->_where=$where;
        $this->view->modelsSearch=$this->model->getModelsSearch();
        $this->view->render('models/list');
    }
    public function development($selection=null) {
        $this->view->siteName='Development '.ucwords($selection);
        $where=(!$selection || $selection=='women')?"WHERE sex=1":"WHERE sex=2";
        $where.=' AND category_id=3';
        $this->model->_where=$where;
        $this->model->_orden="name";
        $this->view->_selection=$this->model->_selection=null;
        $this->view->path='/models/developments/'.$selection;
        $this->view->modelsGallery=$this->model->getModels();
        $this->model->_where=$where;
        $this->view->modelsSearch=$this->model->getModelsSearch();
        $this->view->render('models/list');
    }
    public function special_bookings($selection=null) {
        $this->view->siteName='Special Bookings '.ucwords($selection);
        $where="WHERE ";
        $where.=($selection=='women')?"sex=1 AND":"";
        $where.=($selection=='men')?"sex=2 AND":"";
        $where.=' category_id=2 AND show_in_headsheet=1 and public=1';
        $this->model->_where=$where;
        $this->model->_orden="name";
        $this->view->_selection=$this->model->_selection=null;
        $this->view->linkTo='http://celebrities.sight-management.com/';
        $this->view->linkToText='Visit Special Bookings & Events Blog';
        $this->view->_sectionClass=$this->model->_sectionClass='special';
        switch(LANG){
            case 'ES': $this->view->_flipbook=$this->model->_flipbook="http://files.flipsnack.com/iframe/embed.html?hash=fdkaraya&wmode=transparent&t=13807024621380080226";break;
            case 'EN': $this->view->_flipbook=$this->model->_flipbook="http://files.flipsnack.com/iframe/embed.html?hash=fznlo8ip&wmode=transparent&t=13808504431350665107" ;break;
            case 'CH': $this->view->_flipbook=$this->model->_flipbook="http://files.flipsnack.com/iframe/embed.html?hash=ftia69nh&wmode=transparent&t=13808505531360032793" ;break;
            default: $this->view->_flipbook=$this->model->_flipbook="http://files.flipsnack.com/iframe/embed.html?hash=fznlo8ip&wmode=transparent&t=13808504431350665107" ;break;
        }
        $this->view->path='/models/special_booking/'.$selection;
        $this->view->modelsGallery=$this->model->getModels();
        $this->view->render('models/list');
    }
    public function sports() {
        $this->view->siteName='Sports';
        $where=' WHERE category_id=4 AND show_in_headsheet=1 and public=1';
        $this->model->_where=$where;
        $this->model->_orden="name";
        $this->view->_selection=$this->model->_selection=null;
        
        $this->view->linkTo='http://celebrities.sight-management.com/category/sports'; 
        $this->view->linkToText='Visit Sports Blog';
        $this->view->_sectionClass=$this->model->_sectionClass='special';
        switch(LANG){
            case 'ES': $this->view->_flipbook=$this->model->_flipbook="http://files.flipsnack.com/iframe/embed.html?hash=ftkmwis5&wmode=transparent&t=13808509091380850910";break;
            case 'EN': $this->view->_flipbook=$this->model->_flipbook="http://files.flipsnack.com/iframe/embed.html?hash=ft98bles&wmode=transparent&t=13808513811380851383" ;break;
            case 'CH': $this->view->_flipbook=$this->model->_flipbook="http://files.flipsnack.com/iframe/embed.html?hash=fvk30h1v&wmode=transparent&t=13808510811360032523";break;
            default: $this->view->_flipbook=$this->model->_flipbook="http://files.flipsnack.com/iframe/embed.html?hash=ft98bles&wmode=transparent&t=13808513811380851383";break;
        }
        $this->view->path='/models/sports/';
        $this->view->modelsGallery=$this->model->getModels();
        $this->view->render('models/list');
    }
    function favourites($ids) {
        $this->view->siteName='Favourites';
        $models= explode('-', $ids);
        $this->model->_where=' WHERE (';
        foreach($models as $model)
            $this->model->_where.='m.id='.$model.' OR ';
        $this->model->_where = substr($this->model->_where, 0, -4);
        $this->model->_where.=') ';
        $this->model->_orden="name";
        $this->view->_selection=$this->model->_selection=null;
        $this->view->_sectionClass=$this->model->_sectionClass='favourite';
        $this->view->modelsGallery=$this->model->getModels();
        $this->view->render('models/list');
    }
    
}