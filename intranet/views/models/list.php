<div id="sectionHeader">
    <h1>Model</h1>
    <div id="sectionNav">
        <div class="btn blue" onclick="location.href = '<?php echo URL . LANG; ?>/models/addmodel'">Add new model</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <? $this->searchModel->render('views/models/custom-template.php'); ?>
    <ul id="" class="ui-sortable" rel="cosa">
        <? foreach ($this->models as $key => $value) {?>
            <li rel="<?php echo $value['model_id']; ?>" class="ui-state-default modelList" onclick="">
                <a target="_blank" href="<?= WEB . 'ES/gallery/model/' . $value['model_id'] . '-' . $value['name']; ?>"><img caption="<?php echo $value['caption_' . LANG]; ?>" src="<?php echo URL . UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . 'thumb_' . $value['file_file_name']; ?>"></a>
                <p class="modelName"><?php echo $value['name']; ?></p> 
                <p><?php echo $this->categories[$value['category_id']]['name']; ?></p>
                <input class="btnSmall editImg" type="button" value="Portfolio" onclick="location.href = '<?php echo URL . LANG; ?>/models/editportafolio/<?= $value['model_id']; ?>'">
                <input class="btnSmall editImg" type="button" value="Composite" onclick="location.href = '<?php echo URL . LANG; ?>/models/composite/<?= $value['model_id']; ?>'" >
                <input class="btnSmall editImg" type="button" value="Edit" onclick="location.href = '<?php echo URL . LANG; ?>/models/editmodel/<?= $value['model_id']; ?>'" >
                <input id="" class="btnSmall deleteModel" type="submit" value="Delete" style="background: #bb0000;">
            </li>
        <?php } ?>
    </ul>
<? $this->getView('pagination'); ?>
</div>
