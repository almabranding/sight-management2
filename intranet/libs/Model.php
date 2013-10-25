<?php
class Model {
    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        //$this->delTree(CACHE);
    }
    function endConn() {
        $this->db = null;
    }
    function getMenu($id=null,$column=null){
        $column=($column==null)?'*':$column;
        if($id==null)return $this->db->select("SELECT * FROM menu WHERE parent=0");
        else $consulta=$this->db->select('SELECT '.$column.' FROM menu WHERE id = :id', 
            array('id' => $id));
        if($column==null) return $consulta;
        else return $consulta[0][$column];
    }
    function getTemplate($id=null,$column=null){
        $column=($column==null)?'*':$column;
        if($id==null)return $this->db->select("SELECT * FROM template");
        else $consulta=$this->db->select('SELECT '.$column.' FROM template WHERE id = :id', 
            array('id' => $id));
        if($column==null) return $consulta;
        else return $consulta[0][$column];
    }
    function delTree($dir) { 
        if(!is_dir($dir)) return false;
        $files = array_diff(scandir($dir), array('.','..')); 
         foreach ($files as $file) { 
           (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file"); 
         } 
        return rmdir($dir); 
    } 
    public function getPageInfo($id){
         $consulta=$this->db->select('SELECT * FROM page WHERE id = :id', 
            array('id' => $id));
         return $consulta;
    }
    public function getTimeStamp($sqlTime){
        $timestamp = strtotime($sqlTime);
        return date("d M Y G:i",$timestamp);
    }
    public function getTimeSQL(){
        return date("Y-m-d G:i:s");
    }
    public function getPagination($now,$numpp,$table,$url,$order=null){
        $sth = $this->db->prepare("SELECT * FROM ".$table);
        $sth->execute();
        $sth->fetch();
        $count =  $sth->rowCount();
        $pagination['url']=$url;
        $pagination['min']=1;
        $pagination['now']=(int)$now;
        $pagination['max']=(int)($count/$numpp);
        $pagination['order']=$order;
        return $pagination;
    }
    public function getPaginationCond($now,$numpp,$table,$where,$url,$order=null){
        $sth = $this->db->prepare("SELECT * FROM ".$table.' '.$where);
        $sth->execute();
        $sth->fetch();
        $count =  $sth->rowCount();
        $pagination['url']=$url;
        $pagination['min']=1;
        $pagination['now']=(int)$now;
        $pagination['max']=(int)($count/$numpp);
        $pagination['order']=$order;
        return $pagination;
    }
    public function idToRute($id) {
       $id=str_pad($id, 9, "0", STR_PAD_LEFT);
       $folder=str_split($id,3);
       foreach($folder as $value){
           $rute.=$value.'/';
       } 
       return $rute;
    }

}