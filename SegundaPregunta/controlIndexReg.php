<?php
include "conexion.inc.php";

$usuario = $_GET["usuario_reg"];
$contrasenia = $_GET["contrasenia_reg"];
$sql = "insert into usuarios values('" . $usuario . "','" . $contrasenia . "','E');";

if ($conn->query($sql) === TRUE) {
    echo "Ha sido insertado con exito";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>