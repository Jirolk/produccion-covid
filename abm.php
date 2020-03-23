<?php
include_once "conexcion.php";
$fecha = ($_POST['fecha']);
$infectados = ($_POST['infectados']);
$opcion = ($_POST['opcion']);




switch ($opcion) {
    case 1:
        // primeramente inserta los datos de fecha e infectados        
        $consulta = "insert into informegeneral(fecha,infectados)
        values ('$fecha','$infectados')";
        $resul = mysqli_query(conectar(), $consulta);
        // realizas las siguientes consultas con operaciones especificas
        $t = "SELECT (SELECT totalDia FROM informegeneral WHERE fecha =(SELECT DATE (MAX(fecha)-1)
            FROM informegeneral )) + (SELECT infectados FROM informegeneral
            WHERE fecha =(SELECT MAX(fecha) FROM informegeneral )) AS Total  FROM informegeneral LIMIT 1";
        // el total de infectados en el Día
        $total = mysqli_query(conectar(), $t);
        foreach ($total as $fila) {
            $total = $fila['Total'];
        }
        // $data[] = [$total, $factor, $promedio];
        $id = 0;
        $co = "SELECT max(idInforme) as id FROM informegeneral";
        $resul = mysqli_query(conectar(), $co);
        foreach ($resul as $fila) {
            $id = $fila['id'];
        }
        // inserta en la base de datos con los resultados esperados
        $consulta = "Update informegeneral SET totalDia='$total' where idInforme='$id'";
        $resul = mysqli_query(conectar(), $consulta);
        // ===============================consulta para hallar el factor===================================
        $f = "SELECT (SELECT totalDia FROM informegeneral 
        WHERE fecha=(SELECT MAX(fecha) AS hoy FROM informegeneral) LIMIT 1)/(SELECT totalDia AS ayer FROM informegeneral 
            WHERE fecha=(SELECT DATE (MAX(fecha)-1) AS ayer FROM informegeneral LIMIT 1)) AS factor FROM informegeneral LIMIT 1";
        // halla el factor de contagio
        $factor = mysqli_query(conectar(), $f);
        foreach ($factor as $fila) {
            $factor = $fila['factor'];
        }
        $consulta = "Update informegeneral SET factor='$factor' where idInforme='$id'";
        $resul = mysqli_query(conectar(), $consulta);
        // =============================================Consulta para halla el promedio===============================
        $p = "SELECT AVG(factor) AS promedio FROM informegeneral"; // halla el promedio        
        $promedio = mysqli_query(conectar(), $p);
        foreach ($promedio as $fila) {
            $promedio = $fila['promedio'];
        }
        $consulta = "Update informegeneral SET promedioFactor='$promedio' where idInforme='$id'";
        $resul = mysqli_query(conectar(), $consulta);
        // ====================================================enviar datos para la visualizacion==========================

        $pr ="SELECT promedioFactor * totalDia as posibles FROM informegeneral 
        WHERE fecha=(SELECT MAX(fecha) AS ayer FROM informegeneral)";
        $resul = mysqli_query(conectar(), $pr);
        foreach ($resul as $fila) {
            $posible = $fila['posibles'];
        }

        
        $consulta = "SELECT * FROM informegeneral ORDER BY idInforme DESC LIMIT 1";
        $resul = mysqli_query(conectar(), $consulta);

        foreach ($resul as $fila) {
            //  $data = array('fecha'=> $fila['fecha'],
            //                  'infectados' => $fila['infectados'],
            //                  'totalDia'=> $fila['totalDia'],
            //                  'factor'=> $fila['factor'],
            //                  'promedioFactor'=>$fila['promedioFactor']) ;
            $data[] = $fila;
        };
        $data[]=$posible;
        echo json_encode($data); //enviar el array final en formato json a JS
        mysqli_close(conectar());


        break;
    case 2:
        $id = ($_POST['id']);
        $consulta = "Update informeGeneral SET fecha='$fecha',infectados='$infectados' where idInforme= '$id'";
        $resul = mysqli_query(conectar(), $consulta);

        $consulta = "SELECT idInforme,fecha,infectados FROM informegeneral where idInforme='$id";
        $resul = mysqli_query(conectar(), $consulta);

        foreach ($resul as $fila) {
            $data[] = $fila;
        };
        break;
    case 3:
        $id = ($_POST['id']);
        $consulta = "delete from informegeneral where idInforme = '$id'";
        $resul = mysqli_query(conectar(), $consulta);
        break;
}


// $consulta="SELECT * FROM informegeneral ORDER BY idInforme DESC LIMIT 1";
