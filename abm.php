<?php
include_once "conexcion.php";
$fecha = ($_POST['fecha']);
$infectados = ($_POST['infectados']);
$muertes = ($_POST['falledias']);
$recuperados = ($_POST['recuperadia']);
$opcion = ($_POST['opcion']);
switch ($opcion) {
    case 1:
        //cverifico si ya no existe en la bd
        $consulta = "SELECT idInforme from informegeneral WHERE fecha = '$fecha'";
        $resul = mysqli_query(conectar(), $consulta);
        $reg = mysqli_fetch_array($resul);
        $seguir = true;
        if($reg['idInforme'] > 0){
            $seguir = false;
            echo 1;
        }
        // primeramente verifica si los datos existen del dia anterior       o si es la primemra vez 
        if($seguir==true){
            $diaAnterior =  date("Y-m-d",strtotime($fecha."- 1 days"));
            $consulta = "SELECT idInforme FROM informegeneral WHERE fecha = '$diaAnterior'";//primera vez de carga
            $resul = mysqli_query(conectar(), $consulta);
            $reg = mysqli_fetch_array($resul);
            if($reg["idInforme"] == ""){
                $total = $infectados;
                $factor=$infectados;
                $promedio=$infectados;
                $consulta = "insert into informegeneral values ('$fecha','$infectados','$total','$factor','$promedio')";
                $resul = mysqli_query(conectar(), $consulta);
                $co = "SELECT idInforme as id FROM informegeneral WHERE fecha = '$fecha' AND infectados='$infectados'";
                $resul = mysqli_query(conectar(), $co);
                foreach ($resul as $fila) {
                    $id = $fila['id'];
                }
                $consulta = "insert into afectados values ('$id','$muertes','$muertes','$recuperados','$recuperados')";
                $resul = mysqli_query(conectar(), $consulta);
            }else{
                $consulta = "SELECT totalDia,promedioFactor FROM informegeneral WHERE fecha = '$diaAnterior'";//aun no se cargaron en la bd el factor y demas
                $resul = mysqli_query(conectar(), $consulta);
                $reg = mysqli_fetch_array($resul);
                if($reg["promedioFactor"] == ""){
                    echo 2;//aun no se cargaron y debe esperar
                }else{
                    $total = $reg["totalDia"]+$infectados;//totalDIA
                    $factor = $total / $reg["totalDia"];//factor de riesgo
                    $consulta = "insert into informegeneral(fecha,infectados, totalDia, factor)
                    values ('$fecha','$infectados','$total','$factor')";
                    $resul = mysqli_query(conectar(), $consulta);
                    $consulta= "SELECT AVG(factor) prom FROM informegeneral";
                    $resul = mysqli_query(conectar(), $consulta);
                    $reg = mysqli_fetch_array($resul);
                    $promedio = $reg["prom"];//promedio
                    $consulta = "Update informegeneral SET promedioFactor='$promedio' where fecha='$fecha'";
                    $resul = mysqli_query(conectar(), $consulta);
                    //afectados//////////////////////
                    $co = "SELECT idInforme as id FROM informegeneral WHERE fecha = '$fecha' AND infectados='$infectados'";
                    $resul = mysqli_query(conectar(), $co);
                    foreach ($resul as $fila) {
                        $id = $fila['id'];
                    }
                    $consulta= "SELECT MAX(fallecidos) fa, MAX(recuperados) re FROM afectados";//maximo de muertos y fallecidos para sumar
                    $resul = mysqli_query(conectar(), $consulta);
                    $reg = mysqli_fetch_array($resul);
                    $totm = $reg["fa"]+$muertes;//muerte
                    $totr = $reg["re"]+$recuperados;//recuperados
                    $consulta = "insert into afectados(idInforme,fallecidos,falledias,recuperados,recuperadia) values ('$id','$totm','$muertes','$totr','$recuperados')";
                    $resul = mysqli_query(conectar(), $consulta);
                    echo 3;
                   /* $pr ="SELECT promedioFactor * totalDia as posibles FROM informegeneral 
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
                    echo json_encode($data); //enviar el array final en formato json a JS*/
                }
            }
            
            
            // realizas las siguientes consultas con operaciones especificas
           /*  $t = "SELECT (SELECT totalDia FROM informegeneral WHERE fecha =(SELECT DATE (MAX(fecha)-1)
                FROM informegeneral )) + (SELECT infectados FROM informegeneral
                WHERE fecha =(SELECT MAX(fecha) FROM informegeneral )) AS Total  FROM informegeneral LIMIT 1";*/
            // el total de infectados en el Día
            
            
            
            // $data[] = [$total, $factor, $promedio];
            $id = 0;
            //$co = "SELECT max(idInforme) as id FROM informegeneral";
           /* $co = "SELECT idInforme as id FROM informegeneral WHERE fecha = '$fecha' AND infectados='$infectados'";
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
            $resul = mysqli_query(conectar(), $consulta);*/
            // ====================================================enviar datos para la visualizacion==========================
    
            
            
    
    
        }
        mysqli_close(conectar());
        break;
    case 2:
        $id = ($_POST['id']);
        //verifico si modificó algo
        $consulta= "SELECT * FROM informegeneral i JOIN afectados a ON a.idInforme=i.idInforme
        WHERE i.idInforme='$id'";
        $resul = mysqli_query(conectar(), $consulta);
        $reg = mysqli_fetch_array($resul);
        $inf = $reg["infectados"];//capturo los datos
        $fal = $reg["falledias"];
        $rec = $reg["recuperadia"];
        if($infectados == $inf && $muertes == $fal && $recuperados == $rec){
            echo 4;
        }else{
            $diaAnterior =  date("Y-m-d",strtotime($fecha."- 1 days"));
            $consulta = "SELECT totalDia, fallecidos,recuperados FROM informegeneral i JOIN afectados a ON a.idInforme=i.idInforme
            WHERE i.fecha='$diaAnterior'";//traigo los datos del dia anterior
            $resul = mysqli_query(conectar(), $consulta);
            $reg = mysqli_fetch_array($resul);
            $tdia = $reg["totalDia"]+$infectados;//capturo los datos
            $tfac = $reg["fallecidos"]+$muertes;
            $trec = $reg["recuperados"]+$recuperados;
            $factor = $tdia / $reg["totalDia"];//factor de riesgo
            $consulta = "Update informeGeneral SET infectados='$infectados', factor='$factor', totalDia='$tdia' where idInforme= '$id'";
            $resul = mysqli_query(conectar(), $consulta);
            $consulta= "SELECT AVG(factor) prom FROM informegeneral";
            $resul = mysqli_query(conectar(), $consulta);
            $reg = mysqli_fetch_array($resul);
            $promedio = $reg["prom"];//promedio actualizo
            $consulta = "Update informegeneral SET promedioFactor='$promedio' where idInforme='$id'";
            $resul = mysqli_query(conectar(), $consulta);
            $consulta = "Update afectados SET fallecidos='$tfac', falledias='$muertes', recuperados='$trec', recuperadia='$recuperados' where idInforme= '$id'";
            $resul = mysqli_query(conectar(), $consulta);
            echo 5;
        }
        mysqli_close(conectar());
        break;
    case 3:
        $id = ($_POST['id']);
        $consulta = "delete from afectados where idInforme = '$id'";
        $resul = mysqli_query(conectar(), $consulta);
        $consulta = "delete from informegeneral where idInforme = '$id'";
        $resul = mysqli_query(conectar(), $consulta);
        mysqli_close(conectar());
        break;
}


// $consulta="SELECT * FROM informegeneral ORDER BY idInforme DESC LIMIT 1";
