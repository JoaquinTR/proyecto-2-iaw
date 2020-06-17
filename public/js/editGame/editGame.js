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

    //seteo los valores predefinidos de los componentes select2
    let generos = JSON.parse(juego.genero);
    let plataformas = JSON.parse(juego.plataforma);
    let editores = JSON.parse(juego.editor);
    let desarrollador = JSON.parse(juego.desarrollador);
    $('select[name$="generos_id[]"').val(generos).change();
    $('select[name$="plataformas_id[]"').val(plataformas).change();
    $('select[name$="editores_id[]"').val(editores).change();
    $('select[name$="desarrolladores_id[]"').val(desarrollador).change();
});
