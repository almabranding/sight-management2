<?php

class Models_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function searchForm($url = '/models/searchModel') {
        $action = URL . LANG . $url;
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('searchModel', 'GET', $action, $atributes);

        $form->add('hidden', '_add', 'model');

        $form->add('label', 'label_name', 'name', 'Name');
        $form->add('text', 'name', '', array('autocomplete' => 'off'));

        $form->add('label', 'label_modelList', 'modelList', 'Model:');
        $obj = $form->add('select', 'modelList', '', array('autocomplete' => 'off'));
        foreach ($this->getAllModels() as $key => $value) {
            $obt[$value['name']] = $value['name'];
        }
        $obj->add_options($obt);
        unset($obt);

        $form->add('label', 'label_sex', 'sex', 'Gender:');
        $obj = $form->add('select', 'sex', '', array('autocomplete' => 'off'));
        $obt[1] = 'Female';
        $obt[2] = 'Male';
        $obj->add_options($obt);
        unset($obt);

        $form->add('label', 'label_active', 'active', 'Status:');
        $obj = $form->add('select', 'active', '', array('autocomplete' => 'off'));
        $obt[0] = 'Inactive';
        $obt[1] = 'Active';
        $obj->add_options($obt);
        unset($obt);
        // "date"


        $form->add('label', 'label_notifications', 'notifications', 'Advanced Search');
        $obj = $form->add('checkboxes', 'notifications', array(
            'yes' => '',
                ), array('autocomplete' => 'off'));

        $form->add('label', 'label_category', 'category', 'Category');
        $obj = $form->add('select', 'category', '', array('autocomplete' => 'off'));
        foreach ($this->getModelsCategories() as $key => $value) {
            $obt[$value['id']] = $value['name'];
        }
        if ($obt)
            $obj->add_options($obt);

        unset($obt);


        $form->add('label', 'label_height', 'height', 'Height');
        $obj = $form->add('text', 'height_from', '', array('autocomplete' => 'off','style' => 'width:50px;float:left'));
        $obj = $form->add('text', 'height_to', '', array('autocomplete' => 'off','style' => 'width:50px;float:left'));
        
        $form->add('label', 'label_shoes', 'shoes', 'Shoes');
        $obj = $form->add('text', 'shoes_from', '', array('autocomplete' => 'off','style' => 'width:50px;float:left'));
        $obj = $form->add('text', 'shoes_to', '', array('autocomplete' => 'off','style' => 'width:50px;float:left'));

        
       $form->add('label', 'label_chest', 'chest', 'Chest');
        $obj = $form->add('text', 'chest_from', '', array('autocomplete' => 'off','style' => 'width:50px;float:left'));
        $obj = $form->add('text', 'chest_to', '', array('autocomplete' => 'off','style' => 'width:50px;float:left'));
        
        $form->add('label', 'label_waist', 'waist', 'Waist');
        $obj = $form->add('text', 'waist_from', '', array('autocomplete' => 'off','style' => 'width:50px;float:left'));
        $obj = $form->add('text', 'waist_to', '', array('autocomplete' => 'off','style' => 'width:50px;float:left'));
        
        
        $form->add('label', 'label_hairtype', 'hairtype', 'Hair type');
        $obj = $form->add('select', 'hairtype', '', array('autocomplete' => 'off'));
        foreach ($this->getAtributes('HairType') as $key => $value) {
            $obt[$value['id']] = $value['name'];
        }
        if ($obt)
            $obj->add_options($obt);
        unset($obt);

        $form->add('label', 'label_eyetype', 'eyetype', 'Eye type');
        $obj = $form->add('select', 'eyetype', '', array('autocomplete' => 'off'));
        foreach ($this->getAtributes('EyeType') as $key => $value) {
            $obt[$value['id']] = $value['name'];
        }
        if ($obt)
            $obj->add_options($obt);
        unset($obt);


