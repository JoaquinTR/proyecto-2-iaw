$(document).ready(function() {
    //indico como construir la tabla en base a los juegos recibidos
    $('#dt-generos').DataTable({
        paging: true,
        autoWidth: true,
        processing: true,
        responsive: true,
        deferRender: true,
        orderClasses: false,
        scrollCollapse: true,
        data: generos,
        columns: [
        {
            data: 'id',
            class: 'text-center',
            render: function ( data, type, row ) {
                return  data;
            }
        },
        {
            data: 'nombre',
            class: 'text-center',
            render: function ( data, type, row ) {
                return data;
            }
        },
        {
            class: 'text-center',
            render: function ( data, type, row ) {
                let id = row.id;
                return  plantillaForm.replace(/:id/g, ""+id).replace(/:tipo/g,"genero");
            }
        }
        ]
    });

    //indico como construir la tabla en base a los juegos recibidos
    $('#dt-plataformas').DataTable({
        paging: true,
        autoWidth: true,
        processing: true,
        responsive: true,
        deferRender: true,
        orderClasses: false,
        scrollCollapse: true,
        data: plataformas,
        columns: [
        {
            data: 'id',
            class: 'text-center',
            render: function ( data, type, row ) {
                return  data;
            }
        },
        {
            data: 'nombre',
            class: 'text-center',
            render: function ( data, type, row ) {
                return data;
            }
        },
        {
            class: 'text-center',
            render: function ( data, type, row ) {
                let id = row.id;
                return  plantillaForm.replace(/:id/g, ""+id).replace(/:tipo/g,"plataforma");
            }
        }
        ]
    });

    //indico como construir la tabla en base a los juegos recibidos
    $('#dt-editores').DataTable({
        paging: true,
        autoWidth: true,
        processing: true,
        responsive: true,
        deferRender: true,
        orderClasses: false,
        scrollCollapse: true,
        data: editores,
        columns: [
        {
            data: 'id',
            class: 'text-center',
            render: function ( data, type, row ) {
                return  data;
            }
        },
        {
            data: 'nombre',
            class: 'text-center',
            render: function ( data, type, row ) {
                return data;
            }
        },
        {
            class: 'text-center',
            render: function ( data, type, row ) {
                let id = row.id;
                return  plantillaForm.replace(/:id/g, ""+id).replace(/:tipo/g,"editor");
            }
        }
        ]
    });

    //indico como construir la tabla en base a los juegos recibidos
    $('#dt-desarrolladores').DataTable({
        paging: true,
        autoWidth: true,
        processing: true,
        responsive: true,
        deferRender: true,
        orderClasses: false,
        scrollCollapse: true,
        data: desarrolladores,
        columns: [
        {
            data: 'id',
            class: 'text-center',
            render: function ( data, type, row ) {
                return  data;
            }
        },
        {
            data: 'nombre',
            class: 'text-center',
            render: function ( data, type, row ) {
                return data;
            }
        },
        {
            class: 'text-center',
            render: function ( data, type, row ) {
                let id = row.id;
                return  plantillaForm.replace(/:id/g, ""+id).replace(/:tipo/g,"desarrollador");
            }
        }
        ]
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
