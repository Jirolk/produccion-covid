$(document).ready(function(){
    tablaPersonas = $("#tablaInfectados").DataTable({
        // "columnDefs":[{
        //     "targets": -1,
        //     "data": null,
        //     // "defaultContent": '<div class="text-center"><div class="btn-group"><button class="btn btn-primary btnEditar">Editar</button> <button class="btn btn-danger btnBorrar">Eliminar</button></div></div>'
        // }],
        
        // dom:'Bfrtip',
        "lengthMenu":[
            [5,10,20,-1],[5,10,20,"Todos"]
        ],
        // buttons:[
        //     'pageLength'
        // ],

        "order":[[0,"desc"]],
        // cambio de idioma
        "language":{
             "lengthMenu" : "Mostar _MENU_ Registros",
             "pageLength": "Mostar _MENU_ Registros",
            "zeroRecords" : "No se encontraron resultados",
            "info" : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty" : "Mostrando registros del 0 al 0 de un total de _MAX_ registros",
            "infoFiltered" : "(Filtrando de un Total de _MAX_ registros)" ,
            "sSearch" : "Buscar: ",
            "oPaginate" :{
                "sFrist" :"Primero",
                "sLast" : "Ultimo",
                "sNext" :"Siguiente",
                "sPrevious" :"Anterior"
            },
            "sProcessing" :"Procesando...",
        },
        
    });

});