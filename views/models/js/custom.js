$(function() {
    var masorny = document.querySelector('#masorny');
    var msnry = new Masonry(masorny, {
        // options
        columnWidth: 173,
        isFitWidth: true,
        itemSelector: '.item'
    });
});
$(function() {
    $("#tags").autocomplete({
        source: availableTags,
        select: function(event, ui) {
            window.location.href = ui.item.value;
        },
        response:function(event, ui) {
            $("#search ul li > ul").hide();
        },
        close: function(event, ui) {
            $("#search ul li > ul").removeAttr('style');
        }
    });
});