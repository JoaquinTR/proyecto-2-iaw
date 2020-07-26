$(document).ready(function() {
    $('.img-thumbnail').on('click',function(){
        $('#imagen').attr('src',$(this).attr('src'));
        $('#modal-img').modal('show');
    })
});
