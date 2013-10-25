<div id="sectionHeader">
    <a href="<?= URL ?>models/editportafolio/<?php echo $this->model_id; ?>"><div id="arrowBack">Back to model</div></a>
    <h1>Model</h1>
    <div id="sectionNav">
        <div class="btn grey" onclick="$('#cropForm').submit();" >Crop image</div>
    </div>
    <div class="clr"></div>
</div>
<?php $this->form->render(); ?>

        
<div class="container">
    
    <?php foreach ($this->img as $value) { ?>
        <img src="<?php echo URL . UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . $value['file_file_name']; ?>" id="target" alt="[Jcrop Example]" />
        <div id="preview-pane">
            <div class="preview-container">
                <img src="<?php echo URL . UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . $value['file_file_name']; ?>" class="jcrop-preview" alt="Preview" />
            </div>
        </div>
        <form id="cropForm" action="<?php echo URL; ?>uploadFile/crop" method="post" onsubmit="return checkCoords();">
            <label><input type="checkbox" id="ar_lock" name="thumbnail" />Apply to thumb</label>
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="rel" name="rel" />
            <input type="hidden" id="original" name="original" value="<?php echo $value['file_file_name']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $this->id; ?>"/>
            <input type="hidden" name="model_id" value="<?php echo $value['model_id']; ?>"/>
            <input type="hidden" id="filename" name="filename" value="<?php echo $value['file_file_name']; ?>"/>
            <input type="hidden" name="filefolder" value="models/<?php echo Model::idToRute($value['photo_id']); ?>"/>
        </form>
    <?php } ?>
    <div class="clearfix"></div>
</div>



