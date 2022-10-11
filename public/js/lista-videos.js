$ = jQuery;
$(document).ready(function () {
    $('.filter__button-eje').on('click', function (e) {
        e.preventDefault();
        $('.filter__button-eje').removeClass('active');
        $('.video-titulo').text($(this).text()).show();
        $(this).addClass('active');
        let eje = $(this).attr('data-filter');
        $('.item').hide();
        $(".item[data-eje='" + eje + "']").show();
    });
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

var tech = getUrlParameter('eje');
console.log(tech);

if (tech) {
    $('.filter__button-eje').removeClass('active');
    $('.video-titulo').text($(".filter__button-eje[data-filter='" + tech + "']").text()).show();
    $(".filter__button-eje[data-filter='" + tech + "']").addClass('active');

    $('.item').hide();
    $(".item[data-eje='" + tech + "']").show();
}
