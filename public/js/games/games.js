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

    $('form')
    .each(function(){
        $(this).data('serialized', $(this).serialize())
    })
    .on('change input', function(){
        $(this)
            .find('input:submit, button:submit')
                .prop('disabled', $(this).serialize() == $(this).data('serialized'))
        ;
     })
    .find('input:submit, button:submit')
        .prop('disabled', true);

    $('.card-columns .card').on('click',function(){
        window.open($(this).attr("href"),'_self');
    });
});
