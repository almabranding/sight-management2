<?php

class Gallery_Model extends Model {

    public $_idmodel;
    public $_model;

    public function __construct() {
        parent::__construct();
    }

    public function getModel() {
        $model = $this->db->select('SELECT * FROM models WHERE id=' . $this->_idmodel);
        return $model[0];
    }

    public function getModelPhoto() {
        return  $this->db->select('SELECT * FROM models_photos a JOIN photos b ON (b.id=a.photo_id) WHERE model_id = :id and visibility="public" ORDER BY position', array('id' => $this->_idmodel));
        
    }
    public function hasComposite(){
        $photos=$this->db->select('SELECT * FROM models_photos a JOIN photos b ON (b.id=a.photo_id) WHERE model_id = :id AND composite_position!=""  ORDER BY composite_position LIMIT 0,4', array('id' => $this->_idmodel));
        if($photos) return true;
        return false;
        
    }
    public function getComposite(){
        $photos=$this->db->select('SELECT * FROM models_photos a JOIN photos b ON (b.id=a.photo_id) WHERE model_id = :id AND composite_position!=""  ORDER BY composite_position LIMIT 0,4', array('id' => $this->_idmodel));
        ob_start();
        require(ROOT.'/pdfTemplate.php');
        $content = ob_get_clean();
        $html2pdf = new HTML2PDF('P','A4','es');
        $html2pdf->WriteHTML($content);
        $aux=($this->_model['name']);
        $name= str_replace(' ','_',$aux);
        $html2pdf->Output('composite_'.$name.'.pdf','d');
        
    }
}