<?php

session_start();
include "conexion.inc.php";
$sql = "select * from seguimiento where usuario='" . $_SESSION["usuario"] . "' ";
// $sql .= "and fechafin is null";
$resultado = mysqli_query($conn, $sql);
// Proceso Actual
$basename = basename(__FILE__);
$sql_procesoA = "SELECT proceso FROM flujoproceso WHERE formulario='" . $basename . "'";
$resultado_procesoA = mysqli_query($conn, $sql_procesoA);
$fila_procesoA = mysqli_fetch_array($resultado_procesoA);
// Proceso Siguiente
$sql_proceso = "SELECT procesosiguiente FROM flujoproceso WHERE proceso = '" . $fila_procesoA["proceso"] . "'";
$resultado_proceso = mysqli_query($conn, $sql_proceso);
$fila_proceso = mysqli_fetch_array($resultado_proceso);
$sql_procesoS = "SELECT formulario FROM flujoproceso WHERE proceso = '" . $fila_proceso["procesosiguiente"] . "'";
$resultado_proceso = mysqli_query($conn, $sql_procesoS);
$fila_proceso = mysqli_fetch_array($resultado_proceso);
function Siguiente()
{
    include "conexion.inc.php";
    // Proceso Actual
    $basename = basename(__FILE__);
    $sql_procesoA = "SELECT proceso FROM flujoproceso WHERE formulario='" . $basename . "'";
    $resultado_procesoA = mysqli_query($conn, $sql_procesoA);
    $fila_procesoA = mysqli_fetch_array($resultado_procesoA);
    // Proceso Siguiente
    $sql_proceso = "SELECT procesosiguiente FROM flujoproceso WHERE proceso = '" . $fila_procesoA["proceso"] . "'";
    $resultado_proceso = mysqli_query($conn, $sql_proceso);
    $fila_proceso = mysqli_fetch_array($resultado_proceso);
    $sql_procesoS = "SELECT formulario FROM flujoproceso WHERE proceso = '" . $fila_proceso["procesosiguiente"] . "'";
    $resultado_proceso = mysqli_query($conn, $sql_procesoS);
    $fila_proceso = mysqli_fetch_array($resultado_proceso);

    header("Location: " . $fila_proceso["formulario"]);
}
?>

<html>
<link href="estilosIndex.css" rel="stylesheet">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Sesión de <?php echo ($_SESSION["usuario"]); ?></title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<body class="body">

    <body style="background-color:#222D32">
        <div style="color: white" class="container">
            <br>
            <h2>FLUJOS CANDIDATO</h2>
            <p>Aqui se muestran los flujos completados e iniciados del frente candidato</p>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <td>Tramite</td>
                        <td>Flujo</td>
                        <td>Proceso</td>
                        <td>Fecha Inicio</td>
                        <td>Fecha Final</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = mysqli_fetch_array($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $fila["notramite"] . "</td>";
                        echo "<td>" . $fila["flujo"] . "</td>";
                        echo "<td>" . $fila["proceso"] . "</td>";
                        echo "<td>" . $fila["fechainicio"] . "</td>";
                        echo "<td>" . $fila["fechafin"] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 login-box">
                    <div class="col-lg-12 login-title">
                        SUS DOCUMENTOS ESTÁN EN ORDEN..!!! <br> FELICIDADES
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 login-btm login-button">
            <form method="POST">
                <button type="submit" name="Siguiente" id="Siguiente" value="RUN" class="btn btn-outline-primary">Siguiente</button>
            </form>
            <?php
            if (array_key_exists('Siguiente', $_POST)) {
                Siguiente();
            }
            ?>
        </div>
    </body>

</body>

</html>