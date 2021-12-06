<!-- Candidato -->
<?php
session_start();
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

$sql = "select * from seguimiento where usuario='" . $_SESSION["usuario"] . "' ";
// $sql .= "and fechafin is null";
$resultado = mysqli_query($conn, $sql);

$date = date('Y-m-d H:i:s'); // FEcha y horas para fechafin del proceso1
$sql_temp = "SELECT * FROM seguimiento WHERE usuario = '" . $_SESSION["usuario"] . "' AND fechafin IS NULL AND proceso='P1'";
$resultado_temp = mysqli_query($conn, $sql_temp);
$fila_temp = mysqli_fetch_array($resultado_temp);


if (is_array($fila_temp)) {
    $sql_temp = "UPDATE seguimiento SET fechafin='" . $date . "' WHERE usuario='" . $_SESSION["usuario"] . "'";
} else {
    $sql_temp = "SELECT * FROM seguimiento";
}
mysqli_query($conn, $sql_temp);

$sql_temp = "SELECT * FROM seguimiento WHERE usuario = '" . $_SESSION["usuario"] . "' AND proceso = '".$fila_procesoA["proceso"]."' AND fechainicio is not null AND fechafin IS NULL";
$resultado_temp = mysqli_query($conn, $sql_temp);
$fila_temp = mysqli_fetch_array($resultado_temp);

if (is_array($fila_temp)) {
    header("Location: ".$fila_proceso["formulario"]);
}
mysqli_query($conn, $sql_temp);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="estilosIndex.css" rel="stylesheet">
    <title>Sesión de <?php echo ($_SESSION["usuario"]); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body style="background-color: #222D32">

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
    <div style="color: white" class="container">
        <h2>Suba sus documentos para su revisión</h2>
        <form name="MiForm" id="MiForm" method="post" action="bandejaCandidato.inc.php" enctype="multipart/form-data">
            <div class="form-group">
                <input name="image" type="file" class="form-control-file border" name="file">
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>