$(document).ready(function() {

    //indico como construir la tabla en base a los juegos recibidos
    $('#dt-pedido').DataTable({
        paging: true,
        autoWidth: false,
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
            $('.stretched-link').on('click',function(event){
                let celda = event.currentTarget.parentElement.parentElement; //celda de la datatable
                let contenido = $('#dt-pedido').dataTable().api().cell(celda).data();    //datos de la celda
                if(contenido.includes("[")){
                    contenido = contenido.replace(/(\[|\]|\")/g,''); //elimino los corchetes
                    temp = contenido.split(",");
                    contenido ="";
                    for(idx in temp){
                        contenido+= `<div class="p-1"><span class="badge badge-dark"><h6 class="mb-0">${temp[idx]}</h6></span></div> `;
                    }
                }
                $('#modal-info-content').html(contenido);
                $('#modal-info').modal("show");
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
            data: 'users_id',
            class: 'text-center',
            name: 'id',
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
            data: 'fecha_lanzamiento',
            class: 'text-center',
            render: function ( data, type, row ) {
                return data;
            }
        },
        {
            data: 'genero',
            class: 'p-0',
            render: function ( data, type, row ) {
                let dataF = (data.length<=20) ? data : data.substring(0,10)+"[...]";
                return  `<div class="position-relative px-1">
                            <a href="#" class="text-info stretched-link">
                                ${dataF}
                            </a>
                        </div>`;
            }
        },
        {
            data: 'descripcion',
            class: 'p-0',
            render: function ( data, type, row ) {
                let dataF = (data.length<=20) ? data : data.substring(0,10)+"[...]";
                return  `<div class="position-relative px-1">
                            <a href="#" class="text-info stretched-link">
                                ${dataF}
                            </a>
                        </div>`;
            }
        },
        {
            data: 'plataforma',
            class: 'p-0',
            render: function ( data, type, row ) {
                let dataF = (data.length<=20) ? data : data.substring(0,10)+"[...]";
                return  `<div class="position-relative px-1">
                            <a href="#" class="text-info stretched-link">
                                ${dataF}
                            </a>
                        </div>`;
            }
        },
        {
            data: 'editor',
            class: 'p-0',
            render: function ( data, type, row ) {
                let dataF = (data.length<=20) ? data : data.substring(0,10)+"[...]";
                return  `<div class="position-relative px-1">
                            <a href="#" class="text-info stretched-link">
                                ${dataF}
                            </a>
                        </div>`;
            }
        },
        {
            data: 'desarrollador',
            class: 'p-0',
            render: function ( data, type, row ) {
                let dataF = (data.length<=20) ? data : data.substring(0,10)+"[...]";
                return  `<div class="position-relative px-1">
                            <a href="#" class="text-info stretched-link">
                                ${dataF}
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
