<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <script src="js/darck.js"></script>
          <script type="text/javascript">
                DarkReader.enable({
                     brightness: 100,
                     contrast: 100,
                     sepia: 10
                });
                // DarkReader.disable(); // PARA CANCELAR O DETENERLO // IDEA: PODENOS PONER UN BOTON EN ALGUN LUGAR PARA ELLO ALGUN DIA....
          </script>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <title>Covid 19</title>
          <link rel="icon" type="image/png" href="img/virus.png"/>
          <link rel="stylesheet" href="css/bootstrap.min.css">
          <script src="js/jquery-3.4.1.min.js"></script>
          <script src="alertify/alertify.min.js"></script>
          <!-- Boostrap -->
          <script src="bt/bootstrap.min.js"></script>
          <!-- Font-Adswesome -->
          <link rel="stylesheet" href="font/font-awesome.min.css">
          <style media="screen">
               #panelAcceso{
                   max-width: 400px;
                   margin: auto;
                   margin-top: 3%;
                   border:1px solid;
                   border-color: #FF0000!important;
                   box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)!important;
                   text-align:center;
               }

               .form-control:focus {
                   border-color: #FF0000!important;
                   box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)!important;

               }
               #logo{
                   width: 70%;
               }

          </style>
          <!-- TEMA OSCURO -->
     </head>
     <body class="container" style="background-color:rgba(0, 0, 0,0);">
          <?php session_start(); ?>
          <script>
              $(document).ready(function(){
                  var usuValido = "<?php echo isset($_SESSION['usuarioValido']) ? $_SESSION['usuarioValido'] : '0'; ?>";
                  // var usuNivel  = "<?php echo isset($_SESSION['nivelUsuario']) ? $_SESSION['nivelUsuario'] : '0'; ?>";
                  if(usuValido == 'no'){
                       alertify.error("El Usuario o contraseña!!!");
                  }else if(usuValido == 'noo'){
                       alertify.error("El usuario se encuentra logeado o desactivado actualmente!!!");
                  }else if (usuValido == "si"){
                          window.location="carga.php";
                  }
              });
          </script>

          <div id="panelAcceso" class="panel panel-danger">
            <div class="panel-heading bg-danger">
                <h1 id="titulo" class="panel-title text-center"><b>Acceso al Sistema</b></h1>
            </div>
              <div class="panel-body ">
                  <form style="background-color:rgba(25, 26, 27,0.95);" id="formAcceso" method="post" action="servicios/validarAcceso.php">
                    <div class="col-md-12">
                      <img id="logo" src="img/logo.jpeg" alt=""/>
                    </div>
                      <div class="row" align="center">
                      </div>
                      <br>
                      <div class="form-group row">
                          <div class="col-12">
                              <div style="color: white;" class="form-group">
                                  <div class="input-group col-12">
                                      <input class="form-control" placeholder="Usuario" id="loginname" name="loginname" type="text" autocomplete="off" min="0" autofocus/>
                                  </div>
                                  <br>
                                  <div class="input-group col-12 ">
                                      <input class="form-control" placeholder="Contraseña" id="password" name="password" type="password" value="" onkeypress="enter(event)">
                                  </div>
                                  <br>
                                  <div class="col-12">
                                       <button type="button" onclick="validarCampos();" id="botonIngresar" class="btn btn-lg btn-danger btn-block"><b>Ingresar</b>
                                       </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>

          <script type="text/javascript">

              function validarCampos() {
                 if($("#loginname").val()===""){
                      alertify.error("Usuario no puede estar vacio.");
                      $("#loginname").focus();
                  }else if($("#password").val()===""){
                     alertify.error("Contraseña no puede estar vacio.");
                      $("#password").focus();
                  }else{
                      $("#formAcceso").submit();
                  }
              }
              //--------------------------------------------------------------------------------------
              function enter(e) {
                  tecla = (document.all) ? e.keyCode : e.which;
                  if (tecla==13){
                      validarCampos();
                  }
              }
              //--------------------------------------------------------------------------------------
          </script>


     </body>
</html>
