<div id="header">
    <div id="header_wrapper">
         <a href="/<?= LANG ?>/<?= PACKAGE ?>/<?= TYPEBOOKING ?>"><h1><?= $this->title ?></h1></a>
    </div>
</div>
<div id="menu_separator"></div>
<section id="modelsList" class="<?= $this->_sectionClass; ?>">
    <? if ($this->isFav) { ?>
        <div class="modelExtraInfo" style="margin:20px">
            <a id="requestInfo" href="mailto:<?=$this->booker['email']?>?subject=Request more information&body=<?= URL.PACKAGE ?>/<?= TYPEBOOKING ?>/favourites/<?= $this->ids ?>"><div style="float:left;"  id="sendMail"><?=$this->lang['req_info']?></div></a>
            <a id="requestInfo" href="<?= URL.LANG ?>/<?= PACKAGE ?>/selection/sentFav/<?= $this->ids ?>"><div style="float:left;display:none;"  id="sendMail"><?=$this->lang['send_fav_mail']?></div></a>
            <a target="_blank" href="<?= URL.LANG ?>/<?= PACKAGE ?>/selection/PdfFav/<?= $this->ids ?>"><div style="float:left;" id="print"><?= $this->lang['down_fav_pdf']; ?></div></a>
        </div>
    <? } ?>
    <div id="masorny">
        <? foreach ($this->modelsGallery as $id => $value) { ?>
            <div class="item">
                <a href='/<?= LANG ?>/<?= PACKAGE ?>/<?= TYPEBOOKING ?>/model/<? echo $value['model_id'] . '-' . urlencode($value['name']); ?>'>
                    <div class="imgbox">
                        <img alt="<?php echo $value['caption']; ?>" src="<?php echo UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . 'thumb_' . $value['file_file_name']; ?>" />
                        <div class='name'><?php echo $value['name']; ?></div>
                    </div>
                </a>
            </div>
        <? } ?> 
    </div>
</section>
<script>
<?php
$js_array = json_encode($this->modelsSearch);
echo "var availableTags = " . $js_array . ";\n";
?>
</script>