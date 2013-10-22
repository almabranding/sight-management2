<?php
class Controller {

    function __construct() {
        //echo 'Main controller<br />';
        $this->view = new View();
    }
    
    /**
     * 
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name,$control='', $modelPath = 'model/') {
        $path = $modelPath . $name.'_model.php';
        if (file_exists($path)) {
            require $modelPath .$name.'_model.php';
            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }  
        $this->loadLang($name);
        $this->view->menu=$this->model->getMenu();
        
    }
    public function loadLang($name, $langPath = 'lang/EN/') {
        $langPath='../lang/'.LANG.'/';
        $path = $langPath .'default.php';
        if (file_exists($path)) {
            require $path;
        }
        $path = $langPath . $name.'.php';
        if (file_exists($path)) {
            require $path;
        }
        $this->model->setLang(LANG);
        $this->view->lang = $lang;
    }
    public function loadSingleModel($name, $modelPath = 'model/') {
        $path = $modelPath . $name.'_model.php';
        if (file_exists($path)) {
            require $modelPath .$name.'_model.php';
            $modelName = $name . '_Model';
            $model=new $modelName();
            return $model;
        }        
    }

}