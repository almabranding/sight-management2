<section id="modelsList">
    <div id="masorny">
        <? foreach($this->modelPhotos as $id=>$value){?>
        <div class="item">
            <div class="imgbox"><img alt="<?php echo $value['caption'];?>" src="/uploads/models/<?php echo 'thumb_'.$value['photo_id'].'.jpg';?>" /></div>
        </div>
        <?}?> 
    </div>
</section>