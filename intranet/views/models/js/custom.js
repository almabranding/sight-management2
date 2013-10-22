
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
    });
});
function updateListItem(itemId, newStatus) {
    var sorted = $( "#sortable" ).sortable( "serialize" );
    $.post(ROOT+'models/sort',sorted+'&action=updateOrder').done(function(data) {});
}
  $(document).ready(function() {
      var $model_id=$('#model_id').val();
    $('.listImage').on('click',function(){
        var $checkbox=$(this).parent().children('.checkFoto');
        $checkbox.attr('checked', !$checkbox.attr('checked'));
    });
    $('.deleteSingle').on('click',function(){
        var $lista=$(this).parent().children('.checkFoto').val();
        $lista='check%5B%5D='+$lista;
        if(confirm('¿Estas seguro?'))
        $.post(ROOT+'ES/models/deleteImages',$lista).done(function(data) {location.reload();});
    });
    $('#deleteImage').on('click',function(){
        var $listaImages=$('.checkFoto:checked').serialize();
        if(confirm('¿Estas seguro?'))
           $.post(ROOT+'ES/models/deleteImages',$listaImages).done(function(data) {location.reload();});
    });
    $('.deleteModel').on('click',function(){
        var $listaImages=$(this).parent().attr('rel');
        if(confirm('¿Estas seguro?'))
           $.post(ROOT+'ES/models/deleteModel/'+$listaImages).done(function(data) {location.reload();});
    });
    $('#saveInputs').on('click',function(){
       var $listaInputs=$(':input').serialize();
       $.post(ROOT+'ES/models/saveInputs',$listaInputs).done(function(data) {alert("Changes has been saved");});
    });
    $('#allSelect').on('click',function(){
       var $checkbox=$('.checkFoto');
       $checkbox.attr('checked', 'checked');
    });
    $('#selectHeadsheet').on('click',function(){
        $('.checkFoto:checked').index();
        var $listaImages=$('.checkFoto:checked').serialize();
        if($('.checkFoto:checked').size()>1){
            alert('Select only one picture');
            return 0;
        }
        $.post(ROOT+'ES/models/selectHeadsheet',$listaImages+'&model_id='+$model_id).done(function(data) {location.reload();});
    });
  });