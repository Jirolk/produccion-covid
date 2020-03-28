<?php
require_once("../conexcion.php");
session_start();                    //Iniciamos o Continuamos la sesion
unset($_SESSION["nivelUsuario"]);   //Destruye la variable nivelUsuario
session_destroy();                  //Destruye la informacion de la session actual
session_start();

$user = $_POST['loginname'];
$contrasena = $_POST['password'];
if ($user == null || $user == "") {
        echo "No está autorizado para acceder al sistema!!...";
}else {
    $conexion = conectar();
    $sql = "SELECT u.Id_usuario, u.Nick, u.Passwd, r.Rol,u.Estado FROM users u
    INNER JOIN roles r ON r.Id_rol= u.Id_rol
    WHERE  u.Nick = '$user' AND u.Passwd = BINARY '$contrasena'";

    $resultado = mysqli_query($conexion, $sql);

    $totRegistros = mysqli_num_rows($resultado);
    if ($totRegistros == 0){
        $_SESSION["usuarioValido"] = "no"; //Usuario o contraseña no valido
    }else{
        foreach ($resultado as $row) {
            $nombre   = $row['Nick'];
            $rol      = $row['Rol'];
            $paswd    = $row['Passwd'];
            $Id_user  = $row['Id_usuario'];
            $estado   = $row['Estado'];
        }
        if($estado == "Activo"){

          $_SESSION["usuarioValido"] = "si"; //Usuario y contraseña valido
          $_SESSION["nombreUsuario"] = $nombre;
          $_SESSION["nivelUsuario"]  = $rol;
          $_SESSION["usuario"]       = $Id_user;
          $_SESSION["Estado"]        = $estado;
        //   actualizacion del estado en bd
          $sql = "UPDATE users SET Estado=2 WHERE Id_usuario='$Id_user'";
          $resul = mysqli_query($conexion, $sql);
        }else{

          $_SESSION["usuarioValido"] = "noo";

        }
    }
    header("Location:../carga-dup.php");

}
?>
