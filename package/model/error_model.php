<?php

class Error_Model extends Model {

    public 
            $_orden = 'name', 
            $_where,
            $_selection,
            $_alphabetic,
            $_sectionClass,
            $_flipbook;

    public function __construct() {
        parent::__construct();
    }

    public function getModels() {
        $this->_where.=' AND mp.main=1 AND pm.package_id='.PACKAGE_ID;
        return $this->db->select('SELECT * FROM models m JOIN models_photos mp on(m.id=mp.model_id) join photos p on(mp.photo_id=p.id) JOIN  packed_models pm ON (pm.model_id=m.id)' . $this->_where . ' ORDER by ' . $this->_orden);
    }
    public function getPackage($id) {
        return $this->db->select('SELECT * FROM packages WHERE id='.$id);
    }
    public function getDeliver($id=0) {
        return $this->db->select('SELECT * FROM package_deliveries WHERE id='.$id);
    }
    public function getModel() {
        $model = $this->db->select('SELECT * FROM models WHERE id=' . $this->_idmodel);
        return $model[0];
    }
    public function getModelPhoto() {
        $photos = $this->db->select('SELECT * FROM models_photos a JOIN photos b ON (b.id=a.photo_id) WHERE model_id = :id ORDER BY position', array('id' => $this->_idmodel));
        foreach ($photos as $id=>$value) {
            $photo_id = str_pad($value['photo_id'], 9, "0", STR_PAD_LEFT);
            $folder = str_split($photo_id, 3);
            foreach ($folder as $value) {
                $photos[$id]['rute'].=$value . '/';
            }
            $photos[$id]['rute'].='original/';
        }
        return $photos;
    }

}