$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});

$(document).ready(function (color) {
    $('#color').on('click', function () {
        $('#color').backgroundColor= 'red'
        $(this).toggleClass('active');
    });
});
