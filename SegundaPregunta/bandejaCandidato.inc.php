<!-- Candidato -->
<?php
session_start();
include "conexion.inc.php";
if (isset($_POST["submit"])) {
	$revisar = getimagesize($_FILES["image"]["tmp_name"]);
	if ($revisar !== false) {
		$image = $_FILES['image']['tmp_name'];
		$imgContenido = addslashes(file_get_contents($image));
		$date = date('Y-m-d H:i:s');
		
		// Insertar imagen en la base de datos
		$insertar = $conn->query("INSERT into images_tabla (imagenes, creado) VALUES ('$imgContenido', now())");
		// Condicional para verificar la subida del fichero
		if ($insertar) {
			// Inicia o comprueba el proceso2
			$sql = "INSERT INTO seguimiento values(100,'" . $_SESSION["usuario"] . "','F1','P2','" . $date . "',null);";
			echo (mysqli_query($conn, $sql));
			sleep(3);
			header("Location: checkDocs.php");
			echo "Archivo Subido Correctamente.";
		} else {
			echo "Ha fallado la subida, reintente nuevamente.";
		}
		// Si el usuario no selecciona ninguna imagen
	} else {
		echo "Por favor seleccione imagen a subir.";
	}
}
?>