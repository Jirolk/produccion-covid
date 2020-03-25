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
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/chart.min.js"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>

    <!-- <link rel="shortcut icon" href="img/virus.png" type="image/png"> -->
    <link rel="icon" type="image/png" href="img/virus.png"/>

    <title>Covid-19</title>
    <link rel="stylesheet" href="css/estilos.css">

</head>

<body>
    <DIV class="container mt-2">
        <?php include_once "cabecera.php" ?>
    </DIV>

    <!-- ===========================Grafico========================= -->

    <div class="container mt-5">
        <div class="row">
            <div class="col col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between aling-items-center">
                        <h2 class="tex-primary  text-center font-weight-bold m-o">Seguimiento de Infectados</h2>
                    </div>
                    <div class="card-body">
                        <canvas id="Grafica" width="40%" height="41%"></canvas>
                    </div>
                </div>

            </div>
            <div class="col col-lg-6">
                <div class="card text-white bg-info shadow mt-1">
                    <div class="card-header d-flex justify-content-between aling-items-center">
                        <h1 class="text-center text-dark font-weight-bold m-o">
                            <?php
                            $pr = "SELECT promedioFactor * totalDia as posibles FROM informegeneral
                                WHERE fecha=(SELECT MAX(fecha) AS ayer FROM informegeneral)";
                            $resul = mysqli_query(conectar(), $pr);
                            foreach ($resul as $fila) {
                                $posible = $fila['posibles'];
                            }
                            echo  round($posible);
                            ?>
                            Posibles casos de infectados</h1>
                    </div>
                    <h4 class="card-title text-center mt-3">Para mañana <br>
                        <div>
                            <div style="float:center;">
                                <script type="text/javascript">
                                    var fecha = new Date();
                                    var manana = new Date(fecha.getTime() + 24 * 60 * 60 * 1000);
                                    document.write("" + manana.getDate() + "/" + (manana.getMonth() + 1) + "/" + manana.getFullYear());
                                </script>
                            </div>
                        </div>
                    </h4>

                    <?php
                    $caso = "SELECT totalDia FROM informegeneral
                        WHERE fecha =(SELECT DATE (MAX(fecha)) FROM informegeneral )";
                    $totalCaso = mysqli_query(conectar(), $caso);
                    foreach ($totalCaso as $fila) {
                        $ca = $fila['totalDia'];
                    }
                    $X = $posible - $ca;
                    echo "<hr><h5 class='text-center'>Predicción de: </h5>";
                    echo "<h2 class='card-title text-center'>" . round($X) . " </h2>";
                    echo "<h5 class='text-center'>INFECTADOS MÁS</h5>";
                    echo "<hr><h3 class='text-center'>Actualmente son: <br><h2 class='text-center'>" . $ca . "</h2></h3>"

                    ?>

                    <div class="card-body">





                    </div>
                </div>
            </div>

        </div>
        <!-- ===========================Fin Grafico========================= -->
        <!-- ===========================Tabla========================= -->



        <div class="row">
            <div class="col-12">
                <div class="card shadow text-dark bg-light mt-5">
                    <div class="card-header">TABLA DE SEGUIMIENTO </div>
                    <div class="card-body">
                        <!-- <div class="table-responsive"> -->
                        <table id="tablaInfectados" class="table table-hover table-responsive-lg">
                        <!-- <table id="tablaInfectados" class="table table-hover table-responsive-sm text-white bg-info shadow mt-1"> -->

                            <thead class="text-center">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Infectados</th>
                                    <th>Total en el Día</th>
                                    <th>Factor de contagio</th>
                                    <th>Promedio de contagio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($resultado as $fila) {
                                    echo "<tr class='text-center'>";
                                    echo "<td>" . $fila['fecha'] . "</td>";
                                    echo "<td class='infecta'>" . $fila['infectados'] . "</td>";
                                    echo "<td>" . $fila['totalDia'] . "</td>";
                                    echo "<td>" . $fila['factor'] . "</td>";
                                    echo "<td>" . $fila['promedioFactor'] . "</td>";
                                    echo "</tr>";
                                }
                                mysqli_close($conectar);
                                ?>
                            </tbody>
                        </table>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===========================fin Tabla========================= -->
    <div class="container  text-center mt-5">
        <hr>
        <p>
            Los Datos son oficiales del <b>Ministerios de Salud Publica y Bienestar Social</b> . Se utilizo un modelo matemático
            extraído de este canal <a href="https://www.youtube.com/watch?v=-PUT0hZiZEw&t=1038s" target="_blank">El traductor de Ingeniería</a>
            para predecir los infectados posibles
        </p>
        <div class="container text-center">
            <p>

                <b> <h2> Pueden ver en una planilla en excel </h2></b>
                <a href="excel/Covid-19InformePredic.html" target="_blank">Predicción hasta el 12 de abril</a>
                para descargar en este Link
                <a href="excel/Covid-19InformePredic.xlsx" download="Prediccionhasta12debril.xlsx">DESCARGAR</a>
            </p>
        </div>
        <p>
            Solo se necesitan los infectados por fecha para tal análisis,
            con más datos sera más acertivo, estos lo pueden
            corroborar con los Reportes vinculados aquí abajo.
        </p>

        <hr>
        <div Class="container">
            <div class="row text-center">
                <div class="col col-lg-4">
                    <h4 class="">Reportes Covid-19</h4>

                    <div class="col col-lg-12">
                        <h6 class="text-center">
                            <a href="https://www.mspbs.gov.py/reportes-covid19.html" target="_blank" rel="noopener noreferrer">
                                Oficial
                            </a>
                        </h6>
                        <hr>

                        <!-- <a href="#">23/03/2020</a> -->
                    </div>
                </div>
                <div class="col col-lg-4">
                    <!-- columan de los registros -->
                    <a href="https://www.mspbs.gov.py/dependencias/portal/adjunto/e429c9-Tablero23.03.2020.pdf" target="_blank">23/03/2020</a>
                    <br>
                    <a href="https://www.mspbs.gov.py/dependencias/portal/adjunto/77c682-Tablerodel22.03.pdf" target="_blank"> 22/03/2020</a>
                    <br>
                    <a href="https://www.mspbs.gov.py/dependencias/portal/adjunto/1efbff-Tablerodel21.03.20.pdf" target="_blank"> 21/03/2020</a>
                    <br>
                    <a href="https://www.mspbs.gov.py/dependencias/portal/adjunto/de735d-Tablero20.03.2020.pdf" target="_blank"> 20/03/2020</a>
                    <br>
                    <a href="https://www.mspbs.gov.py/dependencias/portal/adjunto/9dffd3-Tableu19.03.2020.pdf" target="_blank"> 19/03/2020</a>

                    <br>

                    <br>

                </div>
                <div class="col col-lg-4">
                    <h4 class="text-center"><a href="https://www.mspbs.gov.py/covid-19.php" target="_blank">Ministerio de salud Publica y Bienestar Social</a></h4>
                </div>

            </div>






        </div>

    </div>
    <!-- informacion final -->
