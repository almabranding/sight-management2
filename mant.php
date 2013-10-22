<?php

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sightdb');
define('DB_USER', 'mysightma');
define('DB_PASS', '4G91Fn8Y');
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');

class thumb {

    var $image;
    var $type;
    var $width;
    var $height;
    var $name;

//---Método de leer la imagen
    function reset() {
        $this->loadImage($this->name);
    }

    function loadImage($name) {
//---Tomar las dimensiones de la imagen
        $info = getimagesize($name);
        $this->name = $name;
        $this->width = $info[0];
        $this->height = $info[1];
        $this->type = $info[2];
//---Dependiendo del tipo de imagen crear una nueva imagen
        switch ($this->type) {
            case IMAGETYPE_JPEG:
                $this->image = imagecreatefromjpeg($name);
                break;
            case IMAGETYPE_GIF:
                $this->image = imagecreatefromgif($name);
                break;
            case IMAGETYPE_PNG:
                $this->image = imagecreatefrompng($name);
                break;
        }
    }

    function destroy() {
        imagedestroy($this->image);
    }

//---Método de guardar la imagen
    function save($name, $quality = 100) {

//---Guardar la imagen en el tipo de archivo correcto
        switch ($this->type) {
            case IMAGETYPE_JPEG:
                imagejpeg($this->image, $name, $quality);
                break;
            case IMAGETYPE_GIF:
                imagegif($this->image, $name);
                break;
            case IMAGETYPE_PNG:
                $pngquality = floor(($quality - 10) / 10);
                imagepng($this->image, $name, $pngquality);
                break;
        }
        return true;
    }

//---Método de mostrar la imagen sin salvarla
    function show() {

//---Mostrar la imagen dependiendo del tipo de archivo
        switch ($this->type) {
            case IMAGETYPE_JPEG:
                imagejpeg($this->image);
                break;
            case IMAGETYPE_GIF:
                imagegif($this->image);
                break;
            case IMAGETYPE_PNG:
                imagepng($this->image);
                break;
        }
    }

//---Método de redimensionar la imagen sin deformarla
    function resize($value, $prop) {

//---Determinar la propiedad a redimensionar y la propiedad opuesta
        $prop_value = ($prop == 'width') ? $this->width : $this->height;
        $prop_versus = ($prop == 'width') ? $this->height : $this->width;

//---Determinar el valor opuesto a la propiedad a redimensionar
        $pcent = $value / $prop_value;
        $value_versus = $prop_versus * $pcent;

//---Crear la imagen dependiendo de la propiedad a variar
        $image = ($prop == 'width') ? imagecreatetruecolor($value, $value_versus) : imagecreatetruecolor($value_versus, $value);

//---Hacer una copia de la imagen dependiendo de la propiedad a variar
        switch ($prop) {

            case 'width':
                imagecopyresampled($image, $this->image, 0, 0, 0, 0, $value, $value_versus, $this->width, $this->height);
                break;

            case 'height':
                imagecopyresampled($image, $this->image, 0, 0, 0, 0, $value_versus, $value, $this->width, $this->height);
                break;
        }

//---Actualizar la imagen y sus dimensiones
        $info = getimagesize($this->name);

        $this->width = imagesx($image);
        $this->height = imagesy($image);
        $this->image = $image;
    }

//---Método de extraer una sección de la imagen sin deformarla
    function crop($cwidth, $cheight, $pos = 'center') {

//---Dependiendo del tamaño deseado redimensionar primero la imagen a uno de los valores
        if ($cwidth > $cheight) {
            $this->resize($cwidth, 'width');
        } else {
            $this->resize($cheight, 'height');
        }

//---Crear la imagen tomando la porción del centro de la imagen redimensionada con las dimensiones deseadas
        $image = imagecreatetruecolor($cwidth, $cheight);

        switch ($pos) {

            case 'center':
                imagecopyresampled($image, $this->image, 0, 0, abs(($this->width - $cwidth) / 2), abs(($this->height - $cheight) / 2), $cwidth, $cheight, $cwidth, $cheight);
                break;

            case 'left':
                imagecopyresampled($image, $this->image, 0, 0, 0, abs(($this->height - $cheight) / 2), $cwidth, $cheight, $cwidth, $cheight);
                break;

            case 'right':
                imagecopyresampled($image, $this->image, 0, 0, $this->width - $cwidth, abs(($this->height - $cheight) / 2), $cwidth, $cheight, $cwidth, $cheight);
                break;

            case 'top':
                imagecopyresampled($image, $this->image, 0, 0, abs(($this->width - $cwidth) / 2), 0, $cwidth, $cheight, $cwidth, $cheight);
                break;

            case 'bottom':
                imagecopyresampled($image, $this->image, 0, 0, abs(($this->width - $cwidth) / 2), $this->height - $cheight, $cwidth, $cheight, $cwidth, $cheight);
                break;
        }

        $this->image = $image;
    }

}

