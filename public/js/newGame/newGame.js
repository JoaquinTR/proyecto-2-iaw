$(document).ready(function () {
    $('#generos').select2({
        tags:false
    });
    $('#plataformas').select2({
        tags:false
    });
    $('#editores').select2({
        tags:false
    });
    $('#desarrolladores').select2({
        tags:false
    });
    $("#datep").datepicker({
        format: 'yyyy/mm/dd',
        clearBtn:true
    });
});
