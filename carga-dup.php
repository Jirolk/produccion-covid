<?php
include_once 'conexcion.php';
$conectar =  conectar();
$consulta = "SELECT * FROM informegeneral i
JOIN afectados a 
ON a.idInforme=i.idInforme
ORDER BY fecha DESC";
$resultado = mysqli_query($conectar, $consulta);
// $resultado->execute();
// $data=$resultado->foreach;

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga de Datos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/alertify.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="shortcut icon" href="img/virus.png" type="image/x-icon">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/alertify.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <!-- <script src="js/script.min.js"></script> -->
</head>
    <?php
            if(!isset($_SESSION)){
            session_start();
        }
    ?>
    <script type="text/javascript">
        var usuValido = "<?php echo isset($_SESSION['usuarioValido']) ? $_SESSION['usuarioValido'] : '0'; ?>";
        // alert(usuValido);
        // verificarSesion(usuValido);
        if(usuValido != "si"){
            location.href="administracion.php";
        }
    </script>

    <script src="js/idle-timer.js"></script>
    <script type="text/javascript">
     inactividad();
            function timer(time,update,complete) {
                var start = new Date().getTime();
                var interval = setInterval(function() {
                    var now = time-(new Date().getTime()-start);
                    if( now <= 0) {
                        clearInterval(interval);
                        complete();
                    }
                    else update(Math.floor(now/1000));
                },100);
            }
            //--------------------------------------------------------------------------
            function inactividad() {
                        var
                            docTimeout = 600000;
                        $(document).on("idle.idleTimer", function (event, elem, obj) {
                            window.location.href = "/produccion-covid/cerrarsesion.php";
                        });
                        $(document).idleTimer({
                          timeout: docTimeout,
                          timerSyncId: "document-timer-demo"
                        });
            }

    </script>
    <div class="container">
        <?php include_once "cabecera.php" ?>

        <h2 class="text-center mt-3" id="titulo"><b>Carga de Datos</b></h2>
        <input type="hidden" class="form-control" id="maxfecha">
        <?php
            $sql = "SELECT MAX(fecha) fecha FROM informegeneral";
            $res = mysqli_query($conectar, $sql);
            $reg = mysqli_fetch_array($res);
            $d = $reg["fecha"];
            $dia =  date("Y-m-d",strtotime($d."+ 1 days"));
            echo '<script>document.getElementById("maxfecha").value="'.$dia.'"</script>';
        ?>
            <h2 class="text-primary text-center mt-3"><b>Tabla de Seguimientos</b></h2>
            <p class="text-center mt-3"><b>Observación:</b> Solo el primer registro se podrá modificar o eliminar. Sea atento a la hora de ir cargando los datos.</p><hr>
                    <!-- boton de cerrar cesion -->
            <!-- <div class="card shadow text-dark bg-light mb-4"> -->
            <!-- <div class="card shadow text-dark bg-light mb-4">
                <button type="button" class="btn btn-mg btn-primary btn-block" onclick="window.location='/produccion-covid/cerrarSesion.php'" name="button">CERRAR SESION</button>
            </div> -->

            <?php require_once "tablaInfectado.php"; ?>
        <!-- </div> -->
    </div>
    
    <!-- ============================modal===================== -->

    <div class="modal fade" id="modalCrud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exampleModalLabel" ></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formDatos">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fecha" class="col-form-label bold font-weight-bold">Fecha de Registro:</label>
                                    <input type="date" class="form-control" id="fecha">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="infectados" class="col-form-label bold font-weight-bold">Cantidad de Infectados:</label>
                                    <input type="number" class="form-control" id="infectados" autocomplete="off" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="infectados" class="col-form-label bold font-weight-bold">Cantidad de Muertes:</label>
                                    <input type="number" class="form-control" id="muertes" autocomplete="off" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="infectados" class="col-form-label bold font-weight-bold">Cantidad de Recuperados:</label>
                                    <input type="number" class="form-control" id="recuperados" autocomplete="off" min="0" value="0">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

