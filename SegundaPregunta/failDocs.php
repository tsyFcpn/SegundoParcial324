<?php

session_start();
include "conexion.inc.php";


function Volver()
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
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 login-box">
                    <div class="col-lg-12 login-title">
                        USTED VA A SER REDIRIGIDO AL INICIO<br>PORQUE NO PRESENTÓ LOS DOCUMENTOS EN ORDEN...
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 login-btm login-button">
            <form method="POST">
                <button type="submit" name="Volver" id="Volver" value="RUN" class="btn btn-outline-primary">Volver</button>
            </form>
            <?php
            if (array_key_exists('Volver', $_POST)) {
                Volver();
            }
            ?>
        </div>
    </body>

</body>

</html>