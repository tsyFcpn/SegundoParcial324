<?php
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
// Datos del login
$usuario = $_GET["usuario"];
$contrasenia = $_GET["contrasenia"];
// Datos del registro
$usuario_reg = $_GET["usuario_reg"];
$contrasenia_reg = $_GET["contrasenia_reg"];
// LOGIN
$sql = "select * from usuarios where usuario='" . $usuario;
$sql .= "' and contrasenia='" . $contrasenia . "'";
$resultado = mysqli_query($conn, $sql);
$fila = mysqli_fetch_array($resultado);

$date = date('Y-m-d H:i:s');
// LOGIN

if (($fila["usuario"] == $usuario and $fila["contrasenia"] == $contrasenia) and ($usuario_reg == "" and $contrasenia_reg == "")) {
    session_start();
    $_SESSION["usuario"] = $usuario;
    header("Location: " . $fila_proceso["formulario"]);
    // if ($fila["rol"] == "E") {
    //     header("Location: " . $fila_proceso["procesosiguiente"] . ".php"); #OJO
    // } elseif ($fila["rol"] == "K") {
    //     header("Location: bandejaAdministracion.php"); #OJO
    // }
} else {
    header("Location: index.php");
}

// REGISTRAR

if (!($usuario_reg == "" and $contrasenia_reg == "") and ($usuario == "" and $contrasenia == "")) {
    $sql_temp = "insert into usuarios values('" . $usuario_reg . "','" . $contrasenia_reg . "','E');";

    if (($conn->query($sql_temp) === TRUE) ) {
        echo "Ha sido insertado con exito";
        // Ingresamos datos al seguimiento del usuario

        $sql_temp = "INSERT into seguimiento values(100,'" . $usuario_reg . "','F1','" . $fila_procesoA["proceso"] . "','" . $date . "',null)";
        mysqli_query($conn, $sql_temp);
        
        sleep(3);
        header("Location: index.php");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        header("Location: index.php");
    }
}
if (($usuario_reg == "" and $contrasenia_reg == "") and ($usuario == "" and $contrasenia == "")) {
    header("Location: index.php");
}
?>