<script>
     <?php
            if(!isset($_SESSION)){
            session_start();
        }
    ?>
        var usuario = "<?php if (isset($_SESSION['nombreUsuario'])){
                                   echo $_SESSION['nombreUsuario']." [".$_SESSION['nivelUsuario']."]";
                              }?>";
        // alert(usuValido);
        // verificarSesion(usuValido);
        if(usuValido != "si"){
            location.href="administracion.php";
        }
    $(menu).empty() // vascia los elementos del menu en vez de ocultar el div
    document.getElementById("menu").innerHTML = "<div id='container'> <div class='card-md' style='position:absolute; right:0; bottom:0;'><a class='fa fa-user'><label>&nbspUsuario:&nbsp&nbsp"+usuario+"</label></a><br><i class='fa fa-power-off' onclick='window.location=\"/produccion-covid/cerrarSesion.php\"' style='cursor:pointer'><a  onclick='window.location='/produccion-covid/cerrarSesion.php'>&nbspCerrar sesión</a></i></div></div>";
   
     $(document).ready(function () {
        tablaInf = $("#tablaInf").DataTable({
            "order": [[0, "desc"]],
            "columnDefs": [
                {"targets":[1,2,3,4,5],"className": "dt-body-center"},
                {"targets": [0 ],"visible": false,"searchable": false},
                {
                /* "targets": -1,
                "data": null,
                "defaultContent": '<div class="text-center "><div class="btn-group"><button class="btn btn-info  btnEditar"><i class="fa fa-pencil" aria-hidden="true"></i></button> <button class="btn btn-danger btnBorrar"><i class="fa fa-trash" aria-hidden="true"></i></button></div></div>' */
            }],
            "lengthMenu":[
                [5,10,20,-1],[5,10,20,"Todos"]
            ],
            dom: 'Blfrtip',
            //  cambio de idioma
            "language": {
                "lengthMenu": "Mostar _MENU_ Registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de _MAX_ registros",
                "infoFiltered": "(Filtrando de un Total de _MAX_ registros)",
                "sSearch": "Buscar: ",
                "paginate": {
                    "first":			"Primera",
                    "last":			"Última",
                    "next":			"Siguiente",
                    "previous":		"Anterior"
                },
                "sProcessing": "Procesando...",
            },
            buttons: [
                {
                    text: "<i class='fa fa-plus' aria-hidden='true'> Nuevo Registro</i>",
                    attr:{
                        class:"btn btn-info",
                        id: "btnNuevo"
                    }
                }
        ]
        });

        $("#btnNuevo").click(function () {
            $("#formDatos").trigger("reset");
            $(".modal-header").css("background-color", "#28a745");
            $(".modal-title").text("Nuevo Registro de Infectados");
            //$("#modalCrud").modal("show");}
            $('#modalCrud').modal({backdrop: 'static', keyboard: false, show:true});
            $("#fecha").val($("#maxfecha").val());
            document.getElementById("fecha").disabled = true;
            opcion = 1;
        });

        $(document).on("click", ".btnEditar", function () {
            fila = $(this).closest("tr");
            id = parseInt(fila.find('td:eq(0)').text());
            fecha = fila.find('td:eq(1)').text();
            infectados = fila.find('td:eq(2)').text();

            $("#fecha").val(fecha);
            $("#infectados").val(infectados);
            opcion = 2;
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-title").text("Editar Infectados");
            $("#modalCrud").modal("show");

        });

        $(document).on("click", ".btnBorrar", function () {
            opcion = 3;
            fila = $(this);
            id = parseInt($(this).closest("tr").find('td:eq(0)').text());
            var respuesta = confirm("¿Estas Seguro de borrar el id=" + id + "?");
            if (respuesta) {
                $.ajax({
                    url: "abm.php",
                    type: "POST",
                    datatype: "json", 
                    data: { opcion: opcion, id: id },
                    success: function () {
                        tb = $("#tablaInf").DataTable();
                        tb.row(fila.parents('tr')).remove().draw();
                    }
                });
            }
        });

        $("#formDatos").submit(function (e) {
            // evita que se recarge la pagina
            e.preventDefault();
            fec = $("#fecha").val();
            inf = $("#infectados").val();
            mue = $("#muertes").val();
            rec = $("#recuperados").val();
            $.ajax({
                url: "abm.php",
                type: "POST",
                datatype: "json",
                data: { fecha: fec, infectados: inf,falledias:mue,recuperadia:rec, opcion: opcion },
                success: function (data) {
                    //alert("holaa"+ data);
                    if(data == 1){
                        alertify.warning("Fecha a registrar ya existe!! Debe actualizar la página!")
                    }else if(data == 2){
                        alertify.warning("Error! Actualice la página!");
                    }else{
                        /*var datos = JSON.parse(data);
                        fecha = datos[0].fecha;
                        infec = datos[0].infectados;
                        total = datos[0].totalDia;
                        factor = datos[0].factor;
                        promedio = datos[0].promedioFactor;
                        posibles = datos[0].posible;
                        id=datos[0].idInforme;*/
                        //alert(data);
                        alertify.alert('Atención', 'Registro Guardado con éxito!', function(){ location.reload(); });
                        //alert("aca"+datos[0].idInforme);
                        
                       /* tb = $("#tablaInf").DataTable();
                        if (opcion == 1) {
                            id='<td hidden>'+id+'</td>';
                            infec = "<td style='background:rgb(0, 255,0,0.6);color:white;'>"+infec+"</td>";
                            tb.row.add([id,fecha, infec,total,factor,promedio]).draw(false);
                            alert("Posibles Casos"+posibles);

                            //document.getElementById('posiblecaso').innerHTML=posibles;
                        }else{
                            id='<td hidden>'+id+'</td>';
                            tb.row(fila).data([id,fecha, infec, "", "", "",""]).draw(false);
                        }  */
                    }
                }
            });
            $("#modalCrud").modal("hide");
        });


    }); 
</script>

</html>