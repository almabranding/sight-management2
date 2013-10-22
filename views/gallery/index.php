<div id="" class="gallery_wrapper">
    <section id="modelGallery">
        <a href="<?=URL.Session::get('LASTHEADSHEET');?>"><div id="arrowBack"><?=$this->lang['back_models']?></div></a>
        <div class="modelListInfo">
            <h2><? echo $this->model['name']; ?></h2>
            <div class="modelExtraInfo">
                <div rel="<?=$this->model['id']?>" id="addFav"><?=$this->lang['add_fav']?></div>
                <a id="viewFavLink" rel="<?=URL.LANG?>/models/favourites/" href="#"><div id="viewFav"><?=$this->lang['view_fav']?></div></a>
                <ul>
                    <li></li>
                    <? 
                    if($this->SIU){
                    foreach($this->siuList as $value)
                     echo ($this->siu[$value]) ? '<li>' . $this->lang[$value] . ': <span>' . $this->siu[$value] . '</span></li>' : ''; 
                    }?>
                </ul>
                <?if($this->hasComposite){?><a target="_blank" href="<?=URL.LANG?>/gallery/composite/<?=$this->model['id']?>"><div id="print"><?=$this->lang['print_composite']?></div></a><?}?>
                <div class="clr"></div>
            </div>
        </div>
        <!--    <div class="scrollbar">
                <div class="handle">
                    <div class="mousearea"></div>
                </div>
            </div>-->
         <div class="frameContainer">
            <button class="btn prev"><i class="chevronRight"></i></button>
            <button class="btn next"><i class="chevronLeft"></i></button>
        </div>
        <div class="frame" id="centered">
            <ul class="clearfix">
                <? foreach ($this->modelGallery as $value) {
                    $rute = ROOT . 'uploads/models/'.Model::idToRute($value['photo_id']);
                    $size=getimagesize($rute . $value['file_file_name']);
                    $width=  $size[0];
                    $height=  500;?>
                    <li style="width:<?=$width?>px">
                        <img height="<?=$height?>" width="<?=$width?>" alt="<?php echo $value['name']; ?>" src="/uploads/models/<?= Model::idToRute($value['photo_id']) . $value['file_file_name']; ?>" />
                        <?if($value['photographer']) echo "<div class='photoLabel'>".$value['photographer']."</div>";?>
                    </li>
<? } ?>
            </ul>
        </div>
       
        <div  id="modelDescription">
            <? if( $this->model['category_id']==2 || $this->model['category_id']==4) echo $this->model['content_'.LANG];?>
        </div>
    </section>
</div>
