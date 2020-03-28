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
    <title>Carga de Datos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/alertify.min.css">
    <link rel="stylesheet" href="css/default.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="icon" href="img/virus.png" type="image/png">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/alertify.min.js"></script>
    <script src="js/datatables.min.js"></script>
	
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
	
</head>
<style>
#div-cookies {
    position: fixed;
    bottom: 0px;
    left: 0px;
    width: 100%;
    background-color: white;
    box-shadow: 0px -5px 15px gray;
    padding: 7px;
    text-align: center;
    z-index: 99;
}
</style>
<body>
    <div id="div-cookies" style="display: none;">
    Necesitamos usar cookies para que funcione todo, si permanece aquí acepta su uso, más información en
    la
    <a hreflang="es" href="politica-privacidad.php" target="_blank">Política de Privacidad</a>.
    <button type="button" class="btn btn-sm btn-primary" onclick="acceptCookies()">
    Acepto el uso de cookies
    </button>
    </div>
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
            <p class="text-center mt-3"><b>Observación:</b> Solo la última fecha registrada se podrá modificar o eliminar. Sea atento a la hora de ir cargando los datos.</p><hr>
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
                                    <input type="date" disabled class="form-control" id="fecha">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="infectados" class="col-form-label bold font-weight-bold">Cantidad de Infectados:</label>
                                    <input type="number" onkeydown="if (event.keyCode == 13){ document.getElementById('muertes').focus(); return false;}" class="form-control" id="infectados" autocomplete="off" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="infectados" class="col-form-label bold font-weight-bold">Cantidad de Muertes:</label>
                                    <input type="number" class="form-control" id="muertes" onkeydown="if (event.keyCode == 13){ document.getElementById('recuperados').focus(); return false;}" autocomplete="off" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="infectados" class="col-form-label bold font-weight-bold">Cantidad de Recuperados:</label>
                                    <input type="number" class="form-control" id="recuperados" onkeydown="if (event.keyCode == 13){ document.getElementById('btnGuardar').focus(); return false;}" autocomplete="off" min="0" value="0">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="alertify.warning('Operación Cancelada');">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

<script>
    /* ésto comprueba la localStorage si ya tiene la variable guardada */
    function checkAcceptCookies() {
        if (localStorage.acceptCookies == 'true') {} else {
            $('#div-cookies').show();
        }
    }

    function acceptCookies() {
        localStorage.acceptCookies = 'true';
        $('#div-cookies').hide();
    }
    $(document).ready(function() {
        checkAcceptCookies();
    });
	
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
   	
     //document.getElementById("menu").style.display="none";//oculto el detalle del menu
     $(document).ready(function () {
        tablaInf = $("#tablaInf").DataTable({
            "order": [[0, "desc"]],
            "columnDefs": [
                {"targets":[1,2,3,4,5],"className": "dt-body-center"},
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
            document.getElementById("infectados").focus();
            $("#fecha").val($("#maxfecha").val());
            opcion = 1;
        });

        $(document).on("click", ".btnEditar", function () {
            fila = $(this).closest("tr");
            id = parseInt(fila.find('td:eq(0)').text());
            date = fila.find('td:eq(1)').text();
            infectados = fila.find('td:eq(2)').text();
            falledias = fila.find('td:eq(4)').text();
            recuperadia = fila.find('td:eq(6)').text();
            var fecha = date.split("/").reverse().join("-");//falta capturar el resto y depostiar
            $("#fecha").val(fecha);
            $("#infectados").val(infectados);
            $("#muertes").val(falledias);
            $("#recuperados").val(recuperadia);
            opcion = 2;
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-title").text("Editar Registro de Infectados");
            $('#modalCrud').modal({backdrop: 'static', keyboard: false, show:true});

        });

        $(document).on("click", ".btnBorrar", function () {
            opcion = 3;
            fila = $(this);
            id = parseInt($(this).closest("tr").find('td:eq(0)').text());
            fecha = $(this).closest("tr").find('td:eq(1)').text();
            var confirm = alertify.confirm('Atención',"¿Estas Seguro de Eliminar los Registros de la Fecha: " + fecha + "?",null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});
            confirm.set({transition:'slide'});  
            confirm.set('onok', function(){ //callbak al pulsar botón positivo
                $.ajax({
                    url: "abm.php",
                    type: "POST",
                    datatype: "json", 
                    data: { opcion: opcion, id: id },
                    success: function () {
                        alertify.alert('Atención', 'Registro Eliminado con éxito!', function(){ location.reload(); });
                    }
                });
            });
            confirm.set('oncancel', function(){ //callbak al pulsar botón negativo
                alertify.warning('Operación Cancelada!');
            });
        });

        $("#formDatos").submit(function (e) {
            // evita que se recarge la pagina
            e.preventDefault();
            fec = $("#fecha").val();
            inf = $("#infectados").val();
            mue = $("#muertes").val();
            rec = $("#recuperados").val();
            da=0;
            if(opcion == 2){
                da = id;
            }
            $.ajax({
                url: "abm.php",
                type: "POST",
                datatype: "json",
                data: { fecha: fec, infectados: inf,falledias:mue,recuperadia:rec, opcion: opcion ,id:da},
                success: function (data) {
                    if(data == 1){
                        alertify.warning("Fecha a registrar ya existe!! Debe actualizar la página!")
                    }else if(data == 2){
                        alertify.warning("Error! Actualice la página!");
                    }else if(data == 3){
                        alertify.alert('Atención', 'Registro Guardado con éxito!', function(){ location.reload(); });
                    }else if(data == 4){
                        alertify.warning("No ha realizado ningún cambio!");
                        $("#infectados").focus();
                    }else if(data == 5){
                        alertify.alert('Atención', 'Registro Actualizado con éxito!', function(){ location.reload(); });
                    }
                }
            });
        });


    }); 
</script>

</html>