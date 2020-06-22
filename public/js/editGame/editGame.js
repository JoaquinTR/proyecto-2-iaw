$(document).ready(function () {
    juego='';
    $('#reset-form').on('click', function(){
        initInputs(juego);
    })
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

    $.ajax({
        url: url,
        /* data: data, */
        dataType: "json"
      }).done(function( data ) {
        juego=data;
        initInputs();
      });
});

/**
 * Setea los valores predefinidos de los componentes select2 y de los input comunes.
 */
function initInputs(){
    let generos = JSON.parse(juego.genero);
    let plataformas = JSON.parse(juego.plataforma);
    let editores = JSON.parse(juego.editor);
    let desarrollador = JSON.parse(juego.desarrollador);
    $('select[name$="generos_id[]"]').val(generos).change();
    $('select[name$="plataformas_id[]"]').val(plataformas).change();
    $('select[name$="editores_id[]"').val(editores).change();
    $('select[name$="desarrolladores_id[]"]').val(desarrollador).change();

    $('input[name$=nombre]').val(juego.nombre);
    $('input[name$=desc]').val(juego.descripcion);
    $('input[name$=imagen]').val(juego.imagen);
    $('input[name$=imagen]').val(juego.imagen);
    $('input[name$=date]').val(juego.fecha_lanzamiento);
}
