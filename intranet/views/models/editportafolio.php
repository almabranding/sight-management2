<div id="sectionHeader">
    <a href="<?= URL ?>models/lista"><div id="arrowBack">Back to models</div></a>
    <h1><?= $this->model[0]['name']; ?></h1>
    <div id="sectionNav">
        <div class="linkNav" id="allSelect">Select all photos</div>
        <a target="_blank" href="<?php echo WEB; ?>ES/gallery/model/<?= $this->id; ?>"><div class="linkNav" id="">View portfolio</div></a>
        <div class="btn blue" id="selectHeadsheet">Use as a headsheet</div>
        <div id="deleteImage" class="btn red">Delete</div>
        <div class="btn grey" onclick="showPop('newImage');" >Add new photo</div>
        <a href="<?php echo URL . LANG; ?>/models/composite/<?= $this->id; ?>"><div class="btn grey" >Composite</div></a>
        <a href="<?php echo URL . LANG; ?>/models/editmodel/<?= $this->id; ?>"><div class="btn grey" >Edit model</div></a>
        <div class="btn blue" id="saveInputs">Save</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <div>
        <input id="model_id" value="<? echo $this->model[0]['id'] ?>" type="hidden">
        <ul id="sortable" class="ui-sortable sortable modelListImages" rel="cosa">
            <?php
            foreach ($this->modelPhotos as $key => $value) {
                Back::isImage($value['photo_id']);
                ?>
                <li id="foo_<?=$value['id']; ?>" class="ui-state-default modelList <? echo ($value['main']) ? 'mainPic' : '' ?>" onclick="">
                    <input value="<?=$value['id']; ?>" name="check[]" class="checkFoto" type="checkbox">
                    <img width="154" height="207" class="listImage" caption="<?=$value['caption_' . LANG]; ?>" src="<?php echo URL . UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . 'thumb_' . $value['file_file_name']; ?>"/>
                    <select name="visibility[<?=$value['id']; ?>]" type='select' class="inputSmall" style='text-transform:capitalize;'>
                        <option value="public" <?if($value['visibility']=='public') echo 'selected';?>>Public</option><option value="private" <?if($value['visibility']=='private') echo 'selected';?>>Private</option>
                    </select>
                    <input name="photographer[<?=$value['id']; ?>]" type="text" class='inputSmall' value='<?=$value['photographer']?>'>
                    <a target="_blank" href="<?php echo URL . UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . $value['file_file_name']; ?>"><input id="h1096" class="btnSmall" type="button" value="View" ></a>
                    <input id="h1096" class="btnSmall editImg" type="button" value="Edit" onclick="location.href = '<?php echo URL . LANG; ?>/models/viewImage/<?php echo $value['id']; ?>'" >
                    <input class="btnSmall deleteSingle" type="submit" value="Delete"style="background: #bb0000;">
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="white_box hide" id="newImage" style="width:auto;left:30%;position:absolute;">
    <?php $this->viewUploadFile($this->id, 'models'); ?>
</div>
