<?php

class Selection_Model extends Model {

    public 
            $_orden, 
            $_where,
            $_selection,
            $_alphabetic,
            $_sectionClass,
            $_modelo,
            $__modelGallery,
            $_flipbook;

    public function __construct() {
        parent::__construct();
    }

    public function getModels() {
        $this->_where.=' AND mp.main=1 AND pm.package_id='.PACKAGE_ID;
        return $this->db->select('SELECT * FROM models m JOIN models_photos mp on(m.id=mp.model_id) join photos p on(mp.photo_id=p.id) JOIN  packed_models pm ON (pm.model_id=m.id)' . $this->_where . ' ORDER by ' . $this->_orden);
    }

    public function getModelsSearch() {
        $models = $this->db->select('SELECT * FROM models ' . $this->_where . ' ORDER by ' . $this->_orden);
        $modelSearch = array();
        foreach ($models as $key => $model) {
            $modelSearch[] =
                    array(
                        'value' => '/model/' . $model['id'] . '-' . $model['name'],
                        'label' => $model['name'],
            );
        }
        return $modelSearch;
    }
    public function getModelThumb($id) {
       $photo=$this->db->select('SELECT * FROM models_photos a jOIN photos b ON (b.id=a.photo_id) WHERE a.model_id=:id and main=1;', array('id' => $id));
       $photo=$photo[0];
       $id=str_pad($photo['photo_id'], 9, "0", STR_PAD_LEFT);
       $folder=str_split($id,3);
       foreach($folder as $value){
           $photo['rute'].=$value.'/';
       }
       $photo['rute'].='original/';
       return $photo;
    }
    public function getModel() {
        $model = $this->db->select('SELECT * FROM models WHERE id=' . $this->_idmodel);
        return $model[0];
    }
    public function getPackage($id) {
        return $this->db->select('SELECT * FROM packages WHERE id='.$id);
    }
    public function getDeliver($id=0) {
        return $this->db->select('SELECT * FROM package_deliveries WHERE id='.$id);
    }
    public function getPackageImage($id){
        return $this->db->select('SELECT * FROM photos WHERE id='.$id);
    }
    public function downloadZip(){
        $zipname = $this->_modelo['name'].'.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($this->_modelGallery as $key=>$value) {
          $zip->addFile('../uploads/models/'.$this->idToRute($value['photo_id']).$value['file_file_name'],$this->_modelo['name'].'_'.$key.'.jpg');
        }
        $zip->close();
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename="'.$zipname.'"');
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
    }
     public function hasComposite(){
        $photos=$this->db->select('SELECT * FROM models_photos a JOIN photos b ON (b.id=a.photo_id) WHERE model_id = :id AND composite_position!=""  ORDER BY composite_position LIMIT 0,4', array('id' => $this->_idmodel));
        if($photos) return true;
        return false;
        
    }
     public function getComposite(){
        $photos=$this->db->select('SELECT * FROM models_photos a JOIN photos b ON (b.id=a.photo_id) WHERE model_id = :id AND composite_position!=""  ORDER BY composite_position LIMIT 0,4', array('id' => $this->_idmodel));
        ob_start();
        require(ROOT.'../libs/html2pdf/html2pdf.class.php');
        require(ROOT.'../pdfTemplate.php');
        $content = ob_get_clean();
        $html2pdf = new HTML2PDF('P','A4','es');
        $html2pdf->WriteHTML($content);
        $aux=($this->_model['name']);
        $name= str_replace(' ','_',$aux);
        $html2pdf->Output('composite_'.$name.'.pdf');
        
    }
    public function getPdfPhotos(){
        $photos=$this->getModelPhoto();
        ob_start();
        require(ROOT.'../libs/html2pdf/html2pdf.class.php');
        require(ROOT.'../pdfPhotos.php');
        //ob_flush();
        $content = ob_get_clean();
        $html2pdf = new HTML2PDF('P','A4','es');
        $html2pdf->WriteHTML($content);
        $aux=($this->_model['name']);
        $name= str_replace(' ','_',$aux);
        $html2pdf->Output('photos_'.$name.'.pdf','d');
        
    }
     public function getFavsComposite(){
         $urlImage='..';
        $this->_where=' WHERE (';
         foreach($this->_idmodel as $model){
              $this->_where.='m.id='.$model.' OR ';
         }
        $this->_where = substr($this->_where, 0, -4);
        $this->_where.=')  AND mp.main=1 ';
        $photos=$this->db->select('SELECT * FROM models m JOIN models_photos mp on(m.id=mp.model_id) JOIN photos p ON (p.id=mp.photo_id) '.$this->_where.' ORDER BY mp.position');
        ob_start();
        require(ROOT.'../libs/html2pdf/html2pdf.class.php');
        require(ROOT.'../pdfFav.php');
        //ob_flush();
        $content = ob_get_clean();
        $html2pdf = new HTML2PDF('P','A3','es');
        $html2pdf->WriteHTML($content);
        $aux=($this->_model['name']);
        $name= str_replace(' ','_',$aux);
        $html2pdf->Output('favourites.pdf','d');
        
    }
    public function sentFav(){
        $urlImage='http://sight-management.com';
        $headers = "From: " . strip_tags($mailSight) . "\r\n";
        $headers .= "Reply-To: " . strip_tags($mailSight) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject =  'Sight-Management: ';
        $para='dan@almabranding.com';
        $this->_where=' WHERE (';
         foreach($this->_idmodel as $model){
              $this->_where.='m.id='.$model.' OR ';
         }
        $this->_where = substr($this->_where, 0, -4);
        $this->_where.=')  AND mp.main=1 ';
        $photos=$this->db->select('SELECT * FROM models m JOIN models_photos mp on(m.id=mp.model_id) JOIN photos p ON (p.id=mp.photo_id) '.$this->_where.' ORDER BY mp.position');
        ob_start();
        require(ROOT.'../libs/html2pdf/html2pdf.class.php');
        require(ROOT.'../pdfFav.php');
        $content = ob_get_clean();
        mail($para, $subject, $content, $headers);
        
    }
    

}