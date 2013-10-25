$(function() {
    var masorny = document.querySelector('#masorny');
    var msnry = new Masonry(masorny, {
        // options
        columnWidth: 145,
        isFitWidth: true,
        gutter: 12,
        itemSelector: '.item'
    });
});
$(function() {
    $("#tags").autocomplete({
        source: availableTags,
        select: function(event, ui) {
            window.location.href = ui.item.value;
        }
    });
});