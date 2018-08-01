<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['valider'])) {
        
        $nombrepr = $_POST['nombrepr'];
        $categoriapr = $_POST['categoriapr'];
        $responsable = $_POST['responsable'];
        $fechacierre = $_POST['fechacierre'];
        $descripcion = $_POST['descripcion'];
       	$proyectonuevo = crearproyecto  ($nombrepr, $categoriapr, $responsable, $fechacierre, $descripcion);
       if ($proyectonuevo==1){
       							header('Location: index.php?e=1');
           					 }
       else 				{ 
       							header('Location: index.php?e=0'); }
       						}

        }
function crearproyecto($nombrepr, $categoriapr, $responsable, $fechacierre, $descripcion)

				{
					include "../cms/library/common.php";
					$sql = "INSERT INTO intranet_roadmap(nombrepr, categoriapr, descripcion, fechaest, fechapr) VALUES ('$nombrepr', $categoriapr, '$descripcion','$fechacierre', NOW())";
					$busqueda = miActionSQL($sql);
					if ($busqueda==1){
					$mensaje=1;
					} else {
						$mensaje= $busqueda;

					}
				return $mensaje;

				}


?>