class Database extends PDO {

    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        //parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }

        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }

    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function insert($table, $data) {

        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
        return $this->lastInsertId();
    }

    /**
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public function update($table, $data, $where) {
        ksort($data);

        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }

    /**
     * delete
     * 
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
    public function delete($table, $where, $limit = 1) {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }

}

/*
  echo '<html><meta content="text/html; charset=utf-8" http-equiv="Content-Type">';
  $Database = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
  $model = $Database->select("SELECT id,file_file_name from photos WHERE ck=0 order by id");
  foreach ($model as $value) {
  $photo['file_file_name'] = $value['file_file_name'];
  $photo['photo_id'] = $value['id'];
  if(isImage($photo)){
  $data = array(
  'ck' => 1,
  );
  $Database->update('photos', $data,
  "`id` = '{$photo['photo_id']}'");
  }
  }
  echo "finished";
  echo '</html>'; */

function isImage($value) {
    $photo_id = $value['photo_id'];
    $rute = ROOT . 'uploads/models/';
    $rute.=idToRute($photo_id);
    if (!file_exists($rute . 'original/' . $value['file_file_name'])) {
        echo 'Importado:' . $rute . 'original/' . $value['file_file_name'] . "<br/>";
        if (!is_dir($rute . 'original/'))
            mkdir($rute . 'original/', 0777, true);
        $content = file_get_contents('http://models.sight-management.com/system/files/' . idToRute($photo_id) . 'original/' . $value['file_file_name']);
        echo $content;
        $fp = fopen($rute . 'original/' . $value['file_file_name'], "w");
        fwrite($fp, $content);
        fclose($fp);
    }
    //copy('http://models.sight-management.com/system/files/'.$model->idToRute($photo_id),)

    if (!file_exists($rute . 'thumb_' . $value['file_file_name']) || !file_exists($rute . $value['file_file_name'])) {
        echo 'Thumb:' . $rute . 'thumb_' . $value['file_file_name'] . "<br/>";
        if (filesize($rute . 'original/' . $value['file_file_name']) == 0)
            return true;
        echo 'Thumb:' . $rute . 'thumb_' . $value['file_file_name'] . "<br/>";
        $thumb = new thumb();
        $thumb->loadImage($rute . 'original/' . $value['file_file_name']);
        $thumb->resize(500, 'height');
        $thumb->save($rute . $value['file_file_name']);
        $thumb->resize(210, 'height');
        //$thumb->crop(162, 215,'left');
        $thumb->save($rute . 'thumb_' . $value['file_file_name']);
        $thumb->destroy();
        unset($thumb);
    }

    if (file_exists($rute . 'thumb_' . $value['file_file_name']) && file_exists($rute . $value['file_file_name']) && file_exists($rute . 'original/' . $value['file_file_name'])) {
        return true;
    }
    return false;
}

function idToRute($id) {
    $id = str_pad($id, 9, "0", STR_PAD_LEFT);
    $folder = str_split($id, 3);
    foreach ($folder as $value) {
        $rute.=$value . '/';
    }
    return $rute;
}

function delTree($dir) {
    if (!is_dir($dir))
        return false;
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}

function deleteImagesUnused() {
    $Database = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    $qry = $Database->select("SELECT * from photos p where not exists (SELECT photo_id from models_photos mp WHERE mp.photo_id=p.id UNION SELECT photo_id from home_photos hp where hp.photo_id=p.id) order by id LIMIT 0,50");
    echo "DELETED: ";
    foreach ($qry as $value) {
        $photo_id = $value['id'];
        $rute = ROOT . 'uploads/models/';
        $rute.=idToRute($photo_id);
        echo $photo_id . "-";
        delTree($rute);
        $Database->delete('photos', 'id=' . $photo_id);
    }
    echo "finished";
}
function deleteRegistresUnused() {
    $Database = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    $qry = $Database->select("SELECT * from models_photos mp where not exists (SELECT id from photos p WHERE mp.photo_id=p.id UNION SELECT id from models m WHERE mp.model_id=m.id) order by id LIMIT 0,50");
    echo "DELETED REG: ";
    foreach ($qry as $value) {
        $id = $value['id'];
        echo $id . "-";
        $Database->delete('models_photos', 'id=' . $id);
    }
    echo "finished";
}

//deleteImagesUnused();
//deleteRegistresUnused();
?>