        $form->add('label', 'label_mother_agency_id', 'mother_agency_id', 'Mother agency');
        $obj = $form->add('select', 'mother_agency_id', '', array('autocomplete' => 'off'));
        foreach ($this->getAgencies() as $key => $value) {
            $obt[$value['id']] = $value['name'];
        }
        if ($obt)
            $obj->add_options($obt);
        unset($obt);



        $form->add('label', 'label_based_in', 'based_in', 'Based in');
        $obj = $form->add('select', 'based_in', $model['based_in'], array('autocomplete' => 'off'));
        foreach ($this->getBased() as $key => $value) {
            $obt[$value['id']] = $value['base'];
        }
        if ($obt)
            $obj->add_options($obt);
        unset($obt);



        $form->add('submit', '_btnsubmit', 'Search');
        $form->validate();
        return $form;
    }

    public function editModelForm($type = 'add', $id = 'null') {
        $action = ($type == 'add') ? URL . LANG . '/models/add' : URL . LANG . '/models/edit/' . $id;
        if ($type == 'edit')
            foreach ($this->getModel($id) as $model)
                ;
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('addModel', 'POST', $action, $atributes);

        $form->add('hidden', '_add', 'model');

        $form->add('label', 'label_name', 'name', 'Name');
        $form->add('text', 'name', $model['name'], array('autocomplete' => 'off', 'required' => array('error', 'Name is required!')));

        //$form->add('label', 'label_headsheet_name', 'headsheet_name', 'Headsheet name');
        //$form->add('text', 'headsheet_name', $model['headsheet_name'], array('autocomplete' => 'off'));

        $obj = $form->add('radios', 'active', array(
            '1' => 'Active',
            '0' => 'Inactive'
                ), $model['active']);

        $obj = $form->add('radios', 'sex', array(
            '2' => 'Male',
            '1' => 'Female'
                ), $model['sex']);

        $form->add('label', 'label_based_in', 'based_in', 'Based in');
        $obj = $form->add('select', 'based_in', $model['based_in'], array('autocomplete' => 'off'));
        foreach ($this->getBased() as $key => $value) {
            $obt[$value['id']] = $value['base'];
        }
        if ($obt)
            $obj->add_options($obt);
        unset($obt);

        $form->add('label', 'label_mother_agency_id', 'mother_agency_id', 'Mother agency');
        $obj = $form->add('select', 'mother_agency_id', $model['mother_agency_id'], array('autocomplete' => 'off'));
        foreach ($this->getAgencies() as $key => $value) {
            $obt[$value['id']] = $value['name'];
        }
        if ($obt)
            $obj->add_options($obt);
        unset($obt);


        $form->add('label', 'label_height', 'height', 'Height');
        $form->add('text', 'height', $model['height'], array('autocomplete' => 'off'));

        $form->add('label', 'label_hairtype', 'hairtype', 'Hair type');
        $obj = $form->add('select', 'hairtype', $model['hair_type_id'], array('autocomplete' => 'off'));
        foreach ($this->getAtributes('HairType') as $key => $value) {
            $obt[$value['id']] = $value['name'];
        }
        if ($obt)
            $obj->add_options($obt);
        unset($obt);

        $form->add('label', 'label_bust', 'bust', 'Bust');
        $form->add('text', 'bust', $model['bust'], array('autocomplete' => 'off'));


        $form->add('label', 'label_eyetype', 'eyetype', 'Eye type');
        $obj = $form->add('select', 'eyetype', $model['eye_type_id'], array('autocomplete' => 'off'));
        foreach ($this->getAtributes('EyeType') as $key => $value) {
            $obt[$value['id']] = $value['name'];
        }
        if ($obt)
            $obj->add_options($obt);
        unset($obt);
        $form->add('label', 'label_waist', 'waist', 'Waist');
        $form->add('text', 'waist', $model['waist'], array('autocomplete' => 'off'));

        $form->add('label', 'label_hips', 'hips', 'Hips');
        $form->add('text', 'hips', $model['hips'], array('autocomplete' => 'off'));

        $form->add('label', 'label_shoes', 'shoes', 'Shoes');
        $obj = $form->add('select', 'shoes', $model['shoes'], array('autocomplete' => 'off'));
        foreach (SIU::getShoesSizes() as $key => $value) {
            $obt[$value] = $value;
        }
        if ($obt)
            $obj->add_options($obt);
        unset($obt);

        $form->add('label', 'label_category', 'category', 'Category');
        $obj = $form->add('select', 'category', $model['category_id'], array('autocomplete' => 'off', 'required' => array('error', 'Category is required!')));
        foreach ($this->getModelsCategories() as $key => $value) {
            $obt[$value['id']] = $value['name'];
        }
        $obj->add_options($obt);
        unset($obt);

        $obj = $form->add('radios', 'public', array(
            '1' => 'This model shows up in the webpage',
            '0' => 'This model does NOT show up in the webpage'
                ), $model['public']);

        $obj = $form->add('radios', 'show_in_headsheet', array(
            '1' => 'This model shows up in the headsheet',
            '0' => 'This model does NOT show up in the headsheet'
                ), $model['show_in_headsheet']);

        $obj = $form->add('radios', 'featured', array(
            '1' => 'This model shows up in the featured page',
            '0' => 'This model does NOT show up in the featured page'
                ), $model['featured']);

        foreach ($this->_langs as $lng) {
            $obj = $form->add('label', 'label_content_' . $lng, 'content_' . $lng, 'Content ' . $lng);
            $obj->set_rule(array(
                'length' => array(6, 10, 'error', 'The password must have between 6 and 10 characters'),
            ));
            $obj->set_attributes(array(
                'style' => 'float:none',
            ));
            $obj = $form->add('textarea', 'content_' . $lng, ($model['content_' . $lng]), array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));
        }
        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function formImage($type = 'add', $id = 'null') {

        $action = ($type == 'add') ? URL . LANG . '/models/editImage' : URL . LANG . '/models/editImage/' . $id;
        if ($type == 'edit')
            foreach ($this->getImageInfo($id) as $value)
                ;

        $form = new Zebra_Form('addProject', 'POST', $action);
        $pathinfo = pathinfo($value['img']);
        $form->add('hidden', '_add', 'page');
        $form->add('hidden', 'model_id', $value['model_id']);
        $form->add('hidden', 'originalName', $value['img']);
        $form->add('hidden', 'fileExt', $pathinfo['extension']);

        $form->add('label', 'label_caption', 'caption', 'Caption');
        $obj = $form->add('text', 'caption', $value['caption'], array('autocomplete' => 'off'));

        $form->add('label', 'label_photographer', 'photographer', 'Photographer');
        $obj = $form->add('text', 'photographer', $value['photographer'], array('autocomplete' => 'off'));
        $form->add('label', 'label_visibility', 'visibility', 'Visibility:');
        $obj = $form->add('select', 'visibility', '');
        $obj->add_options(array(
            'public' => 'Public',
            'private' => 'Private',
                ), $value['visibility']);

        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function getAgency($id) {
        return $this->db->select('SELECT * FROM mother_agencies WHERE id = :id', array('id' => $id));
    }

    public function getAgencies() {
        return $this->db->select('SELECT * FROM mother_agencies order by name');
    }

    public function getBaseds($id) {
        return $this->db->select('SELECT * FROM based WHERE id = :id', array('id' => $id));
    }

    public function getBased() {
        return $this->db->select('SELECT * FROM based');
    }

    public function getImageInfo($id) {
        return $this->db->select('SELECT * FROM photos p JOIN models_photos mp ON(p.id=mp.photo_id) WHERE p.id = :id', array('id' => $id));
    }

    public function getModel($id) {
        return $this->db->select('SELECT * FROM models WHERE id=' . $id);
    }

    public function getComposite($id) {
        return $this->db->select('SELECT * FROM models_photos mp join photos p on (mp.photo_id=p.id) WHERE model_id=' . $id . ' AND composite_position!="" order by composite_position');
    }

//    public function getNoComposite($id) {
//        echo 'SELECT * FROM models_photos mp join photos p on (mp.photo_id=p.id) WHERE model_id=' . $id . ' AND NOT IN (SELECT * FROM models_photos mp join photos p on (mp.photo_id=p.id) WHERE model_id=' . $id . ' AND composite_position=!="" ) order by position';
//        return $this->db->select('SELECT * FROM models_photos mp join photos p on (mp.photo_id=p.id) WHERE model_id=' . $id . ' AND composite_position=null order by position');
//    }

    public function resetComposite($id) {
        $data = array(
            'composite_position' => null
        );
        $this->db->update('models_photos', $data, "`model_id` = '{$id}'");
    }

    public function getModelSearch() {
        $models = null;
        //$sql=($_GET['name']!='' || $_GET['active']!='' || $_GET['sex']!='' || $_GET['mother_agency_id']!='' || $_GET['based_in']!='')?'SELECT * FROM models WHERE ':'SELECT * FROM models';
        $sql1 = 'SELECT * FROM models m JOIN models_photos mp on(m.id=mp.model_id) join photos p on(mp.photo_id=p.id) WHERE mp.main=1 AND';
        $sql2 = 'SELECT id as model_id FROM models WHERE ';

        if ($_GET['name'] != '') {
            $cadena = str_replace(', ', ',', $_GET['name']);
            $models = explode(",", $cadena);
            $sql.='( ';
            foreach ($models as $key => $value)
                $sql.=' name LIKE "%' . $value . '%" OR';
            $sql = substr($sql, 0, -3);
            $sql.=') AND ';
        }
        $sql.=($_GET['height_from'] != '' && $_GET['height_to'] != '') ? ' m.height BETWEEN ' . $_GET['height_from'] . ' AND ' . $_GET['height_to'] . ' AND ' : '';
        $sql.=($_GET['shoes_from'] != '' && $_GET['shoes_to'] != '') ? ' m.shoes BETWEEN ' . $_GET['shoes_from'] . ' AND ' . $_GET['shoes_to'] . ' AND ' : '';
        $sql.=($_GET['chest_from'] != '' && $_GET['chest_to'] != '') ? ' m.bust BETWEEN ' . $_GET['chest_from'] . ' AND ' . $_GET['chest_to'] . ' AND ' : '';
        $sql.=($_GET['waist_from'] != '' && $_GET['waist_to'] != '') ? ' m.waist BETWEEN ' . $_GET['waist_from'] . ' AND ' . $_GET['waist_to'] . ' AND ' : '';
        $sql.=($_GET['hairtype'] != '') ? ' hair_type_id=' . $_GET['hairtype'] . ' AND' : '';
        $sql.=($_GET['eyetype'] != '') ? ' eye_type_id=' . $_GET['eyetype'] . ' AND' : '';
        $sql.=($_GET['based_in'] != '') ? ' based_in=' . $_GET['based_in'] . ' AND' : '';
        $sql.=($_GET['mother_agency_id'] != '') ? ' mother_agency_id=' . $_GET['mother_agency_id'] . ' AND' : '';
        $sql.=($_GET['active'] != '') ? ' active=' . $_GET['active'] . ' AND' : ' active=1 AND';
        $sql.=($_GET['sex'] != '') ? ' sex=' . $_GET['sex'] . ' AND' : '';
        $sql.=($_GET['category'] != '') ? ' category_id=' . $_GET['category'] . ' AND' : '';

        $sql = substr($sql, 0, -3);
        $sql1.=$sql;
        $sql2.=$sql;
        $sql1.=' ORDER by name';
        $sql2.=' ORDER by name';
        $res1 = $this->db->select($sql1);
        $res2 = $this->db->select($sql2);
        if ($res1) {
            return $res1;
        } else
            return $res2;
    }

    public function getModelPhotos($id) {
        return $this->db->select('SELECT * FROM models_photos mp join photos p on(mp.photo_id=p.id) WHERE model_id = :id ORDER by position', array('id' => $id));
    }

    public function getAtributes($type) {
        return $this->db->select('SELECT * FROM attributes WHERE type="' . $type . '"');
    }

    public function getModels($pag, $numpp) {
        $min = $pag * $numpp - $numpp;
        $models = $this->db->select('SELECT * FROM models m where active=1 ORDER by m.updated_at DESC LIMIT ' . $min . ',' . $numpp);
        foreach ($models as $key => $model) {
            $photo = $this->db->select('SELECT * FROM models m JOIN models_photos mp on(m.id=mp.model_id) join photos p on(mp.photo_id=p.id) WHERE m.id=' . $model['id'] . ' AND mp.main=1 ORDER by m.updated_at');
            $result[$key]['model_id'] = $model['id'];
            $result[$key]['name'] = $model['name'];
            $result[$key]['photo_id'] = $photo[0]['photo_id'];
            $result[$key]['caption'] = $photo[0]['caption'];
            $result[$key]['file_file_name'] = $photo[0]['file_file_name'];
        }
        return $result;
        //return $this->db->select('SELECT * FROM models m JOIN models_photos mp on(m.id=mp.model_id) join photos p on(mp.photo_id=p.id) WHERE mp.main=1 ORDER by m.updated_at DESC LIMIT ' . $min . ',' . $numpp);
    }

    public function getModels_photos($photo_id) {
        return $this->db->select('SELECT * FROM models_photos where photo_id=' . $photo_id);
    }

    public function getAllModels() {
        return $this->db->select('SELECT * FROM models ORDER by name');
    }

    public function getModelsCategories() {
        $res = $this->db->select('SELECT * FROM categories');
        foreach ($res as $value) {
            $cat[$value['id']] = array(
                'id' => $value['id'],
                'name' => $value['name'],
                'permalink' => $value['permalink']);
        }
        return $cat;
    }

    public function edit($id) {
        $modelo = $this->getModel($id);
        Logs::set("Ha modificado el modelo " . $modelo[0]['name']);
        $data = array(
            'name' => $_POST['name'],
            'active' => $_POST['active'],
            'height' => $_POST['height'],
            'shoes' => $_POST['shoes'],
            'sex' => $_POST['sex'],
            'hair_type_id' => $_POST['hairtype'],
            'eye_type_id' => $_POST['eyetype'],
            'bust' => $_POST['bust'],
            'waist' => $_POST['waist'],
            'hips' => $_POST['hips'],
            'based_in' => $_POST['based_in'],
            'mother_agency_id' => $_POST['mother_agency_id'],
            'category_id' => $_POST['category'],
            'show_in_headsheet' => $_POST['show_in_headsheet'],
            'featured' => $_POST['featured'],
            'public' => $_POST['public'],
            'updated_at' => $this->getTimeSQL(),
                //'url' => filter_var(urlencode(strtolower($_POST['name'])), FILTER_SANITIZE_URL),
        );
        foreach ($this->_langs as $lng) {
            $data['content_' . $lng] = stripslashes($_POST['content_' . $lng]);
        }
        $this->db->update('models', $data, "`id` = '{$id}'");
    }

    public function add() {
        $data = array(
            'name' => $_POST['name'],
            'active' => $_POST['active'],
            'sex' => $_POST['sex'],
            'height' => $_POST['height'],
            'shoes' => $_POST['shoes'],
            'hair_type_id' => $_POST['hairtype'],
            'eye_type_id' => $_POST['eyetype'],
            'bust' => $_POST['bust'],
            'waist' => $_POST['waist'],
            'hips' => $_POST['hips'],
            'based_in' => $_POST['based_in'],
            'mother_agency_id' => $_POST['mother_agency_id'],
            'category_id' => $_POST['category'],
            'show_in_headsheet' => $_POST['show_in_headsheet'],
            'public' => $_POST['public'],
            'featured' => $_POST['featured'],
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL(),
        );
        foreach ($this->_langs as $lng) {
            $data['content_' . $lng] = stripslashes($_POST['content_' . $lng]);
        }
        $model_id = $this->db->insert('models', $data);
        $modelo = $this->getModel($model_id);
        Logs::set("Ha añadido el modelo " . $modelo[0]['name']);
        return $model_id;
    }

    public function deleteModel($id) {
        $modelo = $this->getModel($id);
        $this->db->delete('models', "`id` = {$id}");
        Logs::set("Ha borrado el modelo " . $id . " " . $modelo[0]['name']);
    }

    public function sort() {
        foreach ($_POST['foo'] as $key => $value) {
            $data = array(
                'position' => $key
            );
            $this->db->update('models_photos', $data, "`photo_id` = '{$value}'");
        }
        exit;
    }

    public function compositeSort() {
        $data = array(
            'composite_position' => null
        );
        $this->db->update('models_photos', $data, "`model_id` = '{$_POST['model_id']}'");
        foreach ($_POST['foo'] as $key => $value) {
            if ($key > 3)
                exit;
            $data = array(
                'composite_position' => $key
            );
            $this->db->update('models_photos', $data, "`photo_id` = '{$value}'");
        }

        $data = array(
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('models', $data, "`id` = '{$_POST['model_id']}'");
        exit;
    }

    public function deleteImages() {
        $cont = 0;
        $img = $this->db->select('SELECT * FROM models_photos WHERE photo_id = :id', array('id' => $_POST['check'][0]));
        $modelo = $this->getModel($img[0]['model_id']);
        foreach ($_POST['check'] as $key => $value) {
            $cont++;
            $this->delTree(UPLOAD . 'models/' . $this->idToRute($value));
            $this->db->delete('photos', "`id` = {$value}");
            $this->db->delete('models_photos', "`photo_id` = {$value}");
        }
        Logs::set("Ha borrado " . $cont . " fotos del modelo " . $modelo[0]['name']);
        exit;
    }

    public function deleteImage($id) {
        $this->delTree(UPLOAD . 'models/' . $this->idToRute($id));
        $this->db->delete('photos', "`id` = {$id}");
        $this->db->delete('models_photos', "`photo_id` = {$id}");
        $img = $this->db->select('SELECT * FROM models_photos WHERE photo_id = :id', array('id' => $id));
        $modelo = $this->getModel($img[0]['model_id']);
        Logs::set("Ha borrado una foto del modelo " . $modelo[0]['name']);
        return $img[0]['model_id'];
    }

    public function selectHeadsheet() {
        foreach ($_POST['check'] as $key => $value) {
            $data = array(
                'main' => 0
            );
            $this->db->update('models_photos', $data, "`model_id` = '{$_POST['model_id']}'");
            $data = array(
                'main' => 1
            );
            $this->db->update('models_photos', $data, "`photo_id` = '{$value}'");
        }

        $modelo = $this->getModel($_POST['model_id']);
        Logs::set("Ha cambiado el headsheet del modelo " . $modelo[0]['name']);
        exit;
    }

    public function editImage($id) {
        $Models_photos = $this->getModels_photos($id);
        $Models_photos = $Models_photos[0];
        $modelo = $this->getModel($Models_photos['model_id']);
        Logs::set("Ha modificado una imagen del modelo " . $modelo[0]['name']);
        $data = array(
            'caption' => $_POST['caption'],
            'photographer' => $_POST['photographer'],
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('photos', $data, "`id` = '{$id}'");
        $data = array(
            'visibility' => $_POST['visibility'],
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('models_photos', $data, "`photo_id` = '{$id}'");
        return $Models_photos['model_id'];
    }

    public function saveInputs() {
        foreach ($_POST['visibility'] as $key => $value) {
            $data = array(
                'visibility' => $value
            );
            $this->db->update('models_photos', $data, "`photo_id` = '{$key}'");
        }
        foreach ($_POST['photographer'] as $key => $value) {
            $data = array(
                'photographer' => $value
            );
            $this->db->update('photos', $data, "`id` = '{$key}'");
        }
    }

}
