<div id="header">
    <div id="header_wrapper">
         <a href="/<?= LANG ?>/<?= PACKAGE ?>/<?= TYPEBOOKING ?>"><h1><?= $this->title ?></h1></a>
    </div>
</div>
<div id="menu_separator"></div>
<div id="gallery_wrapper">
    <section id="modelGallery">
        <a href="/<?= LANG ?>/<?= PACKAGE ?>/<?= TYPEBOOKING ?>/all"><div id="arrowBack">Back to package</div></a>
        <div class="modelListInfo">
            <h2><? echo $this->model['name']; ?></h2>

        </div>
        <div class="modelExtraInfo">
                <div rel="<?=$this->model['id']?>" id="addFav"><?=$this->lang['add_fav']?></div>
                <a id="viewFavLink" rel="<?=URL.LANG ?>/<?= PACKAGE ?>/<?= TYPEBOOKING ?>/favourites/" href="#"><div id="viewFav"><?=$this->lang['view_fav']?></div></a>
                <?if($this->hasComposite){?><a target="_blank" href="/<?= LANG ?>/<?= PACKAGE ?>/selection/composite/<?=$this->model['id']?>"><div id="print"><?=$this->lang['print_composite'];?></div></a><?}?>
                <a target="_blank" href="/<?= LANG ?>/<?= PACKAGE ?>/selection/pdfPhotos/<?=$this->model['id']?>"><div id="print" style='margin-right: 5px;'><?=$this->lang['print_photos'];?></div></a>
                <a target="_blank" href="/<?= LANG ?>/<?= PACKAGE ?>/selection/downloadZip/<?=$this->model['id']?>"><div id="zip"><?=$this->lang['download_zip'];?></div></a>
                <a id="requestInfo" href="mailto:<?=$this->booker['email']?>?subject=Request more information&body=<?=URL . PACKAGE ?>/<?= TYPEBOOKING ?>/model/<?=$this->modelInfo?>"><div id="sendMail"><?=$this->lang['req_info']?></div></a>
           </div>
        <div class="frameContainer">
            <button class="btn prev"><i class="chevronRight"></i></button>
            <button class="btn next"><i class="chevronLeft"></i></button>
        </div>
        <div class="frame" id="centered">
            <ul class="clearfix">
                <?
                foreach ($this->modelGallery as $value) {
                    $rute = ROOT . '../uploads/models/'.Model::idToRute($value['photo_id']);
                    $size=getimagesize($rute . $value['file_file_name']);
                    $width=  $size[0];
                    $height=  500;
                    ?>
                    <li style="width:<?= $width ?>px">
                        <img height="<?=$height?>" width="<?=$width?>" alt="<?=$value['name']; ?>" src="<?= WEB ?>uploads/models/<?= Model::idToRute($value['photo_id']) . $value['file_file_name']; ?>" />
                    <? if ($value['photographer']) echo "<div class='photoLabel'>" . $value['photographer'] . "</div>"; ?>
                    </li>
<? } ?>
            </ul>
        </div>
        <div class="modelListInfo">
            <div  id="modelDescription">
            <? if( $this->model['category_id']==2 || $this->model['category_id']==4) echo $this->model['content_'.LANG];?>
        </div>
            
            <div class="modelExtraInfo">
                <ul>
                    <?
                    if ($this->SIU) {
                        include '../lang/EN/default.php';
                        $this->SIU->setLang('EN');
                        $SIU = $this->SIU->getSiu($this->model);
                        foreach ($this->SIU->getListAttr() as $value)
                            echo ($SIU[$value]) ? '<li>' . $lang[$value] . ': <span>' . $SIU[$value] . '</span></li>' : '';
                    }
                    ?>
                </ul>
            </div>
            <div class="modelExtraInfo">
                <ul>
                    <?
                    if ($this->SIU) {
                        include '../lang/ES/default.php';
                        $this->SIU->setLang('ES');
                        $SIU = $this->SIU->getSiu($this->model);
                        foreach ($this->SIU->getListAttr() as $value)
                            echo ($SIU[$value]) ? '<li>' . $lang[$value] . ': <span>' . $SIU[$value] . '</span></li>' : '';
                    }
                    ?>
                </ul>
            </div>
        </div>
         
    </section>
</div>