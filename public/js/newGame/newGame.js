$(document).ready(function () {
    $('#generos').select2({
        tags:true
    });
    $('#plataformas').select2({
        tags:true
    });
    $('#editores').select2({
        tags:true
    });
    $('#desarrolladores').select2({
        tags:true
    });
    $("#datep").datepicker({
        format: 'yyyy/mm/dd',
        clearBtn:true
    });
});
