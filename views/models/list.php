<?if($this->_flipbook){?>
<div id="flipbook">
    <iframe width="640" scrolling="no" height="385" frameborder="0" src="<?=$this->_flipbook;?>" seamless="seamless" allowtransparency="true"></iframe>
</div>
<?}?>
<section id="" class="modelsList <?=$this->_sectionClass;?>">
    <div id="barAttributes">
            <? if($this->alphabetic){?>
            <ul id="abc">
<!--                <a href="<? //$this->path;?>/featured"><li class="star"></li></a>-->
                <a href="<?=$this->path;?>/A-C"><li <?=($this->_selection=='A-C' || !$this->_selection)?'class="selected"':''?>>A-C</li></a>
                <a href="<?=$this->path;?>/D-F"><li <?=($this->_selection=='D-F')?'class="selected"':''?>>D-F</li></a>
                <a href="<?=$this->path;?>/G-I"><li <?=($this->_selection=='G-I')?'class="selected"':''?>>G-I</li></a>
                <a href="<?=$this->path;?>/J-L"><li <?=($this->_selection=='J-L')?'class="selected"':''?>>J-L</li></a>
                <a href="<?=$this->path;?>/M-O"><li <?=($this->_selection=='M-O')?'class="selected"':''?>>M-O</li></a>
                <a href="<?=$this->path;?>/P-R"><li <?=($this->_selection=='P-R')?'class="selected"':''?>>P-R</li></a>
                <a href="<?=$this->path;?>/S-U"><li <?=($this->_selection=='S-U')?'class="selected"':''?>>S-U</li></a>
                <a href="<?=$this->path;?>/V-X"><li <?=($this->_selection=='V-X')?'class="selected"':''?>>V-X</li></a>
                <a href="<?=$this->path;?>/Y-Z"><li <?=($this->_selection=='Y-Z')?'class="selected"':''?>>Y-Z</li></a>
            </ul>
            <?}?>
            <? if($this->linkTo){?>
            <a target="_blank" href="<?=$this->linkTo?>"><div id="linkTo"><?=$this->linkToText?></div></a>
             <?}?>
            <? if($this->modelsSearch){?>
            <div id="search">
                <ul>
                <li><input id="tags" placeholder="<?=$this->lang['choose_model']?>">
                <ul>
                    <? foreach($this->modelsSearch as $value){
                       echo "<a href='".$value['value']."'><li>".$value['label']."</li></a>";
                    }?>
                </ul></li>
                </ul>
            </div>
             <?}?>
        </div>
    <div id="masorny">
        
        <? foreach($this->modelsGallery as $id=>$value){ //Back::isImage($value['photo_id']);?>
        <div class="item">
            <a href='<?=URL.LANG?>/gallery/model/<? echo $value['model_id'].'-'.urlencode($value['name']);?>'>
            <div class="imgbox">
                <img alt="<?php  echo $value['caption'];?>" src="<?php echo UPLOAD.'models/'.Model::idToRute($value['photo_id']).'thumb_'.$value['file_file_name'];?>" />
            <div class='name'><?php echo $value['name'];?></div>
            </div>
            <?if($this->_sectionClass){?><div class='info'><?php echo Strip::readMore($value['content_' . LANG]); ?></div><?}?>
            </a>
        </div>
        <?}?> 
    </div>
</section>
<script>
<?php
$js_array = json_encode($this->modelsSearch);
echo "var availableTags = ". $js_array . ";\n";
?>
</script>