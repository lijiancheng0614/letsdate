$(document).ready(function () {
    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        topDistance: '150', // Distance from top before showing element (px)
        topSpeed: 300, // Speed back to top (ms)
        animation: 'fade', // Fade, slide, none
        animationInSpeed: 300, // Animation in speed (ms)
        animationOutSpeed: 300, // Animation out speed (ms)
        scrollText: '', // Text for element
        activeOverlay: false  // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    });
    oTable = $('#data_table').dataTable({
        "sPaginationType": "full_numbers",
        "aaSorting": [
            [ 2, "desc" ]
        ],
        "aLengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "全部"]
        ],
        "bStateSave": true
    });
});
