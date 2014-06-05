$(document).ready(function () {
    $('[data-toggle=offcanvas]').click(function () {
        $('.row-offcanvas').toggleClass('active')
    });
    $('[data-toggle=navbar-form]').click(function () {
        $('.navbar-form').toggleClass('hidden-xs')
    });
});