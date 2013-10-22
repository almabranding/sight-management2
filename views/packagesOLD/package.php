<div id="fullScreen">Full Screen</div>
<section id="modelsList">
    <div id="masorny">
        <? foreach($this->modelsPackage as $id=>$value){?>
        <div class="item">
            <a href='/packages/model/<? echo $this->package['id'].'-'.urlencode($this->package['name']);?>/<? echo $value['id'].'-'.urlencode($value['name']);?>'>
            <div class="imgbox"><img alt="<?php //echo $value['name'];?>" src="/uploads/models/<?php echo 'thumb_'.$value['photo']['photo_id'].'.jpg';?>" /></div>
            <div class='name'><?php echo $value['name'];?></div>
            </a>
        </div>
        <?}?> 
    </div>
</section>