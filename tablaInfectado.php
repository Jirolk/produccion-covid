
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
                echo "<td>" . $fila['fecha'] . "</td>";
                echo "<td style='background:rgb(0,80,90)'>" . $fila['infectados'] . "</td>";
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
</div>
=======
>>>>>>> parent of b96e62a... merge
