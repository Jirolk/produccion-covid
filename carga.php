<?php
include_once 'conexcion.php';
$conectar =  conectar();


$consulta = "Select idInforme, fecha, infectados, totalDia,factor,promedioFactor
From informegeneral
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
    <script src="js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>

    <script src="js/darck.js"></script>
    <script>
          DarkReader.enable({
               brightness: 100,
               contrast: 120,
               sepia: 10
          });
          // DarkReader.disable(); // PARA CANCELAR O DETENERLO // PODENOS PONER UN BOTON EN ALGUN LUGAR PARA ELLO ALGUN DIA....
        DarkReader.auto(false);
    </script>
    
</head>

<body class="bg-light">
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

  <button type="button" onclick="window.location='/produccion-covid/cerrarSesion.php'" name="button">CERRAR SESION</button>

    <div class="container shadow mt-1">
        <h1>Carga de Datos</h1>
    </div>

    <div class="container">


        <!-- <div class="card shadow text-dark bg-light mb-3"> -->
        <div class="card-header">TABLA DE SEGUIMIENTO</div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <button id="btnNuevo" type="button" class="btn btn-success mt-2" >Agregar</button>
                </div>
            </div>
        </div>
        <!-- <div class="card-body"> -->
        <?php require_once "tablaInfectado.php"; ?>
        <!-- </div> -->
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
                                    <label for="fecha" class="col-form-label bold font-weight-bold"> FECHA:</label>
                                    <input type="date" class="form-control" id="fecha">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="infectados" class="col-form-label bold font-weight-bold"> infectados:</label>
                                    <input type="text" class="form-control" id="infectados">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>
<script src="js/datatables.min.js"></script>
<script src="js/tabla.js"></script>
<script src="js/script.min.js"></script>

</html>
