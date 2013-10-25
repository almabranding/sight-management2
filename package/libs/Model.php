<?php

class Model {

    public $_menu;
    
    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        
    }
    function endConn() {
        $this->db = null;
    }
    function setLang($lang) {
        $this->lang = $lang;
    }
    function getMenu() {
        $this->menu['model-women']=$this->getCategories(PACKAGE_ID,'category_id=1 AND sex=1');
        $this->menu['model-men']=$this->getCategories(PACKAGE_ID,'category_id=1 AND sex=2');
        $this->menu['special']=$this->getCategories(PACKAGE_ID,'category_id=2');
        $this->menu['special-women']=$this->getCategories(PACKAGE_ID,'category_id=2 AND sex=1');
        $this->menu['special-men']=$this->getCategories(PACKAGE_ID,'category_id=2 AND sex=2');
        $this->menu['sports']=$this->getCategories(PACKAGE_ID,'category_id=4');
        return  $this->menu;
    }
    public function idToRute($id) {
       $id=str_pad($id, 9, "0", STR_PAD_LEFT);
       $folder=str_split($id,3);
       foreach($folder as $value){
           $rute.=$value.'/';
       } 
       return $rute;
    }

    public function getBooker($id){
        $user = $this->db->select('SELECT * FROM users WHERE id=' . $id);
        return $user[0];
    }
    public function checkBook(){
        $data = array(
            'checked' => 1
        );
        $id=PACKAGE_ID;
        $deliver=DELIVER_ID;
        $this->db->update('package_deliveries', $data, 
            "`package_id` = '{$id}' AND `id` = '{$deliver}'");
    }
    public function getModelPhoto() {
        return  $this->db->select('SELECT * FROM models_photos a JOIN photos b ON (b.id=a.photo_id) WHERE model_id = :id  AND a.visibility="public" ORDER BY position', array('id' => $this->_idmodel));
    }
    public function getCategories($id,$where) {
        return $this->db->select('SELECT c.name FROM packed_models pm JOIN models m on(pm.model_id=m.id) JOIN categories c on(c.id=m.category_id) WHERE package_id='.$id.' and '.$where);
    }

}