<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['action'])){
		$act = $_POST['action'];
		switch ($act) {
			/* PARA ver detalles de actividad */ 
			case 'verAct':
				include 'libreria.php';
				include 'prfunc.php';
				$idact = $_POST['datos'];
				$minutas = getMinutas($idact);
				$titulo = consultatitulo($idact);
				
				$nueva = $minutas .'<input type="hidden" id="title" value="'.$titulo.'">';
					echo $nueva;
				break;
			case 'nuevaAct': //Agregar Actividad
			include 'libreria.php';
			include "../cms/library/common.php";
				$idproy = $_POST['datos'];
				$categproy = $_POST['categoria'];
				$titulo = 'Agregar Actividad';
				echo '<div>
						
        				<div class="modal-body" id="formulario">
	          				<label class="bmd-label-floating">Nombre de Actividad</label>
	          				<input type="text" class="form-control" required name="actividadnueva" autocomplete="off" id="newactivity">
	          			</div>	<span id="mensajemodal"></span>
	        			<div class="modal-footer" id="modal-footer"><span id="botonagregar">
	            			<input type="button" name="actividad" class="btn btn-info" value="Agregar" onClick="newactivity('.$idproy.','.$categproy.',1)"></span>
	            			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  		</div>
	      			 
	      			 </div><input type="hidden" id="title" value="'.$titulo.'">';
	      			
	      			 
				break;
				case 'modificarAct': //Agregar Actividad
				include 'libreria.php';
				include "../cms/library/common.php";
				$idact = $_POST['datos'];
				$nombreviejo = $_POST['categoria'];
				$titulo = consultatitulo($idact);
				echo '<div>
						<div class="modal-body" id="formulario">
	          				<label class="bmd-label-floating">Nuevo nombre de Actividad</label>
	          				<input type="text" class="form-control" required name="actividadnueva" autocomplete="off" id="newname" value="'.$nombreviejo.'">
	          			</div>	<span id="mensajemodal"></span>
	        			<div class="modal-footer" id="modal-footer"><span id="botonagregar">
	            			<input type="button" name="actividad" class="btn btn-info" value="Agregar" onClick="editactivity('.$idact.', 1)"></span>
	            			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  		</div>
	      			 
	      			 </div><input type="hidden" id="title" value="Modificar Actividad: '.$titulo.'">';
	      			
	      			 
				break;
				case 'titulo':
				include 'libreria.php';
				$id = $_POST['idactivi'];
				echo consultatitulo($id); 
				break;
				case'nuevaCategoria':
				include 'libreria.php';
				
				$titulo = '<div><div class="modal-body" id="formulario">
	          				<label class="bmd-label-floating">Nombre de Categoria</label>
	          				<input type="text" class="form-control" required name="categorianueva" autocomplete="off" id="newcategory"">
	          			</div>	<span id="mensajemodal"></span>
	        			<div class="modal-footer" id="modal-footer"><span id="botonagregar">
	            			<input type="button" name="categoria" class="btn btn-info" value="Agregar" onClick="createCategory()"></span>
	            			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  		</div>
							<input type="hidden" id="title" value="Crear Categoria">';
					echo $titulo;
				break;

		}

	}
?>