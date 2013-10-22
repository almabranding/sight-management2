<?php
class Packages_Model extends Model {
    public $packageId,$modelId;
    public function __construct() {
        parent::__construct();
    } 
    
    public function getPackage($id){
         $pack=$this->db->select('SELECT * FROM packages WHERE id='.$this->packageId);  
         return $pack[0];
    }
    public function getModel($id){
         $mod=$this->db->select('SELECT * FROM models WHERE id='.$id);  
         return $mod[0];
    }
    public function getModelsPackage($id){
        $models=$this->db->select('SELECT * FROM packed_models WHERE package_id = :id order by position', 
            array('id' => $this->packageId));
        $modelInfo=array();
        foreach($models as $key => $value) {
            $model=$this->getModel($value['model_id']);
            $photo=$this->getModelPhoto($model['id']);
            $modelInfo[]=
                array(
                    'photo'     =>$photo[0],
                    'id'        =>$model['id'],
                    'name'      =>$model['name'],
                    );
        }
        return $modelInfo;
    }
    public function getNModels($id){
         $nModels=$this->db->select('SELECT COUNT(*) as nModels FROM packed_models WHERE package_id = :id', 
            array('id' => $this->packageId));
         return $nModels[0]['nModels'];
    }
    public function getModelPhoto($id){
        $thumb=$this->db->select('SELECT * FROM models_photos WHERE model_id = :id ORDER BY position', 
            array('id' => $id));
        return $thumb;
    }
}