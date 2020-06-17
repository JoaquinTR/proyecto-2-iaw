$(document).ready(function() {

    //indico como construir la tabla en base a los juegos recibidos
    $('#dt-juego').DataTable({
        paging: true,
        autoWidth: true,
        processing: true,
        responsive: true,
        deferRender: true,
        orderClasses: false,
        scrollCollapse: true,
        data: juegos,
        columns: [
        {
            data: 'id',
            class: 'text-center',
            attribute: 'data-id=100',
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
                let dataF = (data.length<=20) ? data : data.substring(0,20)+"[...]";
                return  `<div class="position-relative p-3">
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
                let dataF = (data.length<=20) ? data : data.substring(0,20)+"[...]";
                return  `<div class="position-relative p-3">
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
                let dataF = (data.length<=20) ? data : data.substring(0,20)+"[...]";
                return  `<div class="position-relative p-3">
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
                let dataF = (data.length<=20) ? data : data.substring(0,20)+"[...]";
                return  `<div class="position-relative p-3">
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
                let dataF = (data.length<=20) ? data : data.substring(0,20)+"[...]";
                return  `<div class="position-relative p-3">
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

    $('.stretched-link').on('click',function(event){
        let celda = event.currentTarget.parentElement.parentElement; //celda de la datatable
        let contenido = $('#dt-juego').dataTable().api().cell(celda).data();    //datos de la celda
        if(contenido.includes("[")){
            //console.log(datos.splice())
            contenido = contenido.replace(/(\[|\]|\")/g,''); //elimino los corchetes
            temp = contenido.split(",");
            contenido ="";
            for(idx in temp){
                contenido+= `<div class="p-1"><span class="badge badge-dark"><h6 class="mb-0">${temp[idx]}</h6></span></div> `;
            }
            console.log(contenido);
        }
        $('#modal-info-content').html(contenido);
        $('#modal-info').modal("show");
    });
});
