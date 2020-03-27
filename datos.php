<?php
    header('Content-Type: application/json');
    require_once("conexcion.php");
    $conn=conectar();
    $sqlQuerey = "Select fecha, infectados from informegeneral";
    $result=mysqli_query($conn,$sqlQuerey);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    mysqli_close($conn);
    echo json_encode($data);

?>