<?php
session_start();
include "conexion.inc.php";
function Si()
{
    include "conexion.inc.php";
    // Se actualiza el seguimiento
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE seguimiento SET fechafin = '" . $date . "' WHERE usuario = '" . $_SESSION["usuario"] . "' and proceso = 'P2'";
    mysqli_query($conn, $sql);
    $choice = "Si";
    $sql_procesoA = "SELECT fp.formulario FROM (SELECT fc.proceso, fc." . $choice . " FROM (select * from flujoproceso where procesosiguiente is null) fp, flujocondicionante fc WHERE fp.proceso like fc.proceso) fc, flujoproceso fp WHERE fp.proceso like fc." . $choice;
    $resultado_procesoA = mysqli_query($conn, $sql_procesoA);
    $fila_procesoA = mysqli_fetch_array($resultado_procesoA);
    // Se actualiza el seguimiento
    $date = date('Y-m-d H:i:s');
    $sql = "insert into seguimiento values(100,'" . $_SESSION["usuario"] . "','F1','" . $fila_procesoA["proceso"] . "','" . $date . "','null');";
    mysqli_query($conn, $sql);

    sleep(2);
    $date = date('Y-m-d H:i:s');
    $sql = "update seguimiento set fechafin = '" . $date . "' where usuario = '" . $_SESSION["usuario"] . "'";
    mysqli_query($conn, $sql);
    header("Location: " . $fila_procesoA["formulario"]);
}
function No()
{

    include "conexion.inc.php";
    // Se borra el progreso de seguimiento
    $sql = "DELETE FROM seguimiento WHERE usuario = '" . $_SESSION["usuario"] . "' and proceso = 'P2'";
    mysqli_query($conn, $sql);
    $choice = "No";
    $sql_procesoA = "SELECT fp.formulario FROM (SELECT fc.proceso, fc." . $choice . " FROM (select * from flujoproceso where procesosiguiente is null) fp, flujocondicionante fc WHERE fp.proceso like fc.proceso) fc, flujoproceso fp WHERE fp.proceso like fc." . $choice;
    $resultado_procesoA = mysqli_query($conn, $sql_procesoA);
    $fila_procesoA = mysqli_fetch_array($resultado_procesoA);

    header("Location: " . $fila_procesoA["formulario"]);
}



$sql = "select * from seguimiento where usuario='" . $_SESSION["usuario"] . "' ";
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
                        SU DOCUMENTACIÓN ESTÁ SIENDO REVISADA!!!
                    </div>
                </div>
            </div>
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

            <div class="col-lg-6 login-btm login-button">
                <form method="POST">
                    <button type="submit" name="si" id="si" value="RUN" class="btn btn-outline-primary">SI</button>
                    <button type="submit" name="no" id="no" value="RUN" class="btn btn-outline-primary">NO</button>
                </form>
                <?php
                if (array_key_exists('si', $_POST)) {
                    Si();
                }
                if (array_key_exists('no', $_POST)) {
                    No();
                }
                ?>
            </div>
    </body>

</body>

</html>