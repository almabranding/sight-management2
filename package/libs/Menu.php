<?php

class Menu extends Model
{   
    public function __construct() 
    {
        parent::__construct();
    }
    public function getMenu($url = '') {
        $model=new Model();
        $m.='<ul class="header_menu">';
        $m.='<li class="menuTitle"><ul>';
        $menu=$model->db->select("SELECT * FROM menu WHERE parent=1 order by orden");
        foreach($menu as $value)
            $m.='<li class="menuLink"><a href="' . URL.LANG.'/'. $value['url'].'">'.$value['name_'.LANG].'</a></li>';
        $m.='</ul></li>';
        $m.='<li class="menuTitle"><ul>';
        $menu=$model->db->select("SELECT * FROM menu WHERE parent=2  order by orden");
        foreach($menu as $value)
            $m.='<li class="menuLink"><a href="' . URL.LANG.'/'. $value['url'].'">'.$value['name_'.LANG].'</a></li>';
        
        $m.='</ul></li>';
        return $m;
    }
    public function getMovil($url = '') {
        $model = new Model();
        $sth = $model->db->prepare("SELECT * FROM menu WHERE parent = :parent ORDER BY orden");
        $sth->execute(array(
            'parent' => '0'
        ));
        $level1 = $sth->fetchAll();
       
        $m.='<ul class="header_menu">';
        foreach ($level1 as $value) {
            $m.='<li class="menuTitle menuDepl " id="' . $value['name_'.LANG] . '"><div class="menuTitleBox"><span class="nocufon menuTitlespanArrrow">' . $value['name_'.LANG] . '</span></div></li>';
            $level2 = $model->db->select('SELECT * FROM menu WHERE parent = :parent  ORDER BY orden', array('parent' => $value['id']));
            $m.='<ul class="' . $value['name_'.LANG] . '">';
            foreach ($level2 as $value2) {
                $sth = $model->db->prepare("SELECT * FROM page WHERE id = :id");
                $sth->execute(array(
                    ':id' => $value2['page']
                ));
                $page = $sth->fetch();
                $class = ($url == $page['url']) ? 'selected' : '';
                $href = URL .LANG.'/'. $model->getTemplate($page['template'])  . $page['url'];
                $m.='<a href="' . $href . '"><li class="menuMobile ' . $class . ' menuDepl group" id="subM_' . $value2['id'] . '"><span class="nocufon">' . $value2['name_'.LANG] . $plus . '</span></li></a>';
            }
            $m.='</ul>';
        }
        return $m;
    }
}