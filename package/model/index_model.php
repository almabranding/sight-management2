<?php
class Index_Model extends Model {
    public function __construct() {
        parent::__construct();
    }
    public function getPackage($id) {
        return $this->db->select('SELECT * FROM packages WHERE id='.$id);
    }
}