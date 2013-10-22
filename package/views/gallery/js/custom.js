var noSly = false;
$(window).on('resize', function() {
    var $frame = $('#centered');
    if (getWindowW() <= 670) {
        $frame.sly(false);
        noSly = true;
    } else {
        if (noSly)
            slyHorizontal();
        noSly=false;
    }
});
if (!isMobile.any() && getWindowW() > 670)
    slyHorizontal();
else
    noSly = true;

function getWindowW() {
    return  $(window).width();
}

function slyHorizontal() {

    var $frame = $('#centered');
    var $wrap = $('.frameContainer');
    // Call Sly on frame
    $frame.sly({
        horizontal: 1,
        itemNav: 'basic',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        startAt: 0,
        scrollBy: 0,
        speed: 300,
        elasticBounds: 0,
        easing: 'easeOutExpo',
        dragHandle: 1,
        dynamicHandle: 1,
        clickBar: 1,
    });
    $wrap.find('.prev').on('mouseover', function() {
        $frame.sly('moveBy', -300);
    }).on('mouseout', function() {
        $frame.sly('stop');
    });
    $wrap.find('.next').on('mouseover', function() {
        $frame.sly('moveBy', 300);
    }).on('mouseout', function() {
        $frame.sly('stop');
    });
}
(function() {
    if(!getCookie('favModels')) $('#viewFav').hide();
    getFavs();
    var $frame = $('#centered');
    var $wrap = $('.frameContainer');

   
    $('#addFav').on('click', function() {
        var idModel = $(this).attr('rel').toString();
        var favs = getCookie('favModels');
        if (favs) {
            var n = favs.split("-");
            if (jQuery.inArray(idModel, n)<0) {
                setCookie('favModels', favs + '-' + idModel);
                alert("Model has been added to favourites");$('#viewFav').show();
            }
        } else{
            setCookie('favModels', idModel);
            alert("Model has been added to favourites");$('#viewFav').show();
        }
        getFavs();
    });
}());
/*$(window).load(function() {
    setTimeout(function() {
        $("img").each(function(index) {
            orig = $(this);
            img = new Image();
            img.src = $(this).attr('src');
            $(img).load(function() {
                orig.append(img);
            });
        });


    }, 5000);
});*/
function getFavs(){
    var list=getCookie('favModels');
    if(list){ 
        $('#viewFavLink').attr('href',$('#viewFavLink').attr('rel')+list);
    }
}