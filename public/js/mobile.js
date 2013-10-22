$(document).ready(function() {
    $('.menuDepl').on('click', function() {
        var id=$(this).attr('id');
        $('.'+id).queue(function() {
            $(this).clearQueue();
            if(!$(this).hasClass('despOpen') && !$('#'+id).hasClass('group')) $('.despOpen').removeClass('despOpen');
            if($('#'+id).hasClass('group')){
                if($('.'+id).hasClass('despOpen')){
                    $('#'+id).find('.plusM').html('+');
                }else{
                    $('#'+id).find('.plusM').html('-');
                }
            }
            $(this).toggleClass('despOpen', 500);
        });
    });
    $('.mobileSubMenu').on('click',function(){
        $('.accessFrame').toggle();
        if($('.accessFrame').is(':visible')){
            $(this).find('.plusM').html('-');
        }else{
            $(this).find('.plusM').html('+');
        }
    }); 
    $('#planMobile h3').on('click', function() {
        var p=$(this).parent();
        p.find('p').toggle('slow');
        });
         $('#videoMobile h3').on('click', function() {
        var p=$(this).parent();
        p.find('p').toggle('slow');
        });
 
    
});