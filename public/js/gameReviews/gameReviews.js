$(document).ready(function() {
    var urls = window.location.href;
    var url = new URL(urls);
    var p = url.searchParams.get("page");
    if(p || urls.includes("recientes") || urls.includes("viejos") || urls.includes("calif_baja") || urls.includes("calif_alta")){
        //si toque en el navegador del paginado, me voy hasta el fondo
        window.scrollTo(0,$('.nav.nav-tabs.card-header-tabs').offset().top - 90);
    }
    $('#puntaje').val(null);
    $('.hover').on('click',function(){  //manejo de puntaje
        $('#puntaje-meter').width($(this).html()*10+"%");
        $('#puntaje').val($(this).html());
        $('.selectedValue').removeClass('selectedValue');
        $(this).addClass('selectedValue');
    });
});
