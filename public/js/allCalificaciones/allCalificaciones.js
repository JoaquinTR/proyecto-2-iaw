$(document).ready(function() {

    $('#dt-calificacion').DataTable({
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
            /**
             * Funcionalidad de los links, para evitar tener un contenido enorme en la tabla.
             */
            $('.stretched-link').on('click',function(event){
                let celda = event.currentTarget.parentElement.parentElement; //celda de la datatable
                let contenido = $('#dt-calificacion').dataTable().api().cell(celda).data();    //datos de la celda

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
            data: 'reseña',
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
            data: 'puntaje',
            class: 'text-center',
            render: function ( data, type, row ) {
                return data;
            }
        },

        {
            data: 'tipo',
            class: 'text-center',
            render: function ( data, type, row ) {
                return data;
            }
        },
        {
            data: 'updated_at',
            class: 'text-center',
            render: function ( data, type, row ) {
                let ret = "";
                if(data){
                    let date = new Date(data);
                    ret += date.toLocaleString();
                }

                return ret;
            }
        },
        ]
    });

});
