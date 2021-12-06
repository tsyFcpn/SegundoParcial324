<?php
include "conexion.inc.php";
$sql_procesoS;

$choice="No";
// Proceso Actual
$basename = "checkDocs.php";
$sql_procesoA = "SELECT fp.formulario FROM (SELECT fc.proceso, fc." . $choice . " FROM (select * from flujoproceso where procesosiguiente is null) fp, flujocondicionante fc WHERE fp.proceso like fc.proceso) fc, flujoproceso fp WHERE fp.proceso like fc." . $choice;
$resultado_procesoA = mysqli_query($conn, $sql_procesoA);
$fila_procesoA = mysqli_fetch_array($resultado_procesoA);

header("Location: " . $fila_procesoA["formulario"]);
?>