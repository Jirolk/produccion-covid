<<<<<<< HEAD

    <table id="tablaInf" class="table table-hover table-responsive-sm text-white bg-info shadow mt-1">
    <!-- <table id="tablaInf" class="table table-hover table-responsive-sm"> -->
=======
<div class="table-responsive">
    <table id="tablaInf" class="table table-bordered display nowrap stripe" style="width:100%">
>>>>>>> agus1
        <thead class="text-center">
            <tr>
                <th hidden>ID</th>
                <th>Fecha</th>
                <th>Infec.</th>
                <th>T. Infec.</th>
                <th>Fallec.</th>
                <th>T. Fallec.</th>
                <th>Recup.</th>
                <th>T. Recup.</th>
                <th>Fac. de cont.</th>
                <th>Prom. de cont.</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $con=1;
            foreach ($resultado as $fila) {
                echo "<tr class='text-center'>";

                echo "<td HIDDEN>" . $fila['idInforme'] . "</td>";
<<<<<<< HEAD
                echo "<td>" . $fila['fecha'] . "</td>";
                echo "<td style='background:rgb(0,80,90)'>" . $fila['infectados'] . "</td>";
=======
                $date = date_create($fila['fecha']);
                $fe = date_format($date,"d/m/Y");
                echo "<td>".$fe."</td>";
                if( $fila['infectados'] == 0){
                    echo "<td style='background:rgb(0, 255,0,0.6);color:white;'>" . $fila['infectados'] . "</td>";
                }else{
                    echo "<td style='background:rgba(255, 0, 0, 0.6);color:white;'>" . $fila['infectados'] . "</td>";
                }
>>>>>>> agus1
                echo "<td>" . $fila['totalDia'] . "</td>";
                if( $fila['falledias'] == 0){
                    echo "<td>" . $fila['falledias'] . "</td>";
                }else{
                    echo "<td style='background:rgba(255, 0, 0, 0.6);color:white;'>" . $fila['falledias'] . "</td>";
                }
                echo "<td>" . $fila['fallecidos'] . "</td>";
                if( !$fila['recuperadia'] == 0){
                    echo "<td style='background:rgb(0, 255,0,0.6);color:white;'>" . $fila['recuperadia'] . "</td>";
                }else{
                    echo "<td>" . $fila['recuperadia'] . "</td>";
                }
                echo "<td>" . $fila['recuperados'] . "</td>";
                echo "<td>" . $fila['factor'] . "</td>";
                echo "<td>" . $fila['promedioFactor'] . "</td>";
                if($con == 1){
                    echo '<td><button class="btn btn-info  btnEditar"><i class="fa fa-pencil" aria-hidden="true"></i></button> <button class="btn btn-danger btnBorrar"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
                }else{
                    echo "<td></td>";
                }
                ++$con;
                echo "</tr>";
            }
            mysqli_close($conectar);
            ?>
        </tbody>
    </table>
</div>