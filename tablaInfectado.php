
    <table id="tablaInf" class="table table-hover table-responsive-sm text-white bg-info shadow mt-1">
    <!-- <table id="tablaInf" class="table table-hover table-responsive-sm"> -->
        <thead class="text-center">
            <tr>
                <th hidden>ID</th>
                <th>Fecha</th>
                <th>Infectados</th>
                <th>Total en El Día</th>
                <th>Factor de contagio</th>
                <th>Promedio de contagio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultado as $fila) {
                echo "<tr class='text-center'>";

                echo "<td HIDDEN>" . $fila['idInforme'] . "</td>";
<<<<<<< HEAD
                echo "<td>" . $fila['fecha'] . "</td>";
                echo "<td style='background:rgb(0,80,90)'>" . $fila['infectados'] . "</td>";
<<<<<<< HEAD
=======
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
>>>>>>> parent of 1880863... merge
                echo "<td>" . $fila['totalDia'] . "</td>";
                echo "<td>" . $fila['factor'] . "</td>";
                echo "<td>" . $fila['promedioFactor'] . "</td>";
                echo "<td></td>";
                echo "</tr>";
            }
            mysqli_close($conectar);
            ?>
        </tbody>
    </table>
<<<<<<< HEAD
=======
</div>
>>>>>>> parent of 1880863... merge
