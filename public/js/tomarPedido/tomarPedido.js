$(document).ready(function () {
    $('#generos').select2({
        tags:false,
        width: '100%'
    });
    $('#plataformas').select2({
        tags:false,
        width: '100%'
    });
    $('#editores').select2({
        tags:false,
        width: '100%'
    });
    $('#desarrolladores').select2({
        tags:false,
        width: '100%'
    });
    $("#datep").datepicker({
        format: 'yyyy/mm/dd',
        clearBtn:true
    });
});
