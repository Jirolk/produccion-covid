<?php
require_once("conexion.php");
session_start();                    //Iniciamos o Continuamos la sesion
// unset($_SESSION["nivelUsuario"]);   //Destruye la variable nivelUsuario
session_destroy();                  //Destruye la informacion de la session actual
session_start();

//recibo los datos
$user = $_POST['loginname'];
$contrasena = $_POST['password'];
$sucursal = $_POST['sucursal'];
if ($user == null || $user == "") {
        echo "No está autorizado para acceder al sistema!!...";
}else {
    $conexion = conexion();
    $sql = "SELECT usuario.Id_usuario,usuario.CI_func,usuario.Cod_sucursal,Funcion, Razon_social, usuario.Estado FROM usuario
    INNER JOIN sucursal ON sucursal.Cod_sucursal= usuario.Cod_sucursal
    INNER JOIN funcionario ON funcionario.CI_func= usuario.CI_func
    WHERE  usuario.CI_func = '$user' AND Pass = BINARY '$contrasena' AND usuario.Cod_sucursal = BINARY '$sucursal'" ;//fañta funcion pra saber si es admin o recepcionista
    $resultado = mysqli_query($conexion, $sql);
    $totRegistros = mysqli_num_rows($resultado);
    if ($totRegistros == 0){
        $_SESSION["usuarioValido"] = "no"; //Usuario o contraseña no valido
    }else{
        foreach ($resultado as $row) {
            $Funcion = $row['Funcion'];
            $nombre   = $row['Razon_social'];
            $estado = $row['Estado'];
            $sucursal = $row['Cod_sucursal'];
            $user = $row['Id_usuario'];
        }
        if($estado == "Ocupado" || $estado == "Despedido"){
            $_SESSION["usuarioValido"] = "noo";
        }else{
            //Se crea variables de sesion
            $_SESSION["usuarioValido"] = "si"; //Usuario y contraseña valido
            $_SESSION["nombreUsuario"] = $nombre;
            $_SESSION["nivelUsuario"]  = $Funcion;
            $_SESSION["Cod_sucursal"]  = $sucursal;
            $_SESSION["usuario"] = $user;
            $sql = "UPDATE usuario SET Estado=3 WHERE Id_usuario='$user'";
            $resul = mysqli_query($conexion, $sql);
        }
    }

    header("Location:../index.php");
}
?>
