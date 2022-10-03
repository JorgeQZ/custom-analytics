$ = jQuery;
$(document).ready(function () {
    $('.filter__button-eje').on('click', function (e) {
        e.preventDefault();
        let eje = $(this).attr('data-filter');
        $('.item').hide();
        $(".item[data-eje='" + eje + "']").show();
    });
});