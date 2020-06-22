$(document).ready(function() {
    //indico como construir la tabla en base a los juegos recibidos
    $('#dt-user').DataTable({
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
        columns: [
        {
            data: 'id',
            class: 'text-center',
            render: function ( data, type, row ) {
                return  data;
            }
        },
        {
            data: 'name',
            class: 'text-center',
            render: function ( data, type, row ) {
                return data;
            }
        },
        {
            data: 'email',
            class: 'text-center',
            render: function ( data, type, row ) {
                return data;
            }
        },
        {
            data: 'type',
            class: 'text-center',
            render: function ( data, type, row ) {
                return data;
            }
        },
        {
            data: 'email_verified_at',
            class: 'text-center',
            render: function ( data, type, row ) {
                let ret = "no";
                if(data)
                    ret = "si";
                if(row.type =="admin")
                    ret = "--";
                return ret;
            }
        },
        {
            data: 'created_at',
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