</body>

<!-- Footer -->
<footer class="page-footer font-small indigo text-center">

    <!-- Footer Links -->
    <div class="container">

        <!-- Grid row-->
        <div class="row  text-center d-flex justify-content-center pt-5 mb-3">

            <!-- Grid column -->
            <!-- <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!"></a>
                </h6>
            </div> -->
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="https://www.mspbs.gov.py/covid-19-necesitas-saber.php#quees" target="_blank">¿Que es el Corona Virus?</a>
                </h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="modoPrevencion.php">Modo de Prevención</a>
                </h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!">Ayuda Medica</a>
                </h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!">Contacto</a>
                </h6>
            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row-->
        <hr class="rgba-white-light" style="margin: 0 15%;">

        <!-- Grid row-->
        <div class="row d-flex text-center justify-content-center mb-md-0 mb-4">

            <!-- Grid column -->
            <div class="col-md-8 col-12 mt-5">
                <p style="line-height: 1.7rem">Espero que con estos Datos expuestos, se pueda tener concienca de la
                    magnitud a que nos enfrentamos, cumplan con la cuarentena, no se expongan,
                    cuidense de la mejor manera que sepan, Esto no es una Joda! <br>
                    DIOS LOS BENDIGA ahora y siempre!
                </p>
            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row-->
        <hr class="clearfix d-md-none rgba-white-light" style="margin: 10% 15% 5%;">

        <!-- Grid row-->
        <div class="row pb-3">

            <!-- Grid column -->
            <div class="col-md-12">

                <div class="mb-5 flex-center">

                    <!-- Facebook -->
                    <a class="fb-ic">
                        <i class="fab fa-facebook-f fa-lg white-text mr-4"> </i>
                    </a>
                    <!-- Twitter -->
                    <a class="tw-ic">
                        <i class="fab fa-twitter fa-lg white-text mr-4"> </i>
                    </a>
                    <!-- Google +-->
                    <a class="gplus-ic">
                        <i class="fab fa-google-plus-g fa-lg white-text mr-4"> </i>
                    </a>
                    <!--Linkedin -->
                    <a class="li-ic">
                        <i class="fab fa-linkedin-in fa-lg white-text mr-4"> </i>
                    </a>
                    <!--Instagram-->
                    <a class="ins-ic">
                        <i class="fab fa-instagram fa-lg white-text mr-4"> </i>
                    </a>
                    <!--Pinterest-->
                    <a class="pin-ic">
                        <i class="fab fa-pinterest fa-lg white-text"> </i>
                    </a>

                </div>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row-->

    </div>
    <!-- Footer Links -->

    <!-- caja de comentario-->
    <div class="container">
        <div class="container">

            <div id="disqus_thread"></div>
            <script>
                /**
                 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                /*
                var disqus_config = function () {
                this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };
                */
                (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document,
                        s = d.createElement('script');
                    s.src = 'https://covid-19py.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>


        </div>

    </div>
    <!-- fin caja de comentario -->

<hr>
   <div class="container">
            <div class="container">
                <p class="text-center">
                    Responsabilidad: La información aquí contenida se proporciona
                    solo con fines informativos, es solo la opinión del autor y no debe interpretarse
                    erróneamente como consejo médico o de expertos. Hay muchas incógnitas, y el autor de
                    este documento no ofrece ninguna garantía, expresa o implícita, en cuanto a los resultados
                    obtenidos del uso de la información, y no será responsable de la exactitud de la información y
                    no se hace responsable de ningún tercero. -clamaciones de reclamaciones o pérdidas por daños.
                    El autor puede, en cualquier momento, revisar la información en este sitio web sin previo aviso
                    y no se compromete a actualizar esta información.
                </p>
            </div>
        </div>
        <hr>
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:

        <a href="#"> Sandro Castillo</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->

<script>
    $(document).ready(function() {
        showGraph();
    });

    function showGraph() {
        {
            $.post("datos.php",
                function(data) {
                    var fecha = [];
                    var infectados = [];

                    for (var i in data) {
                        fecha.push(data[i].fecha);
                        infectados.push(data[i].infectados);
                    }

                    var chartData = {
                        labels: fecha,
                        datasets: [{
                            label: 'Hasta la fecha',
                            backgroundColor: '#49e2ff',
                            borderColor: 'green',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: infectados
                        }]
                    };

                    var graphTarget = $("#Grafica");
                    var grafi = new Chart(graphTarget, {
                        type: 'line',
                        data: chartData
                    });
                });
        }
    }
</script>
<script src="js/datatables.min.js"></script>
<script src="js/buttons.bootstrap4.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<!-- <script src="js/jquery.dataTables.min.js"></script> -->
<script src="js/tabla.js"></script>
<script src="js/script.min.js"></script>

</html>
