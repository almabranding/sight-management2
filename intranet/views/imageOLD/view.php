
<div>
    <?php $this->form->render(); ?>
</div>
<script type="text/javascript">
    /*
  jQuery(function($){
    // Create variables (in this scope) to hold the API and image size
    var jcrop_api,
        boundx,
        boundy,

        // Grab some information about the preview pane
        $preview = $('#preview-pane'),
        $pcnt = $('#preview-pane .preview-container'),
        $pimg = $('#preview-pane .preview-container img'),

        xsize = $pcnt.width(),
        ysize = $pcnt.height();
    
    $('#target').Jcrop({
      onChange: updatePreview,
      onSelect: updatePreview,
      aspectRatio: 0
    },function(){
      // Use the API to get the real image size
      var bounds = this.getBounds();
      boundx = bounds[0];
      boundy = bounds[1];
      // Store the API in the jcrop_api variable
      jcrop_api = this;

      // Move the preview into the jcrop container for css positioning
      $preview.appendTo(jcrop_api.ui.holder);
    });

    function updatePreview(c)
    {
      if (parseInt(c.w) > 0)
      {
        var rx = xsize / c.w;
        var ry = ysize / c.h;

        $pcnt.css({
          width: Math.round(c.w) + 'px',
          height: Math.round(c.h) + 'px'
        });
        $pimg.css({
          width: Math.round(rx * boundx) + 'px',
          height: Math.round(ry * boundy) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
      }
      updateCoords(c)
    };


  });


 function updateCoords(c)
  {
    var img = document.getElementById('target');
    var width = img.width;
    var rel=width/$('#target').width();
    //rel=1.98;
    $('#rel').val(rel);
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };
  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Select the area first');
    return false;
  };
  function hidePreview()
  {
    $preview.stop().fadeOut('fast');
  };
  */
</script>
<script type="text/javascript">
 jQuery(function($){
    // Create variables (in this scope) to hold the API and image size
    var jcrop_api,
        boundx,
        boundy,

        // Grab some information about the preview pane
        $preview = $('#preview-pane'),
        $pcnt = $('#preview-pane .preview-container'),
        $pimg = $('#preview-pane .preview-container img'),

        xsize = $pcnt.width(),
        ysize = $pcnt.height();
    
    $('#target').Jcrop({
      onChange: updatePreview,
      onSelect: updatePreview,
      aspectRatio: 0
    },function(){
      // Use the API to get the real image size
      var bounds = this.getBounds();
      boundx = bounds[0];
      boundy = bounds[1];
      // Store the API in the jcrop_api variable
      jcrop_api = this;

      // Move the preview into the jcrop container for css positioning
      $preview.appendTo(jcrop_api.ui.holder);
    });

    function updatePreview(c)
    {
      $('.avatar').css('display','none');
      $('.preview').css('display','inherit');
      if (parseInt(c.w) > 0)
      {
        var rx = c.w / c.w;
        var ry = c.h / c.h;

        $pcnt.css({
          width: Math.round(c.w) + 'px',
          height: Math.round(c.h) + 'px'
        });
        $pimg.css({
          width: Math.round(rx * boundx) + 'px',
          height: Math.round(ry * boundy) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
      }
      updateCoords(c);
    };
  });
  function updateCoords(c)
  {
      var img = document.getElementById('target');
//or however you get a handle to the IMG

    var width = img.width;
    var width = img.width;
    var height = img.height
    var rel=width/$('#target').width();
    //rel=1.98;
    $('#rel').val(rel);
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
    $('#width').text(c.w);
    $('#height').text(c.h);
  };
  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Select the area first');
    return false;
  };
  function hidePreview()
  {
    $preview.stop().fadeOut('fast');
  };
  $(function() {
   $('#sortable').sortable({
        start: function(event, ui) {
            $(ui.helper).addClass("sortable-drag-clone");
        },
        stop: function(event, ui) {
            $(ui.helper).removeClass("sortable-drag-clone");
        },
        update: function(event, ui) {
            updateListItem($(ui.item).attr('rel'), $(this).attr('rel'));
        },
        tolerance: "pointer",
        connectWith: "#sortable",
        placeholder: "sortable-draggable-placeholder",
        forcePlaceholderSize: true,
        appendTo: 'body',
        helper: 'clone',
        zIndex: 666
    }).disableSelection();  
});
function updateListItem(itemId, newStatus) {
    var sorted = $( "#sortable" ).sortable( "serialize" );
    $.post('',sorted+'&action=updateOrder').done(function(data) {});
  }

  
</script>
<style type="text/css">

/* 
.jcrop-holder #preview-pane {
  display: block;
  position: absolute;
  z-index: 2000;
  top: 10px;
  right: -280px;
  padding: 6px;
  border: 1px rgba(0,0,0,.4) solid;
  background-color: white;

  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;

  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
}

#preview-pane .preview-container {
  width: 250px;
  height: 170px;
  overflow: hidden;
}
*/
</style>
<div class="container">
    <?php foreach($this->img as $value){?>
  <img src="<?php echo UPLOAD_ABS.$value['page'].'/'.$value['img'];?>" id="target" alt="[Jcrop Example]" />
  <div id="preview-pane">
    <div class="preview-container">
      <img src="<?php echo UPLOAD_ABS.$value['page'].'/'.$value['img'];?>" class="jcrop-preview" alt="Preview" />
    </div>
  </div>
  <form action="<?php echo URL;?>uploadFile/crop" method="post" onsubmit="return checkCoords();">
        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="w" name="w" />
        <input type="hidden" id="h" name="h" />
        <input type="hidden" id="rel" name="rel" />
        <input type="hidden" id="" name="id" value="<?php echo $this->id;?>"/>
        <input type="hidden" id="" name="filename" value="<?php echo $value['img'];?>"/>
        <input type="hidden" id="" name="filefolder" value="<?php echo $value['page'];?>"/>
        <input type="submit" value="Crop Image" class="btn" /><input type="button" value="Back" class="btn" onclick="location.href='<?php echo URL.LANG;?>/page/view/<?php echo $value['page'];?>';" />
</form>
  <?php   } ?>
<div class="clearfix"></div>
</div>

