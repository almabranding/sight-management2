var sly;
var time = 1500;
var item = 0;
var isShow=0;
var carouselPos = 0;
var $frame = $('#centered');
var $wrap = $frame.parent();
var $prev = $('#fotoPrev');
var $next = $('#fotoNext');
var rsBG;
var $options = {
    horizontal: 1,
    itemNav: 'basic',
    mouseDragging: 1,
    activateOn: 'click',
    touchDragging: 1,
    releaseSwing: 1,
    startAt: 0,
    speed: time / 2,
    elasticBounds: 0,
    easing: 'swing',
    dragHandle: 1,
    dynamicHandle: 1,
    clickBar: 1,
    prevPage: $prev,
    nextPage: $next,
};
var $optionsNull = {
    mouseDragging: 0,
    touchDragging: 0,
    dragHandle: 0,
    dynamicHandle: 0,
    clickBar: 0,
};
$.easing.smoothmove = function (x, t, b, c, d) {
return -c *(t/=d)*(t-2) + b;
 };
$(window).load(function() {
    
    $('.backgroundContainer').each(function(){
        if(isMobile.iOS() || isMobile.Android())
            var src=$(this).find('#phoneImg').html();
        else
            var src=$(this).find('#bigImg').html();
        $(this).css('background-image','url("'+src+'")');
    });
    $('.descMenu').append($('#replace').html());
    $('#replace').html(''); 
    sly = new Sly($frame, $options).init();
    resizeContainer();
    selectImage($('.bgContainer').eq(carouselPos));
    
     $('#descDown').on('click', function() {
        isShow=0;
        $('.descUpDown').toggle();
        $('.descMenu').removeClass('navBoxShow', 500);
    });
    $('.bgBigDesc').on('click', function() {
        isShow=1;
        $('.descUpDown').toggle();
        $('.descMenu').addClass('navBoxShow', 500);
    });
    $('#mblTitle').on('click', function() {
        isShow=1;
        $('#moreDescMbl').toggle();
    });
    $('#descUp').on('click', function() {
        isShow=1;
        $('.descUpDown').toggle();
        $('.descMenu').addClass('navBoxShow', 500);
    });
    $('.descMenu').on('click', function() {
        isShow=0;
        $('.descUpDown').toggle();
        $('.descMenu').removeClass('navBoxShow', 500);
    });
    $('#descClose').on('click', function() {
        returnGallery();
    });
    
    $('.bgControl').on('click', function() {
        var max = $('.bgContainer').index();
        $('.preload').show();
        if ($(this).is('#descPrev')) {
            carouselPos--;
            if (carouselPos < 0)
                carouselPos = max;
        }
        if ($(this).is('#descNext')) {
            carouselPos++;
            if (carouselPos > max)
                carouselPos = 0;
        }
        $('#fadeWhite').fadeIn(function() {
            $('.selected').removeClass('selected').removeAttr('style').find(".backgroundContainer").css({
                left: 0,
                width: 400,
                'z-index':10
            });
            selectImage($('.bgContainer').eq(carouselPos));
        });
    });
    $(window).on('resize', function() {
        resizeContainer();
    });
    $('.bgContainer').not('.selected').on('mouseenter', function() {
        var desc = $(this).find('.bgDesc');
        $('.bgDesc').removeClass('bgDescShow');
        desc.queue(function() {
            $(this).clearQueue();
            $(this).addClass('bgDescShow', 500);
            $('.bgDesc').not(this).removeClass('bgDescShow');
        });
    }).on('mouseleave', function() {
        var desc = $(this).find('.bgDesc');
        desc.queue(function() {
            $(this).clearQueue();
            $(this).removeClass('bgDescShow', 500);
        });
    });
    $('.bgContainer').not('.selected').on('click', function() {
        //selectImage($(this));

    });
    sly.on('active', function (eventName,itemIndex) {
        selectImage($('.bgContainer').eq(itemIndex));
    });
    
    $('.backgroundContainer').on('click', function() {
        if($(this).hasClass('opened')) returnGallery();
    });

});

function resizeContainer() {
    if($(window).width()<620){
        var alt=80;
        var anc=0;
    }
    else{
        var anc=40;
        var alt=60;
    }
    $('#container').css('height', $(window).height() - alt);
    $('.bgContainer.selected .backgroundContainer').css('width', $(window).width() - anc);
    $('.bgBigDesc').css('width', $(window).width() - 40);
    sly.reload();
}

function selectImage(li) {
    
    $('.frame').addClass('listOpen');
    $('.imageControl').hide();
    if(li.hasClass('selected')) return false;
    carouselPos = li.index();
    $('.bgList').css({
        position: 'absolute',
    });
    li.css({
        position: 'relative',
        margin: 0,
        'z-index': 1
    });
    sly.set($optionsNull);
    li.addClass('selected');
    var offset = li.offset();
    $('#descTitle').html(li.find('.caption').text());
    loadCufon();
    li.find(".backgroundContainer").css('z-index',14);
    rsBG=(li.find(".backgroundContainer").css('backgroundPosition'));
    if($(window).width()<620){
        var alt=80;
        var anc=0;
    }
    else{
        var anc=40;
        var alt=60;
    }
    var css={
        left: ((offset.left)*-1)+'px',
        width: $(window).width()-anc,
        backgroundPosition: '0px 0px'
    };
    li.find(".backgroundContainer").css(css);
    li.addClass('opened');
            $('#container').addClass('mobileFull');
            $('#descNav').addClass('navBoxShow', 500);
            $('.scrollbar').css('opacity',0);
            $('.preload').hide();
            $('#fadeWhite').fadeOut();
            li.parent().find(".bgBigDesc").css(css).addClass('bgDescShow', 500);
}
function returnGallery(){   
        $('.scrollbar').css('opacity',1);
        $('#descNav').removeClass('navBoxShow');
        $('.descMenu').removeClass('navBoxShow', 500).removeAttr('style');
        sly.set($options);
        $('.bgContainer.selected').parent().find(".bgBigDesc").removeClass('bgDescShow', 500);
        $('.bgContainer.selected').find(".backgroundContainer").animate(
        {
            left: 0,
            width: 400,
            'z-index':10,
            backgroundPosition:rsBG
        },
        {
            duration: time,
            step: function(now, fx) {
                //sly.reload();
            },
            complete: function() {
                $('#container').removeClass('mobileFull');
                $('.frame').removeClass('listOpen');
                $(this).removeClass('opened');
                $(this).parent().removeClass('selected').removeClass('active').removeAttr('style');
                $('.scrollbar').css('opacity',1);
                resizeContainer();
                $('.imageControl').show();
            }
        });

}