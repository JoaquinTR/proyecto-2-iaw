$(document).ready(function() {

    //indico como construir la tabla en base a los juegos recibidos
    $('#dt-images').DataTable({
        paging: true,
        autoWidth: true,
        processing: true,
        responsive: true,
        deferRender: true,
        orderClasses: false,
        scrollCollapse: true,
        ajax: {
            url: url,
            method: "GET",
            dataSrc: "",
            xhrFields: {
                withCredentials: true
            }
        },
        initComplete: function(settings, json) {
            /**
             * Funcionalidad de los links, para evitar traer todas las imágenes.
             */
            $('.stretched-link').on('click', function(e){
                e.preventDefault();

                var $this = $(this);
                console.log($this.attr('href'));

                $.ajax({
                    url: $this.attr('href'),
                    type: 'GET',
                    cache: false,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(result){
                        let img = "data:image/png;base64, "+result.imagen;
                        $('#imagen').attr("src",img);
                        $('#modal-img').modal("show");
                    },
                    //If there was no resonse from the server
                    error: function(jqXHR, textStatus, errorThrown){
                        alert("ocurrió un error: "+errorThrown);
                    }
                });
            });
        },
        columns: [
        {
            data: 'id',
            class: 'text-center',
            name: 'id',
            render: function ( data, type, row ) {
                return  data;
            }
        },
        {
            data: 'nombre_vista',
            class: 'text-center',
            render: function ( data, type, row ) {
                return data;
            }
        },
        {
            data: 'juego_id',
            class: 'text-center',
            render: function ( data, type, row ) {
                return data;
            }
        },
        {
            class: 'p-0',
            class: 'text-center',
            render: function ( data, type, row ) {
                return  `<div class="position-relative">
                            <a id="link_imagen" href="${urlVer.replace(/:id/g, ""+row.id)}" class="text-info stretched-link">
                                ver imágen
                            </a>
                        </div>`;
            }
        },
        {
            class: 'text-center',
            render: function ( data, type, row ) {
                let id = row.id;
                return  plantillaForm.replace(/:id/g, ""+id);
            }
        }

        ]
    });

    $('#modal-img').on('hidden.bs.modal', function () {
        $('#imagen').attr("src",'');
    });

});

/**
 * Controla la confirmación de eliminado.
 */
function showConfirmacion(elemento){
    const modal = new Promise(function(resolve) {
        $("#modal_confirmar").modal("show");

        $("#modal_confirmar_cerrar").click(function() {
            resolve(false);
        });

        $("#modal_confirmar_eliminar").click(function() {
            resolve(true);
        });

        $('#modal_confirmar').on('hidden.bs.modal', function() {
            resolve(false);
        });

    }).then(function(seleccion) {
        $("#modal_confirmar").modal("hide");
        if(seleccion){
            $('form[name='+elemento.getAttribute("form")+']').submit();
        }
    });
}
