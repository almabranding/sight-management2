$(function() {
    var masorny = document.querySelector('#masorny');
    var msnry = new Masonry(masorny, {
        // options
        columnWidth: 163,
        isFitWidth: true,
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