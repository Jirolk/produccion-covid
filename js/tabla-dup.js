$(document).ready(function(){
    tablaPersonas = $("#tablaInfec").DataTable({
        // "columnDefs":[{
        //     "targets": -1,
        //     "data": null,
        //     // "defaultContent": '<div class="text-center"><div class="btn-group"><button class="btn btn-primary btnEditar">Editar</button> <button class="btn btn-danger btnBorrar">Eliminar</button></div></div>'
        // }],
        dom: 'Blfrtip',
        // dom:'frtip',
        "lengthMenu":[
            [5,10,20,-1],[5,10,20,"Todos"]
        ],
        // buttons:[
        //     'pageLength'
        // ],
        //"dom": "Ba",
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
        "buttons": [
            {
                 extend: "copyHtml5",
                 name: "copyBtn",
                 attr:{
                      class:"btn btn-danger",
                      style:"color:black;"
                 },
                 text: "<i class='fa fa-copy'> <b>Copiar</b></i>",
                 titleAttr: 'Copiar',
            },
            // 'pdfHtml5',
            {
                 extend: "pdfHtml5",
                 name: "pdfBtn",
                 attr:{
                      class:"btn btn-danger",
                      style:"color:black;"
                 },
                 text: "<i class='fa fa-file-pdf-o'><b> Exportar a PDF</b></i>",
                 titleAttr: 'pdf',
                 tittle: 'PDF-ARTICULO',
                 filename: 'Articulo-PDf',
                 orientation: 'landscape',
                 exportOptions: {
                      columns: [0,1,2,3,4,5,6]
                 },
                 customize: function(doc){
                      doc.content[1].table.widths=[
                           '15%',
                           '25%',
                           '10%',
                           '10%',
                           '10%',
                           '15%',
                           '15%'
                      ],
                      doc['footer']= (function(page,pages){
                           return {
                                columns:[
                                     {
                                          alignment:'center',
                                          text: [
                                               {text: page.toString(), italics: true}, ' de ',
                                               {text: pages.toString(), italics: true}
                                          ]
                                     }
                                ],
                                margin: [10, 0]
                           }
                      });
                 }
            },
          //   {
          //        text: "<i class='fa fa-plus' aria-hidden='true'> <b>Nuevo Artículo</b> </i>",
          //        attr:{
          //             class:"btn btn-danger",
          //             style:"color:black;"
          //        },
          //        action: function (e, dt, node, config){
          //          window.location="articulos_am.php?accion=N";
          //    }}
       ]
    });

});