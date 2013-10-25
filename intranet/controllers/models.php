<?php

class Models extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('models/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() { 
        header('location: '.URL.LANG.'/models/lista');  
    }
    public function view($id) 
    {
        $this->view->id=$id;
        $this->view->form=$this->model->form('edit',$id);
        $this->view->Gallery=$this->model->getGallery($id);
        $this->view->Files=$this->model->getFiles($id);
        $this->view->render('models/view');  
    }
    public function lista($pag=1) 
    {
        $this->view->js = array('models/js/zebra_form.js','models/js/custom.js');
        $this->view->searchModel=$this->model->searchForm();
        $this->view->models=$this->model->getModels($pag,NUMPP);
        $this->view->pagination=$this->model->getPagination($pag,NUMPP,'models','models/lista');
        $this->view->categories=$this->model->getModelsCategories();
        $this->view->render('models/list');  
    }
     public function addmodel() 
    {
        $this->view->form=$this->model->editModelForm('add');
        $this->view->render('models/editmodels');  
    }
    public function deleteModel($id) 
    {
        $this->view->form=$this->model->deleteModel($id);
        header('location: ' . URL . LANG . '/models/lista');  
    }
    public function editmodel($id) 
    {
        $this->view->model=$this->model->getModel($id);
        $this->view->form=$this->model->editModelForm('edit',$id);
        $this->view->render('models/editmodels');  
    }
    public function editportafolio($id) 
    {
        //$this->view->searchModel=$this->model->searchModel();
        $this->view->id=$id;
        $this->view->model=$this->model->getModel($id);
        $this->view->modelPhotos=$this->model->getModelPhotos($id);
        $this->view->categories=$this->model->getModelsCategories();
        $this->view->render('models/editportafolio');  
    }
    public function composite($id) 
    {
        $this->view->id=$id;
        $this->view->model=$this->model->getModel($id);
        $this->view->composite=$this->model->getComposite($id);
        $this->view->modelPhotos=$this->model->getModelPhotos($id);
        $this->view->render('models/composite');  
    }
    public function resetComposite($id) 
    {
        $this->model->resetComposite($id);
        header('location: ' . URL . LANG . '/models/composite/'.$id);
    }
    public function searchModel() 
    {
        $this->view->searchModel=$this->model->searchForm();
        $this->view->models=$this->model->getModelSearch();
        $this->view->categories=$this->model->getModelsCategories();
        $this->view->render('models/list');  
    }
    public function add() 
    {
       $id=$this->model->add();
       header('location: ' . URL . LANG . '/models/editportafolio/'.$id);
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: ' . URL . LANG . '/models/lista');
    }
    public function delete($id) 
    {
        $this->model->deleteModel($id);
        header('location: ' . URL . LANG .  '/models/lista');
    }
    public function sort() 
    {
        $this->model->sort();
    }
    public function compositeSort(){
        $this->model->compositeSort();
    }
    public function deleteImages() 
    {
        $this->model->deleteImages();
    }
    public function deleteImage($model_id,$id) 
    {
        $this->model->deleteImage($id);
        header('location: ' . URL .LANG . '/models/editportafolio/'.$model_id);  
    }
    public function selectHeadsheet() 
    {
        $this->model->selectHeadsheet();
    }
    
    public function viewImage($id) 
    {
        $this->view->id=$id;
        $this->view->form=$this->model->formImage('edit',$id);
        $this->view->img=$this->model->getImageInfo($id);
        $this->view->model_id=$this->view->img[0]['model_id'];
        $this->view->render('models/viewimage');  
    }
    public function editImage($id) 
    {
        $model=$this->model->editImage($id);
        header('location: ' . URL .LANG . '/models/editportafolio/'.$model);  
    }
    public function saveInputs(){
        $this->model->saveInputs();
    }
    
}