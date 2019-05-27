<?php 
session_start();
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if ($action == "ajax") {
	//si la accion se cumple elimino el producto
	if (isset($_REQUEST['id'])){
		$id_eliminar = $_REQUEST['id'];
		require "conexion.php";
		$conex = mysqli_connect($server,$serveruser,$password,$name);
		if (mysqli_connect_errno()) {
			echo "Fallo la conexión";
			exit();
		}
		mysqli_set_charset($conex,"utf8");
		$sql = "DELETE FROM salvador_noticias WHERE id = '$id_eliminar'";
		$res = mysqli_query($conex,$sql);
		if ($res) {
			echo "Datos eliminados satisfactoriamente";		
		}else{
			echo "No se pudo eliminar los datos";
		}
	}
}

?>