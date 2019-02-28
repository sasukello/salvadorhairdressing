<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function datosPanelesDashboard() {
	include_once 'conexion.php';
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
		die('Error en Conexión: ' . mysqli_error($dbh));
		exit;
	}

	$sqlMorosos = "SELECT i.inscripcion_id FROM inscripcion i INNER JOIN horarios h ON i.idhorario = h.id_horario WHERE i.status = 1 AND CURDATE() >= ( DATE_ADD(h.fechainicio, INTERVAL ROUND(datediff(h.fechafin, h.fechainicio)/2, 0) DAY )) AND h.fechafin > CURDATE()";
	$sqlPagos = "SELECT id_pagos FROM pagos WHERE codigo = 201 AND fecha >= CURDATE() - INTERVAL 7 DAY";
	$sqlCursos = "SELECT * FROM horarios WHERE CURDATE() BETWEEN fechainicio AND fechafin AND inscritos > 0";

	$searchMorosos = mysqli_query($dbh, $sqlMorosos) or die(mysqli_error($dbh));
	$searchPagos = mysqli_query($dbh, $sqlPagos) or die(mysqli_error($dbh));
	$searchCursos = mysqli_query($dbh, $sqlCursos) or die(mysqli_error($dbh));
	$matchMorosos = mysqli_num_rows($searchMorosos);
	$matchPagos = mysqli_num_rows($searchPagos);
	$matchCursos = mysqli_num_rows($searchCursos);

	return array(
		"matchMorosos" => $matchMorosos,
		"matchPagos" => $matchPagos,
		"matchCursos" => $matchCursos
	);
}

function guardarCT($curso, $tipoct, $descripcion, $imagen, $user, $materiales, $cant_notas, $tipo_eval, $porc_nota1, $porc_nota3, $porc_nota2, $porc_nota4, $porc_nota5) { // Guarda los nuevos cursos y talleres
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
		die('Error en Conexión: ' . mysqli_error($dbh));
		exit;
	}
	// $image = addslashes(file_get_contents($imagen['tmp_name'])); //SQL Injection defence!
	$foto = uploadFilesImages($imagen);

	if ($foto[0] == 1) {
		$sql = "INSERT INTO cursos (nombre, tipo, descripcion, imagen, estado, id_usuario, materiales,cant_notas, tipo_eval, porc_nota1, porc_nota2, porc_nota3, porc_nota4, porc_nota5) VALUES ('$curso', $tipoct, '$descripcion', '$foto[1]', 0, '$user', '$materiales', $cant_notas, $tipo_eval, $porc_nota1, $porc_nota3, $porc_nota2, $porc_nota4, $porc_nota5)";

		if (mysqli_query($dbh, $sql)) {
			header('Location: ../admin/index.php?resct=success&tipo='.$tipoct.'');
			die();
		} else {
			header('Location: ../admin/index.php?resct=fail&tipo='.$tipoct.'');
			die();
		}
	} else {
		header('Location: ../admin/index.php?resct=error&tipo='.$tipoct.'');
		die();
	}

	return;
}

function uploadFiles($archivo){
	$resultado = array();
	$nombre = "";
	if (isset($archivo)) {
    $target_dir = "componentes/cursos/";
    if (!file_exists($target_dir)) {
      mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($archivo["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if file already exists
    if (file_exists($target_file)) {
      $msg = 7;
      //echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    // Check file size
    if ($archivo["size"] > 5000000) {
      //echo "Sorry, your file is too large.";
      $msg = 8;
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" ) {
      //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $msg = 5;
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      //echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($archivo["tmp_name"], $target_file)) {
        //REGISTRO en BASE DE DATOS
        $nombre = $archivo["name"];
        $msg = 1;
      } else {
        //echo "Sorry, there was an error uploading your file.";
        $msg = 2;
      }
    }
  }

	$resultado[0] = $msg;
	$resultado[1] = $nombre;

  return $resultado;
}

function uploadFilesImages($archivo){
	$resultado = array();
	$nombre = "";
	if (isset($archivo)) {
    $target_dir = "componentes/images/cursos/";
    if (!file_exists($target_dir)) {
      mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($archivo["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if file already exists
    if (file_exists($target_file)) {
      $msg = 7;
      //echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    // Check file size
    if ($archivo["size"] > 5000000) {
      //echo "Sorry, your file is too large.";
      $msg = 8;
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" ) {
      //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $msg = 5;
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      //echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($archivo["tmp_name"], $target_file)) {
        //REGISTRO en BASE DE DATOS
        $nombre = $archivo["name"];
        $msg = 1;
      } else {
        //echo "Sorry, there was an error uploading your file.";
        $msg = 2;
      }
    }
  }

	$resultado[0] = $msg;
	$resultado[1] = $nombre;

  return $resultado;
}


function selectCursos($idcurso){// Muestra el select con las opciones de los cursos 0: nuevo else modificar
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "SELECT id, nombre, tipo, descripcion, idmodulo, id_usuario, estado FROM cursos WHERE estado=0";

	$select = "";
	$resultado= "";
	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		while ($rw = mysqli_fetch_array($search)) {
			$tipo = $rw['tipo'];
			if ($tipo == 1) {
				$tipo = "Curso";
			} elseif (
				$tipo == 2) {
				$tipo = "Taller";
			}
		  	$opcion = $tipo .": ". $rw['nombre'];
		  	if ($idcurso == $rw['id']) {
		  		$selected = 'selected';
		  	} else {
		  		$selected = '';
		  	}
			$resultado .= '<option value="'.$rw['id'].'" '.$selected.'>'.$opcion.'</option>';
		}
		$select = "<select class='form-control' name='cursos' required='' ><option value=''>- Seleccione: curso o taller -</option>".$resultado."</select>";
	} else {
		$select = "<select class='form-control' name='cursos' required='' ><option value=''>- Seleccione curso o taller -</option></select>";
	}
	return $select;
}

function selectLocation($idlocation){// Muestra el select con las ubicaciones Salvador Academy
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "SELECT * FROM ubicacion";

	$select = "";
	$resultado= "";
	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		while ($rw = mysqli_fetch_array($search)) {
		  	$sede = $rw['nombre'];
		  	$idubicacion = $rw['id'];
		  	if ($idlocation == $idubicacion) {
		  		$selected = 'selected';
		  	} else {
		  		$selected = '';
		  	}
			$resultado .= '<option value="'.$idubicacion.'" '.$selected.'>'.$sede.'</option>';
		}
		$select = "<select class='form-control' name='ubicacion' required='' ><option value=''>- Seleccione la ubicación -</option>".$resultado."</select>";
	} else {
		$select = "<select class='form-control' name='ubicacion' required='' ><option value=''>- Seleccione la ubicación -</option></select>";
	}
	return $select;
}

function selectTeacher($idprofesor){// Muestra el select con las opciones de los profesores
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "SELECT * FROM usuarios WHERE permisos=10 AND estado IN (0, 1)";

	$select = "";
	$resultado= "";
	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		while ($rw = mysqli_fetch_array($search)) {
		  	$profesor = $rw['nombre'] ." ". $rw['apellido'];
		  	$idprof = $rw['id'];
		  	if ($idprofesor == $idprof) {
		  		$selected = 'selected';
		  	} else {
		  		$selected = '';
		  	}
			$resultado .= '<option value="'.$idprof.'" '.$selected.'>'.$profesor.'</option>';
		}
		$select = "<select class='form-control' name='profesor' required='' ><option value=''>- Seleccione el profesor -</option>".$resultado."</select>";
	} else {
		$select = "<select class='form-control' name='profesor' required='' ><option value=''>- Seleccione el profesor -</option></select>";
	}
	return $select;
}

function cursos() { // Consulta los cursos y talleres de la BD
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT id, nombre, tipo, descripcion, idmodulo, id_usuario, estado FROM cursos";

	$resultado= "";
	$i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    while ($rw = mysqli_fetch_array($search)) {
	        $tipo = $rw['tipo'];
	        $estado = $rw['estado'];
	        if ($tipo == 1) {
	        	$tipo = 'Curso';
	        } elseif ($tipo == 2) {
	        	$tipo = 'Taller';
	        }
	        if ($estado == 0) {
	        	$estado = 'Activo';
	        } elseif ($estado == 1) {
	        	$estado = 'Inactivo';
	        }
			$resultado .= '<tr>
                    		<td>'.$tipo.'</td>
                    		<td>'.$rw['nombre'].'</td>
                    		<td>'.$estado.'</td>
												 <td class="text-right">
												 	<a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="detCT" data-id="'.$rw['id'].'" href="#"><i class="fa fa-times-circle icon-edit"></i></a>
													<a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="verCT" data-id="'.$rw['id'].'" href="#"><i class="fa fa-search icon-view"></i></a>
													<a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="modCT" data-id="'.$rw['id'].'" href="#"><i class="fa fa-edit icon-edit"></i></a>
												</td>
                    	</tr>';
	    }
	} else {
	    $resultado = "";
	}

	$tabla = '<div class="p-20">
				<div class="mb-20">
					<button onclick="showContent(11)" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Agregar Nuevo</button>
				</div>
				<div data-example-id="simple-responsive-table" class="bs-example">
	              <div class="table-responsive">
	                <table id="cursos" class="table table-striped table-hover">
	                  <thead>
	                    <tr>
	                      <th>Tipo</th>
	                      <th>Nombre</th>
	                      <th>Estado</th>
	                      <th></th>
	                    </tr>
	                  </thead>
	                  <tbody>
	                  '. $resultado .'
	                  </tbody>
	                </table>
	              </div>
	            </div>
			</div>';

	return $tabla;
}

function horarios(){ // Consulta los cursos y talleres de la BD
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT h.*, c.id, c.nombre, c.tipo, c.descripcion, c.idmodulo, c.id_usuario, c.estado FROM horarios h INNER JOIN cursos c ON h.cursoid = c.id";

	$resultado= "";
	$i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    while ($rw = mysqli_fetch_array($search)) {
	    	$tipo = $rw['tipo'];
	        if ($tipo == 1) {
	        	$tipo = 'Curso';
	        } elseif ($tipo == 2) {
	        	$tipo = 'Taller';
	        }
	        $inicio = date_format(date_create($rw['fechainicio']), 'd-m-Y');
	        $final = date_format(date_create($rw['fechafin']), 'd-m-Y');
			$resultado .= '<tr>
                    		<td>'.$tipo.'</td>
                    		<td>'.$rw['nombre'].'</td>
                    		<td>'.$inicio.'</td>
                    		<td>'.$final.'</td>
                    		<td><a class="btn-link" data-toggle="modal" data-target="#modalInfo" data-tipo="verIns" data-id="'.$rw['id_horario'].'" href="#">'.$rw['inscritos'].' <i class="fa fa-users"></i></a></td>
                   			<td class="text-right">
                                <a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="verH" data-id="'.$rw['id_horario'].'" href="#"><i class="fa fa-search icon-view"></i></a>
                                <a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="modH" data-id="'.$rw['id_horario'].'" href="#"><i class="fa fa-edit icon-edit"></i></a>
                            </td>
                    	</tr>';
	    }
	} else {
	    $resultado = "";
	}

	$tabla = '<div class="p-20">
				<div class="mb-20">
					<button onclick="showContent(21)" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Agregar Horario</button>
					<button onclick="showContent(22)" type="button" class="btn btn-default">Ver Cursos Activos</button>
				</div>
				<div data-example-id="simple-responsive-table" class="bs-example">
	              <div class="table-responsive">
	                <table id="horarios" class="table table-striped table-hover">
	                  <thead>
	                    <tr>
	                      <th>Tipo</th>
	                      <th>Nombre</th>
	                      <th>Inicio</th>
	                      <th>Final</th>
	                      <th>Inscritos</th>
	                      <th></th>
	                    </tr>
	                  </thead>
	                  <tbody>
	                  '. $resultado .'
	                  </tbody>
	                </table>
	              </div>
	            </div>
			</div>';

	return $tabla;
}

function horariosActivos(){ // Consulta los cursos y talleres de la BD
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT h.*, c.id, c.nombre, c.tipo, c.descripcion, c.idmodulo, c.id_usuario, c.estado FROM horarios h INNER JOIN cursos c ON h.cursoid = c.id WHERE CURDATE() BETWEEN h.fechainicio AND h.fechafin AND inscritos > 0";

	$resultado= "";
	$i = 0;
	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    while ($rw = mysqli_fetch_array($search)) {
	    	$tipo = $rw['tipo'];
	        if ($tipo == 1) {
	        	$tipo = 'Curso';
	        } elseif ($tipo == 2) {
	        	$tipo = 'Taller';
	        }
	        $inicio = date_format(date_create($rw['fechainicio']), 'd-m-Y');
	        $final = date_format(date_create($rw['fechafin']), 'd-m-Y');
			$resultado .= '<tr>
                    		<td>'.$tipo.'</td>
                    		<td>'.$rw['nombre'].'</td>
                    		<td>'.$inicio.'</td>
                    		<td>'.$final.'</td>
                    		<td><a class="btn-link" data-toggle="modal" data-target="#modalInfo" data-tipo="verIns" data-id="'.$rw['id_horario'].'" href="#">'.$rw['inscritos'].' <i class="fa fa-users"></i></a></td>
                   			<td class="text-right">
                                <a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="verH" data-id="'.$rw['id_horario'].'" href="#"><i class="fa fa-search icon-view"></i></a>
                                <a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="modH" data-id="'.$rw['id_horario'].'" href="#"><i class="fa fa-edit icon-edit"></i></a>
                            </td>
                    	</tr>';
	    }
	} else {
	    $resultado = "";
	}

	$tabla = '<div class="p-20">
				<div class="mb-20">
					<button onclick="showContent(21)" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Agregar Horario</button>
					<button onclick="showContent(2)" type="button" class="btn btn-default">Ver Todos</button>
				</div>
				<div data-example-id="simple-responsive-table" class="bs-example">
	              <div class="table-responsive">
	                <table id="horarios" class="table table-striped table-hover">
	                  <thead>
	                    <tr>
	                      <th>Tipo</th>
	                      <th>Nombre</th>
	                      <th>Inicio</th>
	                      <th>Final</th>
	                      <th>Inscritos</th>
	                      <th></th>
	                    </tr>
	                  </thead>
	                  <tbody>
	                  '. $resultado .'
	                  </tbody>
	                </table>
	              </div>
	            </div>
			</div>';

	return $tabla;
}

function formHorarios($user){// Formulario para agregar horarios en admin
	$selectCT = selectCursos(0);
	$selectUB = selectLocation(0);
	$selectPR = selectTeacher(0);
	$result = '<div class="p-20">
				<form action="/api.php" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<div class="styled-select">
									<label>Curso - Taller:</label>
									'.$selectCT.'
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label>Ubicación:</label>
								'.$selectUB.'
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label>Profesor:</label>
								'.$selectPR.'
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label>Capacidad</label>
								<input placeholder="Ingrese la capacidad" pattern="[0-9]+" title="Solo se permiten números sin espacios" type="text" name="capacidad" required="" class="form-control">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label>Fecha de Inicio</label>
								<input type="date" name="inicio" required="" class="form-control">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label>Fecha de Culminación</label>
								<input type="date" name="final" required="" class="form-control">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-10">
								<label>Precio 1</label><small> - Cuota única</small>
								<input placeholder="Ingrese el precio 1" pattern="[0-9]+" title="Solo se permiten números sin espacios" type="text" name="precio1" required="" class="form-control">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-10">
								<label>Precio 2</label><small> - Dos cuotas</small>
								<input placeholder="Ingrese el precio 2" pattern="[0-9]+" title="Solo se permiten números sin espacios" type="text" name="precio2" required="" class="form-control">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-10">
								<label>Turno</label>
								<select class="form-control" name="turno" required="" >
									<option value="">Seleccione una opción</option>
									<option value="M">Matutino</option>
									<option value="V">Vespertino</option>
									<option value="F">Fin de Semana</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group mb-10">
								<label>Horario</label>
								<textarea name="horario" class="form-control" rows="2" placeholder="Ej. Lunes a Viernes. 8:00 am - 12:00 m"></textarea>
							</div>
						</div>
					</div>
					<input type="hidden" name="tipo" value="guardarHR">
					<input type="hidden" name="usuario" value="'.$user.'">
					<center class="mt-20"><button type="submit" name="savehr" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px">Guardar</button></center>
				</form>
			</div>';

	return $result;
}

function guardarHorario($fechainicio, $fechafinal, $turno, $horario, $cursoid, $ubicacionid, $idprofesor, $precio1, $precio2, $capacidad, $usuario){// Guarda los horarios en la base de datos
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
		die('Error en Conexión: ' . mysqli_error($dbh));
		exit;
	}

	$sql = "INSERT INTO horarios (fechainicio, fechafin, turno, horario, cursoid, ubicacionid, idprofesor, precio1, precio2, capacidad, iduser, inscritos) VALUES ('".$fechainicio."', '".$fechafinal."', '".$turno."', '".$horario."', '".$cursoid."', '".$ubicacionid."', '".$idprofesor."', '".$precio1."', '".$precio2."', '".$capacidad."', '".$usuario."', 0)";

	$result = "";
	if (mysqli_query($dbh, $sql)) {
		header('Location: ../admin/index.php?horario=success');
		die();
		$result = 1;
	} else {
		header('Location: ../admin/index.php?horario=fail');
		die();
		$result = 0;
	}
	return $result;
}

function verInfoCT($idCT){ // Muestra la información del curso seleccionado en tabla cursos
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT * FROM cursos WHERE id=".$idCT."";

	$final = array();
	$resultado= "";
	$nombrecurso= "";
	$i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		while ($rw = mysqli_fetch_array($search)) {
			$nombrecurso = $rw['nombre'];
			if ($rw['tipo'] == 1) {
				$tipo = 'Curso';
			} elseif ($rw['tipo'] == 2) {
				$tipo = 'Taller';
			}
			if ($rw['estado'] == 0) {
				$estado = 'Activo';
			} elseif ($rw['estado'] == 1) {
				$estado = 'Inactivo';
			}
			$resultado = '<div class="row mb-20">
							<div class="col-md-12">
						<div class="col-md-12 text-center">
								<img style="height: 250px;" src="/componentes/images/cursos/'.$rw['imagen'].'">
						</div>
					</div>
				</div>
				<div class="row mb-5">
						<div class="col-md-12">
								<div class="col-md-12"><b>Descripción:</b> '.ucfirst($rw['descripcion']).'</div>
						</div>
				</div>
				<div class="row mb-5">
					<div class="col-md-12">
							<div class="col-md-6">
								<b>Tipo:</b> '.$tipo.'
							</div>
							<div class="col-md-6">
								<b>Estado:</b> '.$estado.'
							</div>
					</div>
				</div>
				<div class="row mb-5">
					<div class="col-md-12">
							<div class="col-md-12">
								<b>Creado por:</b> '.consultarUsuario($rw['id_usuario']).'
							</div>
					</div>
				</div>';
		}
	} else {
		$nombrecurso = "Información no disponible";
		$resultado = "<div class='alert alert-danger'>Lo sentimos, actualmente la información no se encuentra disponible intenta nuevamente.</div>";
	}
	$final[0] = $resultado;
	$final[1] = $nombrecurso;

	return json_encode($final);
}

function consultarUsuario($iduser){#Consulta el nombre y apellido segun id del usuario
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "SELECT * FROM usuarios WHERE id=".$iduser."";

	$resultado= "";
	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		$rw = mysqli_fetch_array($search);
		$resultado = $rw['nombre'] ." ". $rw['apellido'];
	} else {
		$resultado = "Información no disponible";
	}
	return $resultado;
}

function modificarInfoCT($idCT, $user){ // Muestra el formulario para modificar los cursos talleres
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT * FROM cursos WHERE id=".$idCT."";

	$final = array();
	$resultado = "";
	$nombrecurso = "";
	$i = 0;
	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		while ($rw = mysqli_fetch_array($search)) {
			$nombrecurso = 'Modificar: '. $rw['nombre'];
			if ($rw['tipo'] == 1) {
				$opciones = '<option value="">- Seleccione una opción -</option>
				<option value="1" selected>Curso</option>
				<option value="2">Taller</option>';
			} elseif ($rw['tipo'] == 2) {
				$opciones = '<option value="">- Seleccione una opción -</option>
				<option value="1">Curso</option>
				<option value="2" selected>Taller</option>';
			} else {
				$opciones = '<option value="">- Seleccione una opción -</option>
				<option value="1">Curso</option>
				<option value="2">Taller</option>';
			}
			if ($rw['estado'] == 0) {
				$estado = '<option value="">- Seleccione una opción -</option>
				<option value="0" selected>Activo</option>
				<option value="1">Inactivo</option>';
			} elseif ($rw['estado'] == 1) {
				$estado = '<option value="">- Seleccione una opción -</option>
				<option value="0">Activo</option>
				<option value="1" selected>Inactivo</option>';
			} else {
				$estado = '<option value="">- Seleccione una opción -</option>
				<option value="0">Activo</option>
				<option value="1">Inactivo</option>';
			}
			if ($rw['tipo_eval'] == 'porcentual') {
				$tipo_eval = '<option value="">- Seleccione una opción -</option>
				<option value="1" selected>Porcentual</option>
				<option value="2">Promedial</option>';
			} elseif ($rw['tipo_eval'] == 'promedial') {
				$tipo_eval = '<option value="">- Seleccione una opción -</option>
				<option value="1">Porcentual</option>
				<option value="2" selected>Promedial</option>';
			} else {
				$tipo_eval = '<option value="">- Seleccione una opción -</option>
				<option value="1">Porcentual</option>
				<option value="2">Promedial</option>';
			}
			if ($rw['tipo_eval'] == 'porcentual') {
				if ($rw['cant_notas'] >= 1) {
					$porc_nota1 = '<div id="porc_nota1" class="col-sm-6">
					<div class="form-group mb-10">
						<label>Porcentaje nota 1</label>
						<input type="number" name="porc_nota1" min="1" class="form-control" value="'.$rw['porc_nota1'].'" required />
					</div>
					</div>';
				} else {
					$porc_nota1 = '<div id="porc_nota1" style="display: none;" class="col-sm-6">
					<div class="form-group mb-10">
						<label>Porcentaje nota 1</label>
						<input type="number" name="porc_nota1" min="1" class="form-control" value=""/>
					</div>
					</div>';
				}
				if ($rw['cant_notas'] >= 2) {
					$porc_nota2 = '<div id="porc_nota2" class="col-sm-6">
					<div class="form-group mb-10">
						<label>Porcentaje nota 2</label>
						<input type="number" name="porc_nota2" min="1" class="form-control" value="'.$rw['porc_nota2'].'" required />
					</div>
					</div>';
				} else {
					$porc_nota2 = '<div id="porc_nota2" style="display: none;" class="col-sm-6">
					<div class="form-group mb-10">
						<label>Porcentaje nota 2</label>
						<input type="number" name="porc_nota2" min="1" class="form-control" value=""/>
					</div>
					</div>';
				}
				if ($rw['cant_notas'] >= 3) {
					$porc_nota3 = '<div id="porc_nota3" class="col-sm-6">
					<div class="form-group mb-10">
						<label>Porcentaje nota 3</label>
						<input type="number" name="porc_nota3" min="1" class="form-control" value="'.$rw['porc_nota3'].'"/>
					</div>
					</div>';
				} else {
					$porc_nota3 = '<div id="porc_nota3" style="display: none;" class="col-sm-6">
					<div class="form-group mb-10">
						<label>Porcentaje nota 3</label>
						<input type="number" name="porc_nota3" min="1" class="form-control" value=""/>
					</div>
					</div>';
				}
				if ($rw['cant_notas'] >= 4) {
					$porc_nota4 = '<div id="porc_nota4" class="col-sm-6">
					<div class="form-group mb-10">
						<label>Porcentaje nota 4</label>
						<input type="number" name="porc_nota4" min="1" class="form-control" value="'.$rw['porc_nota4'].'"/>
					</div>
					</div>';
				} else {
					$porc_nota4 = '<div id="porc_nota4" style="display: none;" class="col-sm-6">
					<div class="form-group mb-10">
						<label>Porcentaje nota 4</label>
						<input type="number" name="porc_nota4" min="1" class="form-control" value=""/>
					</div>
					</div>';
				}
				if ($rw['cant_notas'] == 5) {
					$porc_nota5 = '<div id="porc_nota5" class="col-sm-6">
					<div class="form-group mb-10">
						<label>Porcentaje nota 5</label>
						<input type="number" name="porc_nota5" min="1" class="form-control" value="'.$rw['porc_nota5'].'"/>
					</div>
					</div>';
				} else {
					$porc_nota5 = '<div id="porc_nota5" style="display: none;" class="col-sm-6">
					<div class="form-group mb-10">
						<label>Porcentaje nota 5</label>
						<input type="number" name="porc_nota5" min="1" class="form-control" value=""/>
					</div>
					</div>';
				}
			} else {
				$porc_nota1 = '<div id="porc_nota1" style="display: none;" class="col-sm-6">
				<div class="form-group mb-10">
					<label>Porcentaje nota 1</label>
					<input type="number" name="porc_nota1" min="1" class="form-control" value=""/>
				</div>
				</div>';
				$porc_nota2 = '<div id="porc_nota2" style="display: none;" class="col-sm-6">
				<div class="form-group mb-10">
					<label>Porcentaje nota 2</label>
					<input type="number" name="porc_nota2" min="1" class="form-control" value=""/>
				</div>
				</div>';
				$porc_nota3 = '<div id="porc_nota3" style="display: none;" class="col-sm-6">
				<div class="form-group mb-10">
					<label>Porcentaje nota 3</label>
					<input type="number" name="porc_nota3" min="1" class="form-control" value=""/>
				</div>
				</div>';
				$porc_nota4 = '<div id="porc_nota4" style="display: none;" class="col-sm-6">
				<div class="form-group mb-10">
					<label>Porcentaje nota 4</label>
					<input type="number" name="porc_nota4" min="1" class="form-control" value=""/>
				</div>
				</div>';
				$porc_nota5 = '<div id="porc_nota5" style="display: none;" class="col-sm-6">
				<div class="form-group mb-10">
					<label>Porcentaje nota 5</label>
					<input type="number" name="porc_nota5" min="1" class="form-control" value=""/>
				</div>
				</div>';
			}

			$resultado = '<div class="p-30"><form class="mb-0" onsubmit="return validateForm()" action="/api.php" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-6">
					<div class="form-group mb-10">
						<div class="styled-select">
						<label>Seleccione el tipo</label>
						<select name="tipoct" id="tipoct" class="form-control" required="">
							'.$opciones.'
						</select>
						</div>
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group mb-10">
						<div class="styled-select">
						<label>Estado</label>
						<select name="status" id="status" class="form-control" required="">
							'.$estado.'
						</select>
						</div>
					</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group mb-10">
							<label>Nombre del curso o taller</label>
							<input value="'.$rw['nombre'].'" type="text" name="nombrect" id="nombrect" required="" class="form-control">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group mb-10">
							<label>Descripción</label>
							<textarea name="descripcion" id="descripcion" class="form-control" rows="3"  >'.$rw['descripcion'].'</textarea>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group mb-10">
							<label>Lista de Materiales</label>
							<textarea name="materiales" id="materiales" class="form-control" rows="3"  >'.$rw['materiales'].'</textarea>
						</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group mb-10">
						<label>Cantidad de notas</label>
						<input type="number" min="1" max="5" onchange="changeCantNotas()"  name="cant_notas" id="cant_notas" class="form-control" required="" value="'.$rw['cant_notas'].'"/>
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group mb-10">
						<div class="styled-select">
						<label>Tipo de evaluacion</label>
						<select name="tipo_eval" onchange="changeCantNotas()" id="tipo_eval" class="form-control" required="">
							'.$tipo_eval.'
						</select>
						</div>
					</div>
					</div>
						'.$porc_nota1.'
						'.$porc_nota2.'
						'.$porc_nota3.'
						'.$porc_nota4.'
						'.$porc_nota5.'
				</div>
				<div class="col-sm-12">
				<div class="form-group mb-10">
					<div class="styled-select">
					<h4 id="errorPoct" style="display: none;"><strong style="color: red;">La suma de los porcetajes debe ser igual a 100</strong></h4>
					</div>
				</div>
				</div>
				<input type="hidden" name="tipo" value="modificarCT">
				<input type="hidden" name="usuario" value="'.$user.'">
				<input type="hidden" name="idcurso" id="idcurso" value="'.$idCT.'">
				<div class="mt-0">
					<a style="cursor: pointer;" data-idct="'.$idCT.'" class="btn-link" onclick="showContent(111)"><i class="fa fa-picture-o"></i> Actualizar Imagen</a> |
					<a style="cursor: pointer;" data-idct="'.$idCT.'" class="btn-link" onclick="showContent(112)"><i class="fa fa-book"></i> Actualizar Guía</a>
				</div>
				<center class="mt-20">
					<button type="submit" name="modCT" id="modCT" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px">Guardar</button>
				</center>
				</form></div>';
		}
	} else {
		$nombrecurso = "Información no disponible";
		$resultado = "<div class='alert alert-danger'>Lo sentimos, actualmente la información no se encuentra disponible intenta nuevamente.</div>";
	}
	$final[0] = $resultado;
	$final[1] = $nombrecurso;

	return json_encode($final);
}

function updateCT($id, $tipo, $estado, $nombre, $descripcion, $usuario, $materiales, $cant_notas, $tipo_eval, $porc_nota1, $porc_nota3, $porc_nota2, $porc_nota4, $porc_nota5) {
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "UPDATE cursos SET nombre = '$nombre', tipo ='$tipo', descripcion = '$descripcion', estado = '$estado', materiales = '$materiales', cant_notas = $cant_notas, tipo_eval = $tipo_eval, porc_nota1 = $porc_nota1 , porc_nota2 = $porc_nota2, porc_nota3 = $porc_nota3, porc_nota4 = $porc_nota4, porc_nota5 = $porc_nota5 WHERE id = $id";

	$result = "";
	if (mysqli_query($dbh, $sql)) {
		header('Location: ../admin/index.php?ctupd=success&tipo='.$tipo.'');
		die();
		$result = 1;
	} else {
		header('Location: ../admin/index.php?ctupd=fail&tipo='.$tipo.'');
		die();
		$result = 0;
	}
	return $result;
}

function eliminarCT($idCT) { // Muestra el formulario para modificar los cursos talleres
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
		die('Error en Conexión: ' . mysqli_error($dbh));
		exit;
	}

	// $sql = "SELECT * FROM cursos WHERE id =$idCT";

	$final = array();
	$resultado = "";
	$nombrecurso = "";
	$i = 0;
	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	$resultado = '<div class="p-30"><form class="mb-0" onsubmit="return validateForm()" action="/api.php" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-12">
				<div class="form-group mb-10">
					<div class="styled-select">
					<label>Seleccione el tipo</label>
					<select name="tipoct" id="tipoct" class="form-control" required="">
						'.$opciones.'
					</select>
					</div>
				</div>
				</div>
			</div>
				// <center class="mt-20">
				<button type="submit" name="modCT" id="modCT" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px">Guardar</button>
			</center>
			</form></div>';
	$final[0] = $resultado;
	$final[1] = $nombrecurso;

	return json_encode($final);
}

function updateImagen($iduser, $idCT, $imagen){
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$foto = uploadFiles($imagen);

	if ($foto[0] == 1) {
		$sql = "UPDATE cursos SET imagen='".$foto[1]."' WHERE id=".$idCT."";

		$result = "";
		if (mysqli_query($dbh, $sql)) {
			header('Location: ../admin/index.php?ctupd=success&msg='.$foto[0].'');
			die();
			$result = 1;
		} else {
			header('Location: ../admin/index.php?ctupd=fail&msg='.$foto[0].'');
			die();
			$result = 0;
		}
	} else {
		header('Location: ../admin/index.php?ctupd=fail&msg='.$foto[0].'');
		die();
	}

	return $result;
}

function updateGuia($iduser, $idCT, $guia){
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$guia = uploadFiles($guia);

	if ($guia[0] == 1) {
		$sql = "INSERT INTO guias (nombre, id_curso) values ('$guia[1]', $idCT)";

		$result = "";
		if (mysqli_query($dbh, $sql)) {
			header('Location: ../admin/index.php?ctupd=success&msg='.$guia[0].'');
			die();
			$result = 1;
		} else {
			header('Location: ../admin/index.php?ctupd=fail&msg='.$guia[0].'');
			die();
			$result = 0;
		}
	} else {
		header('Location: ../admin/index.php?ctupd=fail&msg='.$guia[0].'');
		die();

	}

	return $result;
}

function verInfoHorarios($idhorario){// Muestra la información de los horarios en el modal en el administrador
	include 'estudios.php';
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT h.*, c.id, c.nombre, c.tipo, c.descripcion, c.idmodulo, c.id_usuario, c.estado, u.nombre AS location, u.direccion, u.telef1, u.telef2, u.pais FROM horarios h INNER JOIN cursos c ON h.cursoid = c.id INNER JOIN ubicacion u ON h.ubicacionid=u.id WHERE h.id_horario=".$idhorario."";

	$final = array();
	$resultado= "";
	$nombrecurso= "";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
	       	$turn = $rw['turno'];
	   		$inicio = date_format(date_create($rw['fechainicio']), 'd-m-Y');
	   		$fin = date_format(date_create($rw['fechafin']), 'd-m-Y');
    		$moneda = consultarMoneda($idhorario);
    		$cupos = $rw['capacidad'] - $rw['inscritos'];
	       	if ($turn == 'M') {
	       		$turn = 'Matutino';
	       	} elseif ($turn == 'V') {
	       		$turn = 'Vespertino';
	       	} elseif ($turn == 'F') {
	       		$turn = 'Fin de Semana';
	       	}
	       	if ($rw['tipo'] == 1) {
	       		$tipo = 'Curso';
	       	} elseif ($rw['tipo'] == 2) {
	       		$tipo = 'Taller';
	       	}
	       	$nombrecurso = $tipo.': '. $rw['nombre'];
			$resultado = '<div class="row mb-5">
						    <div class="col-md-12">
					          <div class="col-md-12"><b>Descripción:</b> '.ucfirst($rw['descripcion']).'</div>
						    </div>
						</div>
						<div class="row mb-5">
						  <div class="col-md-12">
						      <div class="col-md-6">
						        <b>Fecha de Inicio:</b> '.$inicio.'
						      </div>
						  	  <div class="col-md-6">
						        <b>Fecha Final:</b> '.$fin.'
						      </div>
						   </div>
						</div>
						<div class="row mb-5">
						  <div class="col-md-12">
						      <div class="col-md-6">
						        <b>Turno:</b> '.$turn.'
						      </div>
						      <div class="col-md-6">
						        <b>Horario:</b> '.$rw['horario'].'
						      </div>
						  </div>
						</div>
						<div class="row mb-5">
						  <div class="col-md-12">
						      <div class="col-md-6">
						        <b>Capacidad:</b> '.$rw['capacidad'].' Estudiantes
						      </div>
						      <div class="col-md-6">
						        <b>Cupos Disponibles:</b> '.$cupos.' Estudiantes
						      </div>
						  </div>
						</div>
						<div class="row mb-5">
						  <div class="col-md-12">
						      <div class="col-md-12">
						        <b>Academia: '.$rw['location'].'</b>
						      </div>
						  </div>
						</div>
						<div class="row mb-5">
						  <div class="col-md-12">
						    <div class="col-md-12">
						      <b>Dirección:</b> '.$rw['direccion'].'
						  	</div>
						  </div>
						</div>
						<div class="row mb-5">
						  <div class="col-md-12">
						      <div class="col-md-6">
						        <b>Teléfono 1:</b> '.$rw['telef1'].'
						      </div>
						      <div class="col-md-6">
						        <b>Teléfono 2:</b> '.$rw['telef2'].'
						      </div>
						  </div>
						</div>
						<div class="row mb-5">
						  <div class="col-md-12">
						  	<div class="col-md-12">
						  	  <b>Precio Total del Curso:</b>
						  	</div>
						  </div>
						  <div class="col-md-12">
						    <div class="col-md-6">
						      <b>De Contado:</b> '.number_format($rw['precio1'],2,",",".") ." ". $moneda.'
						    </div>
						    <div class="col-md-6">
						      <b>Dos Cuotas:</b> '.number_format($rw['precio2'],2,",",".") ." ". $moneda.'
						    </div>
						  </div>
						</div>';
	        }
	    } else {
	    	$nombrecurso = "Información no disponible";
	    	$resultado = "<div class='alert alert-danger'>Lo sentimos, actualmente la información no se encuentra disponible intenta nuevamente.</div>";
	    }
	    $final[0] = $resultado;
	    $final[1] = $nombrecurso;

	return json_encode($final);
}

function modificarInfoHorarios($idhorario, $usuario){#Muestra el formulario para modificar los horarios
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT h.*, c.id, c.nombre, c.tipo, c.descripcion, c.idmodulo, c.id_usuario, c.estado, u.nombre AS location, u.direccion, u.telef1, u.telef2, u.pais FROM horarios h INNER JOIN cursos c ON h.cursoid = c.id INNER JOIN ubicacion u ON h.ubicacionid=u.id WHERE h.id_horario=".$idhorario."";

	$final = array();
	$resultado= "";
	$nombrecurso= "";
	$i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
	       	$nombrecurso = 'Modificar: '. $rw['nombre'];
	       	$selectUB = selectLocation($rw['ubicacionid']);
	       	$selectPR = selectTeacher($rw['idprofesor']);
	       	if ($rw['turno'] == 'M') {
	       		$turno = '<option value="">Seleccione una opción</option>
						<option value="M" selected>Matutino</option>
						<option value="V">Vespertino</option>
						<option value="F">Fin de Semana</option>';
	       	} elseif ($rw['turno'] == 'V') {
	       		$turno = '<option value="">Seleccione una opción</option>
						<option value="M">Matutino</option>
						<option value="V" selected>Vespertino</option>
						<option value="F">Fin de Semana</option>';
	       	} elseif ($rw['turno'] == 'F') {
	       		$turno = '<option value="">Seleccione una opción</option>
						<option value="M">Matutino</option>
						<option value="V">Vespertino</option>
						<option value="F" selected>Fin de Semana</option>';
	       	} else {
	       		$turno = '<option value="">Seleccione una opción</option>
						<option value="M">Matutino</option>
						<option value="V">Vespertino</option>
						<option value="F">Fin de Semana</option>';
	       	}
			$resultado = '<div class="p-20">
				<form action="/api.php" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group mb-10">
								<div class="styled-select">
									<label class="mb-0">Curso - Taller:</label>
									<input type="text" value="'.$rw['nombre'].'" class="form-control" disabled>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label class="mb-0">Ubicación:</label>
								'.$selectUB.'
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label class="mb-0">Profesor:</label>
								'.$selectPR.'
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label class="mb-0">Capacidad</label>
								<input placeholder="Ingrese la capacidad" pattern="[0-9]+" title="Solo se permiten números sin espacios" type="text" name="capacidad" value="'.$rw['capacidad'].'" required="" class="form-control">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label class="mb-0">Turno</label>
								<select class="form-control" name="turno" required="" >
									'.$turno.'
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label class="mb-0">Fecha de Inicio</label>
								<input type="date" name="inicio" required="" class="form-control" value="'.$rw['fechainicio'].'">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label class="mb-0">Fecha de Culminación</label>
								<input type="date" name="final" required="" class="form-control" value="'.$rw['fechafin'].'">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label class="mb-0">Precio 1</label><small> - Cuota única</small>
								<input placeholder="Ingrese el precio 1" pattern="[0-9]+" title="Solo se permiten números sin espacios" type="text" name="precio1" required="" value="'.$rw['precio1'].'" class="form-control">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-10">
								<label class="mb-0">Precio 2</label><small> - Dos cuotas</small>
								<input placeholder="Ingrese el precio 2" pattern="[0-9]+" title="Solo se permiten números sin espacios" type="text" name="precio2" required="" value="'.$rw['precio2'].'" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group mb-10">
								<label class="mb-0">Horario</label>
								<textarea name="horario" class="form-control" rows="2">'.$rw['horario'].'</textarea>
							</div>
						</div>
					</div>
					<input type="hidden" name="tipo" value="modificarHR">
					<input type="hidden" name="usuario" value="'.$usuario.'">
					<input type="hidden" name="idhr" value="'.$idhorario.'">
					<center class="mt-10"><button type="submit" name="savehr" class="btn btn-default">Guardar</button></center>
				</form>
			</div>';
	        }
	    } else {
	    	$nombrecurso = "Información no disponible";
	    	$resultado = "<div class='alert alert-danger'>Lo sentimos, actualmente la información no se encuentra disponible intenta nuevamente.</div>";
	    }
	    $final[0] = $resultado;
	    $final[1] = $nombrecurso;

	return json_encode($final);
}

function modificarHorarios($ubicacion, $profesor, $capacidad, $inicio, $final, $precio1, $precio2, $turno, $horario, $usuario, $idhr){#Modifica los horarios en la BD
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "UPDATE horarios SET ubicacionid='".$ubicacion."', idprofesor='".$profesor."', capacidad='".$capacidad."', fechainicio='".$inicio."', fechafin='".$final."', precio1='".$precio1."', precio2='".$precio2."', turno='".$turno."', horario='".$horario."' WHERE id_horario=".$idhr."";

	$result = "";
	if (mysqli_query($dbh, $sql)) {
		header('Location: ../admin/index.php?hrupd=success');
		die();
		$result = 1;
	} else {
		header('Location: ../admin/index.php?hrupd=fail');
		die();
		$result = 0;
	}
	return $result;
}

function verInscritosHorario($idhorario){#Muestra los estudiantes inscritos por horario
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT i.*, e.*, h.* FROM inscripcion i INNER JOIN horarios h ON i.idhorario=h.id_horario INNER JOIN estudiantes e ON i.idestudiante=e.id WHERE i.inscripcion=1 AND h.id_horario=".$idhorario."";

	$final = array();
	$resultado= "";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    while ($rw = mysqli_fetch_array($search)) {
	    	list($n1) = explode(" ", $rw['nombre']);
  			list($a1) = explode(" ", $rw['apellido']);
	    	$nombre = $n1 ." ". $a1;
	    	if ($rw['status'] == 0) {
	    		$deuda = 'Pago pendiente';
	    	} elseif ($rw['status'] == 1) {
	    		$deuda = 'Cuota 2 pendiente';
	    	} elseif ($rw['status'] == 2) {
	    		$deuda = 'Pagado';
	    	}
			$resultado .= '<tr>
                    		<td>'.$rw['documentacion'].'</td>
                    		<td>'.$nombre.'</td>
                    		<td>'.$deuda.'</td>
                    		<td>'.$rw['telef2'].'</td>
                    	</tr>';
	    }
		$tabla = '<div>
					<div data-example-id="simple-responsive-table" class="bs-example">
		              <div class="table-responsive">
		                <table id="inscritos" class="table table-striped table-hover">
		                  <thead>
		                    <tr>
		                      <th>ID</th>
		                      <th>Nombre</th>
		                      <th>Pago</th>
		                      <th>Teléfonos</th>
		                    </tr>
		                  </thead>
		                  <tbody>
		                  '. $resultado .'
		                  </tbody>
		                </table>
		              </div>
		            </div>
				</div>';
	} else {
	    $tabla = "<div class='alert alert-danger'>Lo sentimos, actualmente no hay estudiantes inscritos en el curso o taller seleccionado.</div>";
	}
	$nombrect = "Estudiantes Inscritos: ".consultarNombreCTH($idhorario);

	$final[0] = $tabla;
	$final[1] = $nombrect;

	return json_encode($final);
}

function consultarNombreCTH($idhorario){#Consulta el nombre del curso segun id horario
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "SELECT h.cursoid, c.nombre FROM horarios h INNER JOIN cursos c ON h.cursoid=c.id WHERE id_horario=".$idhorario."";

	$resultado= "";
	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		$rw = mysqli_fetch_array($search);
		$resultado = $rw['nombre'];
	} else {
		$resultado = "Información no disponible";
	}
	return $resultado;
}

function verEstudiantes(){#Muestra la tabla de estudiantes
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT * FROM estudiantes";

	$resultado= "";
	$i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    while ($rw = mysqli_fetch_array($search)) {
	    	$documento = $rw['tipo_doc'] .'-'. $rw['documentacion'];
	    	list($n1) = explode(" ", $rw['nombre']);
  			list($a1) = explode(" ", $rw['apellido']);
	    	$nombre = $n1 ." ". $a1;
	    	if ($rw['estado'] == 0) {
	    		$estado = 'Inactivo';
	    	} elseif ($rw['estado'] == 1) {
	    		$estado = 'Activo';
	    	} elseif ($rw['estado'] == 2) {
	    		$estado = 'Suspendido';
	    	}
			$resultado .= '<tr>
                    		<td>'.$documento.'</td>
                    		<td>'.$nombre.'</td>
                    		<td><small>'.$rw['correo'].'</small></td>
                    		<td>'.$estado.'</td>
                   			<td class="text-right">
                                <a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="verEst" data-id="'.$rw['id'].'" href="#"><i class="fa fa-search icon-view"></i></a>
                                <a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="modEst" data-id="'.$rw['id'].'" href="#"><i class="fa fa-edit icon-edit"></i></a>
                            </td>
                    	</tr>';
	    }
	} else {
	    $resultado = "";
	}

	$tabla = '<div class="p-20">
				<div class="mb-20">
					<button onclick="showContent(31)" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Agregar Estudiante</button>
					<button onclick="showContent(32)" type="button" class="btn btn-default">Ver Morosos</button>
				</div>
				<div data-example-id="simple-responsive-table" class="bs-example">
	              <div class="table-responsive">
	                <table id="estudiantes" class="table table-striped table-hover">
	                  <thead>
	                    <tr>
	                      <th>ID</th>
	                      <th>Nombre</th>
	                      <th>Correo</th>
	                      <th>Estado</th>
	                      <th></th>
	                    </tr>
	                  </thead>
	                  <tbody>
	                  '. $resultado .'
	                  </tbody>
	                </table>
	              </div>
	            </div>
			</div>';

	return $tabla;
}

function verEstudiantesMorosos() { // Consulta los cursos activos asignados al docente
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT * FROM estudiantes e
	INNER JOIN inscripcion i ON e.id = i.idestudiante
	INNER JOIN horarios h ON i.idhorario = h.id_horario
	WHERE i.status = 1 AND CURDATE() >= ( DATE_ADD(h.fechainicio, INTERVAL ROUND(datediff(h.fechafin, h.fechainicio)/2, 0) DAY )) AND h.fechafin > CURDATE()";

	$resultado= "";
	$i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    while ($rw = mysqli_fetch_array($search)) {
	    	$documento = $rw['tipo_doc'] .'-'. $rw['documentacion'];
	    	list($n1) = explode(" ", $rw['nombre']);
  			list($a1) = explode(" ", $rw['apellido']);
	    	$nombre = $n1 ." ". $a1;
	    	if ($rw['estado'] == 0) {
	    		$estado = 'Inactivo';
	    	} elseif ($rw['estado'] == 1) {
	    		$estado = 'Activo';
	    	} elseif ($rw['estado'] == 2) {
	    		$estado = 'Suspendido';
	    	}
			$resultado .= '<tr>
                    		<td>'.$documento.'</td>
                    		<td>'.$nombre.'</td>
                    		<td><small>'.$rw['correo'].'</small></td>
                    		<td>'.$estado.'</td>
                   			<td class="text-right">
                                <a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="verEst" data-id="'.$rw['id'].'" href="#"><i class="fa fa-search icon-view"></i></a>
                                <a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="modEst" data-id="'.$rw['id'].'" href="#"><i class="fa fa-edit icon-edit"></i></a>
                            </td>
                    	</tr>';
	    }
	} else {
	    $resultado = "";
	}

	$tabla = '<div class="p-20">
				<div class="mb-20">
					<button onclick="showContent(31)" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Agregar Estudiante</button>
					<button onclick="showContent(3)" type="button" class="btn btn-default">Ver Estudiantes</button>
				</div>
				<div data-example-id="simple-responsive-table" class="bs-example">
	              <div class="table-responsive">
	                <table id="estudiantes" class="table table-striped table-hover">
	                  <thead>
	                    <tr>
	                      <th>ID</th>
	                      <th>Nombre</th>
	                      <th>Correo</th>
	                      <th>Estado</th>
	                      <th></th>
	                    </tr>
	                  </thead>
	                  <tbody>
	                  '. $resultado .'
	                  </tbody>
	                </table>
	              </div>
	            </div>
			</div>';

	return $tabla;
}

function verInfoEstudiantes($idestudiante){#Muestra la info de estudiantes en el modal
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT * FROM estudiantes WHERE id=".$idestudiante."";

	$final = array();
	$resultado= "";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    $rw = mysqli_fetch_array($search);
	    $nombre = $rw['nombre']." ".$rw['apellido'];
	    $doc = $rw['tipo_doc']."-".$rw['documentacion'];
	   	if ($rw['estado'] == 0) {
	   		$estado = 'Inactivo';
	   	} elseif ($rw['estado'] == 1) {
	   		$estado = 'Activo';
	    } elseif ($rw['estado'] == 2) {
	    	$estado = 'Suspendido';
	    }
	   	if ($rw['genero'] == 1) {
	   		$genero = 'Femenino';
	   	} elseif ($rw['genero'] == 2) {
	   		$genero = 'Masculino';
    	}
    	$resultado = '<div class="row mb-5">
						<div class="col-md-12">
					      <div class="col-md-6"><b>Documento:</b> '.$doc.'</div>
					      <div class="col-md-6"><b>Estado:</b> '.$estado.'</div>
					    </div>
					</div>
					<div class="row mb-5">
						<div class="col-md-12">
				          <div class="col-md-6"><b>Nombre:</b> '.$rw['nombre'].'</div>
					      <div class="col-md-6"><b>Apellido:</b> '.$rw['apellido'].' </div>
				 	    </div>
					</div>
					<div class="row mb-5">
					  <div class="col-md-12">
					  	  <div class="col-md-6">
		    			  	<b>Fecha de Nacimiento:</b>
						  	  '.date_format(date_create($rw['fechadenacimiento']), 'd-m-Y').'
					  	  </div>
					      <div class="col-md-6">
					        <b>Género:</b> '.$genero.'
						  </div>
					  </div>
					</div>
					<div class="row mb-5">
					  <div class="col-md-12">
			   	        <div class="col-md-6">
				          <b>Fecha de Registro:</b> '.date_format(date_create($rw['fecha_reg']), 'd-m-Y').'
	  			        </div>
					    <div class="col-md-6">
			   	          <b>Hora de Registro:</b> '.$rw['hora_reg'].'
					    </div>
					  </div>
					</div>
					<div class="row mb-5">
					  <div class="col-md-12">
					      <div class="col-md-12"><b>Profesión:</b> '.$rw['profesion'].' </div>
					  </div>
					</div>
					<div class="row mb-5">
					  <div class="col-md-12">
					      <div class="col-md-12"><b>Correo Electrónico:</b> '.$rw['correo'].' </div>
					  </div>
					</div>
					<div class="row mb-5">
					  <div class="col-md-12">
					      <div class="col-md-12">
					        <b>Teléfonos:</b> '.$rw['telef1'].' - '.$rw['telef2'].' - '.$rw['telef3'].'
					      </div>
					  </div>
					</div>
					<div class="row mb-5">
					  <div class="col-md-12">
					      <div class="col-md-12">
					        <b>Dirección:</b> '.ucfirst($rw['direccion']).'
					      </div>
					  </div>
					</div>';
	} else {
	    $resultado = "<div class='alert alert-danger'>Lo sentimos, actualmente la información no está disponible intente más tarde nuevamente.</div>";
	}

	$final[0] = $resultado;
	$final[1] = $nombre;

	return json_encode($final);
}

function modificarDatosEstudiante($idestudiante, $usuario){#Muestra el formulario para modificar datos de estudiantes
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT * FROM estudiantes WHERE id=".$idestudiante."";

	$final = array();
	$formulario= "";
	$nombre= "";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    $rw = mysqli_fetch_array($search);
	    $nombre = "Modificar: ".$rw['nombre'] ." ". $rw['apellido'];
	    if ($rw['tipo_doc'] == 'V') {
	    	$valores = '<option value="">- Tipo de Identificación -</option>
		                <option value="V" selected>V</option>
		                <option value="E">E</option>
		                <option value="P">P</option>
		                <option value="J">J</option>';
	    } elseif ($rw['tipo_doc'] == 'E') {
	    	$valores = '<option value="">- Tipo de Identificación -</option>
		                <option value="V">V</option>
		                <option value="E" selected>E</option>
		                <option value="P">P</option>
		                <option value="J">J</option>';
	    } elseif ($rw['tipo_doc'] == 'P') {
	    	$valores = '<option value="">- Tipo de Identificación -</option>
		                <option value="V">V</option>
		                <option value="E">E</option>
		                <option value="P" selected>P</option>
		                <option value="J">J</option>';
	    } elseif ($rw['tipo_doc'] == 'J') {
	    	$valores = '<option value="">- Tipo de Identificación -</option>
		                <option value="V">V</option>
		                <option value="E">E</option>
		                <option value="P">P</option>
		                <option value="J" selected>J</option>';
	    } else {
	    	$valores = '<option value="">- Tipo de Identificación -</option>
		                <option value="V">V</option>
		                <option value="E">E</option>
		                <option value="P">P</option>
		                <option value="J">J</option>';
	    }
	    if ($rw['estadocivil'] == 1) {
	    	$civil = '<option value="">- Estado Civil -</option>
		                <option value="1" selected> Soltero </option>
		                <option value="2"> Casado </option>
		                <option value="3"> Concubinato </option>
		                <option value="4"> Divorciado </option>
		                <option value="5"> Viudo </option>
		                <option value="6"> Otro </option>';
	    } elseif ($rw['estadocivil'] == 2) {
	    	$civil = '<option value="">- Estado Civil -</option>
		                <option value="1"> Soltero </option>
		                <option value="2" selected> Casado </option>
		                <option value="3"> Concubinato </option>
		                <option value="4"> Divorciado </option>
		                <option value="5"> Viudo </option>
		                <option value="6"> Otro </option>';
	    } elseif ($rw['estadocivil'] == 3) {
	    	$civil = '<option value="">- Estado Civil -</option>
		                <option value="1"> Soltero </option>
		                <option value="2"> Casado </option>
		                <option value="3" selected> Concubinato </option>
		                <option value="4"> Divorciado </option>
		                <option value="5"> Viudo </option>
		                <option value="6"> Otro </option>';
	    } elseif ($rw['estadocivil'] == 4) {
	    	$civil = '<option value="">- Estado Civil -</option>
		                <option value="1"> Soltero </option>
		                <option value="2"> Casado </option>
		                <option value="3"> Concubinato </option>
		                <option value="4" selected> Divorciado </option>
		                <option value="5"> Viudo </option>
		                <option value="6"> Otro </option>';
	    } elseif ($rw['estadocivil'] == 5) {
	    	$civil = '<option value="">- Estado Civil -</option>
		                <option value="1"> Soltero </option>
		                <option value="2"> Casado </option>
		                <option value="3"> Concubinato </option>
		                <option value="4"> Divorciado </option>
		                <option value="5" selected> Viudo </option>
		                <option value="6"> Otro </option>';
	    } elseif ($rw['estadocivil'] == 6) {
	    	$civil = '<option value="">- Estado Civil -</option>
		                <option value="1"> Soltero </option>
		                <option value="2"> Casado </option>
		                <option value="3"> Concubinato </option>
		                <option value="4"> Divorciado </option>
		                <option value="5"> Viudo </option>
		                <option value="6" selected> Otro </option>';
	    } else {
	    	$civil = '<option value="">- Estado Civil -</option>
		                <option value="1"> Soltero </option>
		                <option value="2"> Casado </option>
		                <option value="3"> Concubinato </option>
		                <option value="4"> Divorciado </option>
		                <option value="5"> Viudo </option>
		                <option value="6"> Otro </option>';
	    }
	    if ($rw['genero'] == 1) {
	    	$genero = '<option value="">- Sexo -</option>
		                <option value="1" selected>Femenino</option>
		                <option value="2">Masculino</option>';
	    } elseif ($rw['genero'] == 2) {
	    	$genero = '<option value="">- Sexo -</option>
		                <option value="1">Femenino</option>
		                <option value="2" selected>Masculino</option>';
	    } else {
	    	$genero = '<option value="">- Sexo -</option>
		                <option value="1">Femenino</option>
		                <option value="2">Masculino</option>';
	    }
	    if ($rw['estado'] == 0 || $rw['estado'] == 1) {
	    	$estadouser = '<option value="">Seleccione una opción</option>
			                <option value="1" selected> Activo </option>
			                <option value="2"> Suspendido </option>';
	    } elseif ($rw['estado'] == 2) {
	    	$estadouser = '<option value="">Seleccione una opción</option>
			                <option value="1"> Activo </option>
			                <option value="2" selected> Suspendido </option>';
	    } else {
	    	$estadouser = '<option value="">Seleccione una opción</option>
			                <option value="1"> Activo </option>
			                <option value="2"> Suspendido </option>';
	    }
		$formulario = '<div class="p-20">
					<form action="/api.php" method="POST" name="reservation_form" class="reservation-form">
		            <div class="row">
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <div class="styled-select">
		                  	<label class="mb-0">Tipo Documento</label>
		                    <select name="tipodoc" class="form-control" required="">
		                      '.$valores.'
		                    </select>
		                  </div>
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Documento de Identificación</label>
		                  <input type="text" name="id" value="'.$rw['documentacion'].'" required="" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Nombres</label>
		                  <input type="text" name="name" value="'.$rw['nombre'].'" required="" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Apellidos</label>
		                  <input type="text" name="lastname" value="'.$rw['apellido'].'" required="" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Estado Civil</label>
		                  <select name="civil" class="form-control" required="">
		                      '.$civil.'
		                    </select>
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Profesión</label>
		                  <input type="text" name="profesion" value="'.$rw['profesion'].'" class="form-control" required="">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Fecha de Nacimiento</label>
		                  <input name="ffnn" class="form-control" value="'.$rw['fechadenacimiento'].'" type="date" required="" aria-required="true">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">País de Nacimiento</label>
		                  <select class="form-control bfh-countries" name="paises" data-country="'.$rw['paisnacimiento'].'"></select>
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Género</label>
		                  <div class="styled-select">
		                    <select name="sexo" class="form-control" required="">
		                      '.$genero.'
		                    </select>
		                  </div>
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Teléfono de Habitación</label>
		                  <input type="text" name="hphone" value="'.$rw['telef1'].'" class="form-control" required="">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Teléfono Celular 1</label>
		                  <input type="text" name="cphone1" value="'.$rw['telef2'].'" class="form-control" required="">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Teléfono Celular 2</label>
		                  <input type="text" name="cphone2" value="'.$rw['telef3'].'" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Correo Electrónico</label>
		                  <input type="email" name="email" value="'.$rw['correo'].'" class="form-control" required="">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Estado</label>
		                  <select name="estado" class="form-control" required="">
		                    '.$estadouser.'
		                  </select>
		                </div>
		              </div>
		              <div class="col-sm-12">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Dirección</label>
		                  <textarea name="address" class="form-control" required="" cols="20" rows="2">'.$rw['direccion'].'</textarea>
		                </div>
		              </div>
		            </div>
		            <input type="hidden" name="tipo" value="modificarEst">
					<input type="hidden" name="usuario" value="'.$usuario.'">
					<input type="hidden" name="idest" value="'.$idestudiante.'">
		            <div class="text-center">
		              <button type="submit" name="reg-insc" id="regModal-insc" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px">Guardar</button>
		            </div>
		          </form>
			</div>';
    } else {
    	$nombre = 'Información no disponible';
	    $formulario = "<div class='alert alert-danger'>Lo sentimos, actualmente la información no está disponible intente más tarde nuevamente.</div>";
	}

	$final[0] = $formulario;
	$final[1] = $nombre;

	return json_encode($final);
}

function modificarEstudiante($tipo, $doc, $nombre, $apellido, $civil, $profesion, $ffnn, $paises, $sexo, $telf1, $telf2, $telf3, $correo, $direccion, $user, $idest, $estado){#Modifica los datos de estudiante en la BD
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "UPDATE estudiantes SET tipo_doc='".$tipo."', documentacion='".$doc."', nombre='".$nombre."', apellido='".$apellido."', estadocivil='".$civil."', profesion='".$profesion."', fechadenacimiento='".$ffnn."', paisnacimiento='".$paises."', genero='".$sexo."', telef1='".$telf1."', telef2='".$telf2."', telef3='".$telf3."', correo='".$correo."', direccion='".$direccion."', estado='".$estado."' WHERE id=".$idest."";

	$result = "";
	if (mysqli_query($dbh, $sql)) {
		header('Location: ../admin/index.php?updest=success');
		die();
		$result = 1;
	} else {
		header('Location: ../admin/index.php?updest=fail');
		die();
		$result = 0;
	}
	return $result;
}

function formAddEstudiante(){
	$result = '<div class="p-20"><form action="/api.php" class="reservation-form" method="POST">
            <div class="row">
              <div class="col-md-12 text-center mb-10"><strong><i class="fa fa-user"></i> Datos Personales del Estudiante</strong></div>
              <div class="col-sm-4">
                <div class="form-group mb-20">
                  <div class="styled-select">
                    <select name="ident1" id="ident1" class="form-control" required="">
                      <option value="">- Tipo de Identificación -</option>
                      <option value="V">V</option>
                      <option value="E">E</option>
                      <option value="P">P</option>
                      <option value="J">J</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group mb-20">
                  <input placeholder="Número de Identificación" type="text" name="ident2" id="ident2" required="" class="form-control">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group mb-20">
                  <input placeholder="Nombres" type="text" name="name" id="name"  required="" class="form-control">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group mb-20">
                  <input placeholder="Apellidos" type="text" name="lastname" id="lastname" required="" class="form-control">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group mb-20">
                  <select name="civil" id="civil" class="form-control" required="">
                      <option value="">- Estado Civil -</option>
                      <option value="1"> Soltero </option>
                      <option value="2"> Casado </option>
                      <option value="3"> Concubinato </option>
                      <option value="4"> Divorciado </option>
                      <option value="5"> Viudo </option>
                      <option value="6"> Otro </option>
                    </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group mb-20">
                  <input placeholder="Profesión" type="text" name="profesion" id="profesion" class="form-control" required="">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group mb-20">
                  <input name="ffnn" id="ffnn" class="form-control" type="date" placeholder="Fecha de Nacimiento" required="" aria-required="true">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group mb-20">
                  <select name="country" id="country" class="form-control bfh-countries" data-country="" required=""></select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group mb-20">
                  <div class="styled-select">
                    <select name="sexo" id="sexo" class="form-control" required="">
                      <option value="">- Sexo -</option>
                      <option value="1">Femenino</option>
                      <option value="2">Masculino</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 text-center mb-10"><strong><i class="fa fa-phone"></i> Datos de Contacto del Estudiante</strong></div>
              <div class="col-sm-6">
                <div class="form-group mb-20">
                  <input placeholder="Correo electrónico" type="email" name="email" id="email" class="form-control" required="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-20">
                  <input placeholder="Teléfono de Habitación" type="text" name="hphone" id="hphone" class="form-control" required="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-20">
                  <input placeholder="Teléfono Celular 1" type="text" name="cphone1" id="cphone1" class="form-control" required="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-20">
                  <input placeholder="Teléfono Celular 2" type="text" name="cphone2" id="cphone2" class="form-control">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group mb-20">
                  <textarea placeholder="Dirección de Residencia" name="address" id="address" class="form-control" required="" cols="20" rows="2"></textarea>
                </div>
              </div>
            </div>
    		<input type="hidden" name="tipo" value="regUserFromAdmin">
            <div class="text-center">
              <button type="submit" name="reg-insc" id="regModal-insc" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px" data-loading-text="Por favor espera...">Registrar</button>
            </div>
          </form>
        </div>';

    return $result;
}

function verProfesores(){#Muestra la tabla de profesores en el administrador
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT * FROM usuarios WHERE permisos=10";

	$resultado= "";
	$i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    while ($rw = mysqli_fetch_array($search)) {
	    	$documento = $rw['documentacion'];
	    	list($n1) = explode(" ", $rw['nombre']);
  			list($a1) = explode(" ", $rw['apellido']);
	    	$nombre = $n1 ." ". $a1;
	    	if ($rw['estado'] == 0) {
	    		$estado = 'Inactivo';
	    	} elseif ($rw['estado'] == 1) {
	    		$estado = 'Activo';
	    	} elseif ($rw['estado'] == 2) {
	    		$estado = 'Suspendido';
	    	}
			$resultado .= '<tr>
                    		<td>'.$documento.'</td>
                    		<td>'.$nombre.'</td>
                    		<td><small>'.$rw['correo'].'</small></td>
                    		<td>'.$estado.'</td>
                   			<td class="text-right">
                                <a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="verInfoProf" data-id="'.$rw['id'].'" href="#"><i class="fa fa-search icon-view"></i></a>
                                <a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="modInfoProf" data-id="'.$rw['id'].'" href="#"><i class="fa fa-edit icon-edit"></i></a>
                            </td>
                    	</tr>';
	    }
	} else {
	    $resultado = "";
	}

	$tabla = '<div class="p-20">
				<div class="mb-20">
					<button onclick="showContent(41)" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Agregar Profesor</button>
				</div>
				<div data-example-id="simple-responsive-table" class="bs-example">
	              <div class="table-responsive">
	                <table id="profesores" class="table table-striped table-hover">
	                  <thead>
	                    <tr>
	                      <th>ID</th>
	                      <th>Nombre</th>
	                      <th>Correo</th>
	                      <th>Estado</th>
	                      <th></th>
	                    </tr>
	                  </thead>
	                  <tbody>
	                  '. $resultado .'
	                  </tbody>
	                </table>
	              </div>
	            </div>
			</div>';

	return $tabla;
}

function verInfoProf($idprof){# Muestra la informacion del profesor en el modal
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT * FROM usuarios WHERE id=".$idprof."";

	$final = array();
	$resultado= "";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    $rw = mysqli_fetch_array($search);
	    $nombre = $rw['nombre'].' '.$rw['apellido'];
	    $doc = $rw['documentacion'];
	   	if ($rw['estado'] == 0) {
	   		$estado = 'Inactivo';
	   	} elseif ($rw['estado'] == 1) {
	   		$estado = 'Activo';
	    } elseif ($rw['estado'] == 2) {
	   		$estado = 'Suspendido';
	    }
    	$resultado = '<div class="row mb-5">
						<div class="col-md-12">
					      <div class="col-md-6"><b>Documento:</b> '.$doc.'</div>
					      <div class="col-md-6"><b>Estado:</b> '.$estado.'</div>
					    </div>
					</div>
					<div class="row mb-5">
						<div class="col-md-12">
				          <div class="col-md-6"><b>Nombre:</b> '.$rw['nombre'].'</div>
					      <div class="col-md-6"><b>Apellido:</b> '.$rw['apellido'].' </div>
				 	    </div>
					</div>
					<div class="row mb-5">
					  <div class="col-md-12">
					  	  <div class="col-md-12">
		    			  	<b>Teléfonos:</b> '.$rw['telef1'].' - '.$rw['telef2'].'
					  	  </div>
					  </div>
					</div>
					<div class="row mb-5">
					  <div class="col-md-12">
			   	        <div class="col-md-6">
				          <b>Correo Electrónico:</b> '.$rw['correo'].'
	  			        </div>
					  </div>
					</div>';
	} else {
	    $resultado = "<div class='alert alert-danger'>Lo sentimos, actualmente la información no está disponible intente más tarde nuevamente.</div>";
	}

	$final[0] = $resultado;
	$final[1] = $nombre;

	return json_encode($final);
}

function modInfoProf($idprof, $usuario){#Muestra el formulario para modificar datos de estudiantes
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT * FROM usuarios WHERE id=".$idprof."";

	$final = array();
	$formulario= "";
	$nombre= "";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    $rw = mysqli_fetch_array($search);
	    $nombre = "Modificar: Profesor ".$rw['nombre'] ." ". $rw['apellido'];
	    if ($rw['estado'] == 0 || $rw['estado'] == 1) {
	    	$estadouser = '<option value="">Seleccione una opción</option>
			                <option value="1" selected> Activo </option>
			                <option value="2"> Suspendido </option>';
	    } elseif ($rw['estado'] == 2) {
	    	$estadouser = '<option value="">Seleccione una opción</option>
			                <option value="1"> Activo </option>
			                <option value="2" selected> Suspendido </option>';
	    } else {
	    	$estadouser = '<option value="">Seleccione una opción</option>
			                <option value="1"> Activo </option>
			                <option value="2"> Suspendido </option>';
	    }
		$formulario = '<div class="p-20">
					<form action="/api.php" method="POST" class="reservation-form">
		            <div class="row">
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Documento de Identificación</label>
		                  <input type="text" name="id" value="'.$rw['documentacion'].'" required="" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Estado</label>
		                  <div class="styled-select">
		                    <select name="estado" class="form-control" required="">
		                      '.$estadouser.'
		                    </select>
		                  </div>
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Nombre</label>
		                  <input type="text" name="nombre" value="'.$rw['nombre'].'" required="" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Apellido</label>
		                  <input type="text" name="apellido" value="'.$rw['apellido'].'" required="" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-12">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Correo Electrónico</label>
		                  <input type="email" name="correo" value="'.$rw['correo'].'" class="form-control" required="">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Teléfono 1</label>
		                  <input type="text" name="telef1" value="'.$rw['telef1'].'" class="form-control" required="">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Teléfono 2</label>
		                  <input type="text" name="telef2" value="'.$rw['telef2'].'" class="form-control" required="">
		                </div>
		              </div>
		            </div>
		            <input type="hidden" name="tipo" value="modificarProfesor">
					<input type="hidden" name="usuario" value="'.$usuario.'">
					<input type="hidden" name="idprof" value="'.$idprof.'">
		            <div class="text-center">
		              <button type="submit" name="reg-insc" id="regModal-insc" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px">Guardar</button>
		            </div>
		          </form>
			</div>';
    } else {
    	$nombre = 'Información no disponible';
	    $formulario = "<div class='alert alert-danger'>Lo sentimos, actualmente la información no está disponible intente más tarde nuevamente.</div>";
	}

	$final[0] = $formulario;
	$final[1] = $nombre;

	return json_encode($final);
}

function modificarProfesor($doc, $estado, $nombre, $apellido, $correo, $telef1, $telef2, $usuario, $idprof){#Modifica los datos de profesores en la BD
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "UPDATE usuarios SET documentacion='".$doc."', estado='".$estado."', nombre='".$nombre."', apellido='".$apellido."', correo='".$correo."', telef1='".$telef1."', telef2='".$telef2."' WHERE id=".$idprof."";

	$result = "";
	if (mysqli_query($dbh, $sql)) {
		header('Location: ../admin/index.php?updprof=success');
		die();
		$result = 1;
	} else {
		header('Location: ../admin/index.php?updprof=fail');
		die();
		$result = 0;
	}
	return $result;
}

function addProf(){
	$formulario = '<div class="p-20">
					<form action="/api.php" method="POST" class="reservation-form">
		            <div class="row">
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Doc. Identificación</label>
		                  <input type="text" name="id" required="" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Nombre</label>
		                  <input type="text" name="nombre" required="" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Apellido</label>
		                  <input type="text" name="apellido" required="" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Correo Electrónico</label>
		                  <input type="email" name="correo" class="form-control" required="">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Contraseña</label>
		                  <input type="password" name="pass1" class="form-control" required="">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Repetir Contraseña</label>
		                  <input type="password" name="pass2" class="form-control" required="">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Teléfono 1</label>
		                  <input type="text" name="telef1" class="form-control" required="">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Teléfono 2</label>
		                  <input type="text" name="telef2" class="form-control">
		                </div>
		              </div>
		            </div>
		            <input type="hidden" name="tipo" value="agregarProf">
		            <div class="text-center">
		              <button type="submit" name="reg-insc" id="regModal-insc" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px">Guardar</button>
		            </div>
		          </form>
			</div>';

	return $formulario;
}

function addProfesor($doc, $nombre, $apellido, $correo, $pass1, $pass2, $telef1, $telef2){
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
		die('Error en Conexión: ' . mysqli_error($dbh));
		exit;
	}

	if ($pass1 == $pass2) {
		$sql = "INSERT INTO usuarios (documentacion, nombre, apellido, telef1, telef2, correo, password, permisos, estado) VALUES ('".$doc."', '".$nombre."', '".$apellido."', '".$telef1."', '".$telef2."', '".$correo."', '".$pass1."', 10, 1)";

		$result = "";
		if (mysqli_query($dbh, $sql)) {
			header('Location: ../admin/index.php?addprof=success');
			die();
			$result = 1;
		} else {
			header('Location: ../admin/index.php?addprof=fail');
			die();
			$result = 0;
		}
	} else {
		header('Location: ../admin/index.php?addprof=verify');
		die();
	}

	return $result;
}

function formCT($iduser){
	$formulario = '<div class="p-20">
	<form action="/api.php" method="POST" enctype="multipart/form-data">
		<div class="row">
		  <div class="col-sm-6">
			<div class="form-group mb-10">
			  <div class="styled-select">
				<label>Seleccione el tipo</label>
				<select name="tipoct" class="form-control" required="">
				  <option value="">- Seleccione una opción -</option>
				  <option value="1">Curso</option>
				  <option value="2">Taller</option>
				</select>
			  </div>
			</div>
		  </div>
		  <div class="col-sm-6">
			<div class="form-group mb-10">
			  <label>Nombre del curso o taller</label>
			  <input placeholder="Nombre del curso o taller" type="text" name="nombrect" required="" class="form-control">
			</div>
		  </div>
		  <div class="col-sm-12">
		    <div class="form-group mb-10">
			  <label>Descripción</label>
			  <textarea name="descripcion" class="form-control" rows="4" placeholder="Ingresa una breve descripción del curso o taller..."></textarea>
		    </div>
		  </div>
		  <div class="col-sm-12">
		    <div class="form-group mb-10">
			  <label>Lista de Materiales</label>
			  <textarea name="materiales" class="form-control" rows="4" placeholder="Ingresa el listado de materiales requerido por el curso o taller..."></textarea>
		    </div>
		  </div>
		  <div class="col-sm-12">
		    <div class="form-group mb-10">
			  <label for="imagen">Imagen del curso o taller</label>
			  <input type="file" name="image" id="image" onchange="checkSize()" accept="image/*" required="">
			  <p class="help-block">La imagen no debe pesar más de <b>512 kb</b> y debe tener una resolución de <b>435 x 320px</b>.</p>
		    </div>
			</div>
			<div class="col-sm-6">
				<div class="form-group mb-10">
					<label>Cantidad de notas</label>
					<input type="number" min="1" max="5" onchange="changeCantNotas()"  name="cant_notas" id="cant_notas" class="form-control" required="" value=""/>
				</div>
				</div>
				<div class="col-sm-6">
				<div class="form-group mb-10">
					<div class="styled-select">
					<label>Tipo de evaluacion</label>
					<select name="tipo_eval" onchange="changeCantNotas()" id="tipo_eval" class="form-control" required="">
						<option value="">- Seleccione una opción -</option>
						<option value="1">Porcentual</option>
						<option value="2">Promedial</option>
					</select>
					</div>
				</div>
				</div>
				<div id="porc_nota1" style="display: none;" class="col-sm-6">
				<div class="form-group mb-10">
					<label>Porcentaje nota 1</label>
					<input type="number" name="porc_nota1" class="form-control" value=""/>
				</div>
				</div>
				<div id="porc_nota2" style="display: none;" class="col-sm-6">
				<div class="form-group mb-10">
					<label>Porcentaje nota 2</label>
					<input type="number" name="porc_nota2" class="form-control" value=""/>
				</div>
				</div>
				<div id="porc_nota3" style="display: none;" class="col-sm-6">
				<div class="form-group mb-10">
					<label>Porcentaje nota 3</label>
					<input type="number" name="porc_nota3" class="form-control" value=""/>
				</div>
				</div>
				<div id="porc_nota4" style="display: none;" class="col-sm-6">
				<div class="form-group mb-10">
					<label>Porcentaje nota 4</label>
					<input type="number" name="porc_nota4" class="form-control" value=""/>
				</div>
				</div>
				<div id="porc_nota5" style="display: none;" class="col-sm-6">
				<div class="form-group mb-10">
					<label>Porcentaje nota 5</label>
					<input type="number" name="porc_nota5" class="form-control" value=""/>
				</div>
				</div>
	    </div>
		<input type="hidden" name="tipo" value="guardarCT">
		<input type="hidden" name="usuario" value="'.$iduser.'">
		<center class="mt-20">
		<button type="submit" name="savect" id="savect" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px">Guardar</button>
		</center>
	  </form>
	</div>';

	return $formulario;
}

function formImagen($usuario, $idct){
	$galeria = showImages();
	$formulario = '<div class="p-20"><ul class="list-group"><li class="list-group-item disabled"><b>Galería de Imágenes</b></li><li class="list-group-item">'.$galeria.'</li></ul><form action="/api.php" method="POST" enctype="multipart/form-data"><div class="row"><div class="col-sm-12"><div class="form-group mb-10"><label for="imagen">Cargar nueva imagen</label><input type="file" name="image" id="image" onchange="checkSize()" accept="image/*" required=""><p class="help-block">La imagen no debe pesar más de <b>512 kb</b> y debe tener una resolución de <b>435 x 320px</b>.</p></div></div></div><input type="hidden" name="tipo" value="updateImage"><input type="hidden" name="usuario" id="user" value="'.$usuario.'"><input type="hidden" name="idct" id="idct" value="'.$idct.'"><center class="mt-20"><button type="submit" name="savect" id="savect" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px mt-0">Guardar</button></center></form></div>';

	return $formulario;
}

function showImages(){
	$dirname = "componentes/images/cursos/";
	chdir($dirname);
	$images = glob("*.{png,jpeg,jpg,gif}", GLOB_BRACE);

	$i = 0;
	$galeria = "";
	foreach($images as $image) {
		$i++;
	    $galeria .= '<a onclick="selImagen(\''.base64_encode($image).'\')" style="cursor: pointer; display: -webkit-inline-box;" class="galeria-img"><img style="width: 130px;" src="../'.$dirname.$image.'" /></a>';
	}

	return $galeria;
}

function changeImage($usuario, $idct, $img){
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "UPDATE cursos SET imagen='".base64_decode($img)."' WHERE id=".$idct."";

	$result = "";
	if (mysqli_query($dbh, $sql)) {
		$result = '<div class="mt-30 mb-30"><div class="alert alert-success"><strong>¡Imagen actualizada!</strong> se actualizó a la imagen seleccionada exitosamente.</div></div>';
	} else {
		$result = '<div class="alert alert-danger"><strong>¡Error!</strong> no se actualizó la imagen.</div>';
	}

	return $result;
}

function formGuia($usuario, $idcurso){
	$archivos = showArchivos($idcurso);
	$formulario = '<div class="p-20">
		<ul class="list-group">
		<a class="list-group-item disabled">
		<b>Listado de archivos cargados</b>
		</a>'.$archivos.'
		</ul>
		<form action="/api.php" method="POST" enctype="multipart/form-data">
		<div class="row">
		<div class="col-sm-12">
		<div class="form-group mb-10">
		<label for="imagen">Imagen del curso o taller</label>
		<input type="file" name="guia" id="guia" required="">
		<p class="help-block">Seleccione una guia para subir.</p>
		</div>
	  </div>
		</div>
		<input type="hidden" name="tipo" value="updateGuia">
		<input type="hidden" name="usuario" id="usuario" value="'.$usuario.'">
		<input type="hidden" name="idct" id="idct" value="'.$idcurso.'">
		<center class="mt-20">
		<button type="submit" name="savect" id="savect" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px mt-0">Guardar</button>
		</center>
		</form>
		</div>';

	return $formulario;
}

function showArchivos($idcurso){
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "SELECT * FROM guias WHERE id_curso = $idcurso";

	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	$lista = "";
	if ($match > 0) {
		$dirname = "componentes/cursos/";
		chdir($dirname);
		$archivos = glob("*.{pdf,doc,docx,txt}", GLOB_BRACE);
		while ($rw = mysqli_fetch_array($search)) {
			$lista .= '<li class="list-group-item"><a href="/'.$dirname.$rw["nombre"].'" download><i class="glyphicon glyphicon-download-alt" style="cursor: pointer;"></i></a> <span onclick="deleteFile('.$rw["id"].')" class="badge" style="cursor: pointer;"><i class="glyphicon glyphicon-trash"></i></span>'.$rw["nombre"].'</li>';
		}
	} else {
	}
	return $lista;
}

function changeArchivo($usuario, $idct, $arch){
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "UPDATE cursos SET guia='".base64_decode($arch)."' WHERE id=".$idct."";

	$result = "";
	if (mysqli_query($dbh, $sql)) {
		$result = '<div class="mt-30 mb-30"><div class="alert alert-success"><strong>¡Instructivo actualizado!</strong> se actualizó la guía seleccionada exitosamente.</div></div>';
	} else {
		$result = '<div class="alert alert-danger"><strong>¡Error!</strong> no se actualizó la guía.</div>';
	}

	return $result;
}

function deleteFile($id) {
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "DELETE FROM guias  WHERE id = $id";

	mysqli_autocommit($dbh, FALSE);

	$result = "";
	$fileDeleted = findFileAndDelete($id);
	if (mysqli_query($dbh, $sql)) {
		if ($fileDeleted) {
			mysqli_commit($dbh);
			$result = '<div class="mt-30 mb-30"><div class="alert alert-success"><strong>¡Eliminado exitosamente!</strong> se eliminó la guía seleccionada exitosamente.</div></div>';
		}
	} else {
		mysqli_rollback($dbh);
		$result = '<div class="alert alert-danger"><strong>¡Error!</strong> no se eliminó la guía. </div>';
	}

	mysqli_close($dbh);
	return $result;
}

function findFileAndDelete($id) {
	if (isset($id)) {
		$dbh = dbconnlocal2();
		mysqli_set_charset($dbh, 'utf8');

		if (!$dbh) {
			die('Error en Conexión: ' . mysqli_error($dbh));
			exit;
		}

		$sql = "SELECT * FROM guias WHERE id = $id";
		$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
		$match = mysqli_num_rows($search);
		if ($match > 0) {
			$rw = mysqli_fetch_array($search);
			$target_dir = "componentes/cursos/";
			if (file_exists($target_dir)) {
				$target_file = $target_dir . basename($rw["nombre"]);
				if (file_exists($target_file)) {
					if (unlink($target_file)) {
						return true;
					} else {
						return false;
					}
				} else {
					return true;
				}
			} else {
				return true;
			}
		} else {
			return false;
		}
  } else {
		return false;
	}
}

function verInscritos(){
	include 'estudios.php';
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT i.*, e.*, h.*, c.id AS idcurso, c.nombre AS ncurso, c.tipo FROM inscripcion i INNER JOIN horarios h ON i.idhorario=h.id_horario INNER JOIN estudiantes e ON i.idestudiante=e.id INNER JOIN cursos c ON h.cursoid=c.id";

	$resultado = "";
	$tabla = "";
	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		while ($rw = mysqli_fetch_array($search)) {
			$saldo = number_format(consultarSaldoCT($rw['inscripcion_id']),2,",",".");
			list($n1) = explode(" ", $rw['nombre']);
			list($a1) = explode(" ", $rw['apellido']);
			$nombre = $n1 ." ". $a1;
			if ($rw['status'] == 0) {
				$deuda = '<b style="color: #e32028;">Pago pendiente</b>';
			} elseif ($rw['status'] == 1) {
				$deuda = '<b style="color: #e32028;">Cuota 2 pendiente</b>';
			} elseif ($rw['status'] == 2) {
				$deuda = '<b style="color: green;">Pagado</b>';
			}
			if ($rw['inscripcion'] == 0) {
				$insc = 'No Inscrito';
			} elseif ($rw['inscripcion'] == 1) {
				$insc = 'Inscrito';
			} elseif ($rw['inscripcion'] == 2) {
				$insc = 'Cancelado';
			}
			if ($saldo == 0) {
				$botonPagar = null;
			} else {
				$botonPagar = '<a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="addPagoM" data-id="'.$rw['inscripcion_id'].'" href="#"><i class="fa fa-credit-card icon-edit"></i></a>';
			}
			$resultado .= '<tr>
                    		<td>'.$rw['tipo_doc'].'-'.$rw['documentacion'].'</td>
                    		<td>'.$nombre.'</td>
                    		<td>'.$rw['ncurso'].'</td>
                    		<td>'.$insc.'</td>
                    		<td class="text-right">
													' . $botonPagar . '
                    			<a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="verInfoIns" data-id="'.$rw['inscripcion_id'].'" href="#"><i class="fa fa-search icon-view"></i></a>
													<a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="modInsc" data-id="'.$rw['inscripcion_id'].'" href="#"><i class="fa fa-edit icon-edit"></i></a>
                    		</td>
                    	</tr>';
	    }
		$tabla = '<div data-example-id="simple-responsive-table" class="bs-example p-20">
					<div class="mb-20">
						<button onclick="showContent(51)" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Agregar Inscripción</button>
					</div>
		              <div class="table-responsive">
		                <table id="inscripciones" class="table table-striped table-hover">
		                  <thead>
		                    <tr>
		                      <th>ID</th>
		                      <th>Nombre</th>
		                      <th>Curso - Taller</th>
		                      <th>Estado</th>
		                      <th></th>
		                    </tr>
		                  </thead>
		                  <tbody>
		                  '. $resultado .'
		                  </tbody>
		                </table>
		              </div>
		            </div>';
	} else {
	    $tabla = "<div class='alert alert-danger'>Lo sentimos, actualmente no hay estudiantes inscritos en el curso o taller seleccionado.</div>";
	}

	return $tabla;
}

function verInfoInscripciones($inscripcionid){
	include 'estudios.php';
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT i.*, e.*, h.*, c.id AS idcurso, c.nombre AS ncurso, c.tipo FROM inscripcion i INNER JOIN horarios h ON i.idhorario=h.id_horario INNER JOIN estudiantes e ON i.idestudiante=e.id INNER JOIN cursos c ON h.cursoid=c.id WHERE i.inscripcion_id=".$inscripcionid."";

	$final = array();
	$resultado= "";
	$nombre= "";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    $rw = mysqli_fetch_array($search);
	    list($n1) = explode(" ", $rw['nombre']);
  		list($a1) = explode(" ", $rw['apellido']);
	    $user = $n1 ." ". $a1;
	    $nombre = "".$rw['ncurso'].": ".$user;
	    if ($rw['opcionpago'] == 1) {
	   		$tpago = 'De Contado';
	   		$precio = $rw['precio1'];
	    } elseif ($rw['opcionpago'] == 2) {
	   		$tpago = 'Dos Cuotas';
	   		$precio = $rw['precio2'];
	   	} else {
	   		$tpago = 'N/D';
	   		$precio = 'N/D';
	    }
	    if ($rw['inscripcion'] == 0) {
	    	$insc = 'No Inscrito';
	    } elseif ($rw['inscripcion'] == 1) {
	   		$insc = 'Inscrito';
	   	} elseif ($rw['inscripcion'] == 2) {
	   		$insc = 'Cancelado';
	   	}
	   	if ($rw['tipo'] == 1) {
	   		$tipo = 'Curso';
	   	} elseif ($rw['tipo'] == 21) {
	   		$tipo = 'Taller';
	   	} else {
	   		$tipo = 'N/D';
	   	}
	   	$tablapagos = consultarPagosInsc($inscripcionid);
		$resultado = '<div class="row mb-5">
						<div class="col-md-12">
					      <div class="col-md-6"><b>Documento:</b> '.$rw['tipo_doc'].'-'.$rw['documentacion'].'</div>
					      <div class="col-md-6"><b>Nombre:</b> '.$user.'</div>
					    </div>
					</div>
					<div class="row mb-5">
						<div class="col-md-12">
					      <div class="col-md-12"><b>Telefonos:</b> '.$rw['telef1'].' - '.$rw['telef2'].' - '.$rw['telef3'].'</div>
					    </div>
					</div>
					<div class="row mb-5">
						<div class="col-md-12">
					      <div class="col-md-12"><b>Correo Electrónico:</b> '.$rw['correo'].'</div>
					    </div>
					</div>
					<div class="row mb-5">
						<div class="col-md-12">
				          <div class="col-md-6"><b>'.$tipo.':</b> '.$rw['ncurso'].'</div>
					      <div class="col-md-6"><b>Fecha de Inscripción:</b> '.date_format(date_create($rw['fecha_insc']), 'd-m-Y').' </div>
				 	    </div>
					</div>
					<div class="row mb-5">
						<div class="col-md-12">
					      <div class="col-md-6"><b>Inicio:</b> '.date_format(date_create($rw['fechainicio']), 'd-m-Y').' </div>
					      <div class="col-md-6"><b>Final:</b> '.date_format(date_create($rw['fechafin']), 'd-m-Y').' </div>
				 	    </div>
					</div>
					<div class="row mb-5">
						<div class="col-md-12">
					      <div class="col-md-6"><b>Precio:</b> '.number_format($precio,2,",",".").' </div>
					      <div class="col-md-6"><b>Deuda:</b> '.number_format(consultarSaldoCT($rw['inscripcion_id']),2,",",".").' </div>
				 	    </div>
					</div>
					<div class="row mb-5">
					  <div class="col-md-12">
			   	        <div class="col-md-6"><b>Opción de Pago:</b> '.$tpago.' </div>
					    <div class="col-md-6"><b>Estado:</b> '.$insc.' </div>
					  </div>
					</div>
					<div class="row mb-5">
					  <div class="col-md-12">
			   	        <div class="col-md-12"><b>Pagos:</b> </div>
			   	        <div class="col-md-12 mt-10">'.$tablapagos.' </div>
					  </div>
					</div>';
	} else {
    	$nombre = 'Información no disponible';
	    $resultado = "<div class='alert alert-danger'>Lo sentimos, actualmente la información no está disponible intente más tarde nuevamente.</div>";
	}

	$final[0] = $resultado;
	$final[1] = $nombre;

	return json_encode($final);
}

function showPago($idpago) {
	include 'estudios.php';
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
		die('Error en Conexión: ' . mysqli_error($dbh));
		exit;
	}

	$sql = "SELECT p.*, i.*, e.*, h.*, c.id AS idcurso, c.nombre AS ncurso, c.tipo FROM pagos p
		INNER JOIN inscripcion i ON p.idinscripcion = i.inscripcion_id
		INNER JOIN estudiantes e ON i.idestudiante = e.id
		INNER JOIN horarios h ON i.idhorario = h.id_horario
		INNER JOIN cursos c ON h.cursoid = c.id
		WHERE p.id_pagos = $idpago";

	$final = array();
	$resultado = "";
	$nombre = "";
	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		$rw = mysqli_fetch_array($search);
		$nombrecurso = consultarNombreCTI($rw['inscripcion_id']);
		$titulo = 'Pago: ' . $rw['referencia'];
		$fecha = date_format(date_create($rw['fecha']), 'd-m-Y');
		list($n1) = explode(" ", $rw['nombre']);
		list($a1) = explode(" ", $rw['apellido']);
		$user = $n1 ." ". $a1;
		$nombre = "".$rw['ncurso'].": ".$user;
		if ($rw['opcionpago'] == 1) {
			$tpago = 'De Contado';
			$precio = $rw['precio1'];
	 	} elseif ($rw['opcionpago'] == 2) {
			$tpago = 'Dos Cuotas';
			$precio = $rw['precio2'];
		} else {
			$tpago = 'N/D';
			$precio = 'N/D';
	 	}
		$resultado = '<div class="row mb-5">
							<div class="col-md-12">
								<div class="col-md-6"><b>Nombre:</b> '.$user.'</div>
								<div class="col-md-6"><b>Documento:</b> '.$rw['tipo_doc'].'-'.$rw['documentacion'].'</div>
							</div>
							<div class="col-md-12">
									<div class="col-md-6"><b>Fecha:</b> '.$fecha.'</div>
									<div class="col-md-6"><b>Hora:</b> '.$rw['hora'].'</div>
							</div>
					</div>
					<div class="row mb-5">
							<div class="col-md-12">
									<div class="col-md-6"><b>Curso:</b> '.$nombrecurso.'</div>
									<div class="col-md-6"><b>Respuesta:</b> '.$rw['mensaje'].'</div>
							</div>
					</div>
					<div class="row mb-5">
						<div class="col-md-12">
					      <div class="col-md-6"><b>Monto:</b> '.number_format($rw['total']).' </div>
					      <div class="col-md-6"><b>Deuda:</b> '.number_format(consultarSaldoCT($rw['inscripcion_id']),2,",",".").' </div>
				 	    </div>
					</div>
					<div class="row mb-5">
					  <div class="col-md-12">
							<div class="col-md-6"><b>Opción de Pago:</b> '.$tpago.' </div>
							<div class="col-md-6"><b>Banco:</b> '.$rw['banco'].' </div>
					  </div>
					</div>
					<center><div class="row mt-20">
						<div class="col-md-12">
								<div class="col-md-12">'.$rw['voucher'].'</div>
						</div>
					</div></center>';
		} else {
			$nombrecurso = "Información no disponible";
			$resultado = "<div class='alert alert-danger'>Lo sentimos, actualmente la información no se encuentra disponible intenta nuevamente.</div>";
		}
	$final[0] = $resultado;
	$final[1] = $titulo;
	return json_encode($final);
}

function consultarPagosInsc($idinscripcion){
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT * FROM pagos WHERE idinscripcion=".$idinscripcion."";

	$result = "";
	$tabla = "";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		while ($rw = mysqli_fetch_array($search)) {
			$result .= '<tr><td>'.date_format(date_create($rw['fecha']), 'd-m-Y').'</td>
		    			<td>'.$rw['referencia'].'</td>
		    			<td>'.number_format($rw['total'],2,",",".").'
		    			<td>'.$rw['mensaje'].'</td></tr>';
		}
		$tabla = '<table class="table table-striped table-bordered table-hover">
				  <tr>
					<th>Fecha</th>
					<th>Referencia</th>
					<th>Monto</th>
					<th>Mensaje</th>
				  </tr>
				  '.$result.'
			    </table>';
	} else {
		$tabla = '<div class="alert alert-danger"><strong>La inscripción seleccionada no posee pagos registrados aún.</strong></div>';
	}

	return $tabla;
}

function modInscripcion($idinscripcion){
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT i.*, e.*, h.*, c.id AS idcurso, c.nombre AS ncurso, c.tipo FROM inscripcion i INNER JOIN horarios h ON i.idhorario=h.id_horario INNER JOIN estudiantes e ON i.idestudiante=e.id INNER JOIN cursos c ON h.cursoid=c.id WHERE inscripcion_id=".$idinscripcion."";

	$final = array();
	$resultado= "";
	$nombre= "";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    $rw = mysqli_fetch_array($search);
	    list($n1) = explode(" ", $rw['nombre']);
  		list($a1) = explode(" ", $rw['apellido']);
	    $user = $n1 ." ". $a1;
	    if ($rw['opcionpago'] == 1) {
	   		$tpago = 'De Contado';
	   		$precio = $rw['precio1'];
	    } elseif ($rw['opcionpago'] == 2) {
	   		$tpago = 'Dos Cuotas';
	   		$precio = $rw['precio2'];
	   	} else {
	   		$tpago = 'N/D';
	   		$precio = 'N/D';
	    }
	    if ($rw['opcionpago'] == 1) {
	    	$opcpago = '<option value="">- Seleccione una opción -</option>
		                <option value="1" selected>De contado</option>
		                <option value="2">Dos cuotas</option>';
	    } elseif ($rw['opcionpago'] == 2) {
	    	$opcpago = '<option value="">- Seleccione una opción -</option>
		                <option value="1">De contado</option>
		                <option value="2" selected>Dos cuotas</option>';
	    } else {
	    	$opcpago = '<option value="">- Seleccione una opción -</option>
		                <option value="1">De contado</option>
		                <option value="2">Dos cuotas</option>';
	    }
	    $selectCT = selectHorarios($rw['idhorario']);
	    $nombre = 'Modificar: '. $rw['ncurso'] .' - '. $user;
		$resultado = '<div class="p-20">
					<form action="/api.php" method="POST" class="reservation-form">
		            <div class="row">
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Documento</label>
		                  <input type="text" name="id" value="'.$rw['tipo_doc'].'-'.$rw['documentacion'].'" disabled="" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Nombre</label>
		                  <input type="text" name="nombre" value="'.$rw['nombre'].' '.$rw['apellido'].'" disabled="" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-12">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Telefonos</label>
		                  <input type="text" name="apellido" value="'.$rw['telef1'].' - '.$rw['telef2'].' - '.$rw['telef3'].'" disabled="" class="form-control">
		                </div>
		              </div>
		              <div class="col-sm-12">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Correo Electrónico</label>
		                  <input type="email" name="correo" value="'.$rw['correo'].'" class="form-control" disabled="">
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Curso - Taller</label>
		                  '.$selectCT.'
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Opción de Pago</label>
		                  <select name="opcionp" class="form-control" required="">
		                  	'.$opcpago.'
		                  </select>
		                </div>
		              </div>
		            </div>
		            <input type="hidden" name="tipo" value="modificarInsc">
		            <input type="hidden" name="idinsc" value="'.$idinscripcion.'">
		            <div class="text-center">
		              <button type="submit" name="reg-insc" id="regModal-insc" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px mt-20">Guardar</button>
		            </div>
		          </form>
			</div>';
	} else {
    	$nombre = 'Información no disponible';
	    $resultado = "<div class='alert alert-danger'>Lo sentimos, actualmente la información no está disponible intente más tarde nuevamente.</div>";
	}

	$final[0] = $resultado;
	$final[1] = $nombre;

	return json_encode($final);
}

function selectHorarios($idhorario){// Muestra el select con las opciones de los cursos 0: nuevo else modificar
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "SELECT c.*, h.*, u.nombre AS location FROM horarios h INNER JOIN cursos c ON h.cursoid=c.id INNER JOIN ubicacion u ON h.ubicacionid=u.id WHERE c.estado=0 AND h.fechafin>CURDATE() AND h.capacidad>h.inscritos";

	$select = "";
	$resultado= "";
	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		while ($rw = mysqli_fetch_array($search)) {
			if ($rw['tipo'] == 1) {
		  		$tipo = 'Curso';
		  	} elseif ($rw['tipo'] == 2) {
		  		$tipo = 'Taller';
		  	}
		  	$opcion = $tipo .": ".$rw['nombre'] ." - ". $rw['location'];
		  	if ($idhorario == $rw['id_horario']) {
		  		$selected = 'selected';
		  	} else {
		  		$selected = '';
		  	}
			$resultado .= '<option value="'.$rw['id_horario'].'" '.$selected.'>'.$opcion.'</option>';
		}
		$select = "<select class='form-control' name='horarios' required='' ><option value=''>- Seleccione una opción -</option>".$resultado."</select>";
	} else {
		$select = "<select class='form-control' name='horarios' required='' ><option value=''>- Seleccione una opción -</option></select>";
	}
	return $select;
}

function updateInscripcion($idinsc, $opcion, $idhorario){
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "UPDATE inscripcion SET opcionpago='".$opcion."', idhorario='".$idhorario."' WHERE inscripcion_id=".$idinsc."";

	$result = "";
	if (mysqli_query($dbh, $sql)) {
		header('Location: ../admin/index.php?i=success');
		die();
		$result = 1;
	} else {
		header('Location: ../admin/index.php?i=fail');
		die();
		$result = 0;
	}
	return $result;
}

function registrarPagoManual($idinscripcion, $usuario){
	include_once 'estudios.php';
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT i.*, e.*, h.*, c.id AS idcurso, c.nombre AS ncurso, c.tipo FROM inscripcion i INNER JOIN horarios h ON i.idhorario=h.id_horario INNER JOIN estudiantes e ON i.idestudiante=e.id INNER JOIN cursos c ON h.cursoid=c.id WHERE inscripcion_id=".$idinscripcion."";

	$final = array();
	$resultado= "";
	$nombre= "";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    $rw = mysqli_fetch_array($search);
	    list($n1) = explode(" ", $rw['nombre']);
  		list($a1) = explode(" ", $rw['apellido']);
	    $user = $n1 ." ". $a1;
	    if ($rw['opcionpago'] == 1) {
	   		$tpago = 'De Contado';
	   		$precio = $rw['precio1'];
	    } elseif ($rw['opcionpago'] == 2) {
	   		$tpago = 'Dos Cuotas';
	   		$precio = $rw['precio2'];
	   	} else {
	   		$tpago = 'N/D';
	   		$precio = 'N/D';
	    }
	    $nombre = 'Pagar: '. $rw['ncurso'] .' - '. $user;
		$resultado = '<div class="p-20">
					<form action="/api.php" method="POST" class="reservation-form">
		            <div class="row">
		              <div class="col-sm-6">
		                <div class="form-group mb-5">
		                  <label class="mb-0">Documento</label>
		                  <div>'.$rw['tipo_doc'].'-'.$rw['documentacion'].'</div>
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-5">
		                  <label class="mb-0">Nombre</label>
		                  <div>'.$user.'</div>
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-5">
		                  <label class="mb-0">Curso - Taller</label>
		                  <div>'.$rw['ncurso'].'</div>
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-5">
		                  <label class="mb-0">Fecha de Inicio</label>
		                  <div>'.date_format(date_create($rw['fechainicio']), 'd-m-Y').'</div>
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-5">
		                  <label class="mb-0">Precio</label>
		                  <div>'.number_format($precio,2,",",".").'</div>
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-10">
		                  <label class="mb-0">Deuda total</label>
		                  <div>'.number_format(consultarSaldoCT($rw['inscripcion_id']),2,",",".").'</div>
		                </div>
		              </div>
		              <div class="col-sm-12">
		                <div class="form-group mb-5 text-center">
		                  <label class="mb-12">Registrar Pago</label>
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-5">
		                  <label class="mb-0">Forma de Pago</label>
		                  <select class="form-control" name="metodo" required="" >
		                  	<option value="">Seleccione una opción</option>
		                  	<option value="1">Instapago</option>
		                  	<option value="2">Punto de Venta</option>
		                  	<option value="3">Transferencia</option>
		                  	<option value="4">Depósito</option>
		                  	<option value="5">Efectivo</option>
		                  	<option value="6">Cheque</option>
		                  	<option value="7">Otro</option>
		                  </select>
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-5">
		                  <label class="mb-0">Banco</label>
		                  <input type="text" name="banco" class="form-control" required="" />
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-5">
		                  <label class="mb-0">Monto</label>
		                  <input type="text" name="monto" class="form-control" required="" />
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-5">
		                  <label class="mb-0">Referencia</label>
		                  <input type="text" name="ref" class="form-control" required="" />
		                </div>
		              </div>
		            </div>
		            <input type="hidden" name="tipo" value="agregarPagoManual">
		            <input type="hidden" name="idinsc" value="'.$idinscripcion.'">
		            <input type="hidden" name="user" value="'.$usuario.'">
		            <div class="text-center">
		              <button type="submit" name="reg-insc" id="regModal-insc" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px mt-20">Guardar</button>
		            </div>
		          </form>
			</div>';
	} else {
    	$nombre = 'Información no disponible';
	    $resultado = "<div class='alert alert-danger'>Lo sentimos, actualmente la información no está disponible intente más tarde nuevamente.</div>";
	}

	$final[0] = $resultado;
	$final[1] = $nombre;

	return json_encode($final);
}

function selectEstudiante(){// Muestra el select con las opciones de los profesores
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	  die('Error en Conexión: ' . mysqli_error($dbh));
	  exit;
	}

	$sql = "SELECT * FROM estudiantes WHERE estado IN (0, 1)";

	$select = "";
	$resultado= "";
	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		while ($rw = mysqli_fetch_array($search)) {
		  	$estudiante = $rw['tipo_doc']."-".$rw['documentacion'].": ". $rw['nombre'] ." ". $rw['apellido'];
		  	$idest = $rw['id'];
			$resultado .= '<option value="'.$idest.'">'.$estudiante.'</option>';
		}
		$select = "<select class='form-control' name='user' required='' ><option value=''>- Seleccione el Estudiante -</option>".$resultado."</select>";
	} else {
		$select = "<select class='form-control' name='user' required='' ><option value=''>- Seleccione el Estudiante -</option></select>";
	}
	return $select;
}

function formInscripcion(){
	$selectEst = selectEstudiante();
	$selectHor = selectHorarios(0);
	$formulario = '<div class="p-20">
					<h2 class="text-uppercase font-26 line-bottom mt-0 line-height-1 mb-20">Inscribir <span class="text-theme-colored">Estudiante</span></h2>
					<p>En esta sección puedes realizar la inscripción de los estudiantes.</p>
					<form action="/api.php" method="POST" class="reservation-form">
		            <div class="row">
		              <div class="col-sm-12">
		                <div class="form-group mb-5">
		                  <label class="mb-0">Curso - Taller</label>
		                  '.$selectHor.'
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-5">
		                  <label class="mb-0">Estudiante</label>
		                  '.$selectEst.'
		                </div>
		              </div>
		              <div class="col-sm-6">
		                <div class="form-group mb-5">
		                  <label class="mb-0">Opción de Pago</label>
		                  <select class="form-control" name="option" required="" >
		                  	<option value="">Seleccione una opción</option>
		                  	<option value="1">De contado</option>
		                  	<option value="2">Dos cuotas</option>
		                  </select>
		                </div>
		              </div>
		            </div>
		            <input type="hidden" name="tipo" value="deudaManual">
		            <div class="text-center">
		              <button type="submit" name="reg-insc" id="regModal-insc" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px mt-20">Guardar</button>
		            </div>
		          </form>
			</div>';

	return $formulario;
}

function verTodosLosPagos() {
	$dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT i.*, e.*, p.* FROM pagos p INNER JOIN inscripcion i ON p.idinscripcion=i.inscripcion_id INNER JOIN estudiantes e ON i.idestudiante = e.id";

	$resultado = "";
	$tabla = "";
  $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
	    while ($rw = mysqli_fetch_array($search)) {
	    	list($n1) = explode(" ", $rw['nombre']);
  			list($a1) = explode(" ", $rw['apellido']);
	    	$nombre = $n1 ." ". $a1;
				$resultado .= '<tr>
												<td>'.$rw['fecha'].'</td>
                    		<td>'.$rw['referencia'].'</td>
                    		<td>'.$rw['tipo_doc'].'-'.$rw['documentacion'].'</td>
                    		<td>'.$nombre.'</td>
                    		<td>'.$rw['mensaje'].'</td>
                    		<td class="text-right">
                    			<a type="button" data-toggle="modal" data-target="#modalInfo" data-tipo="verInfoPago" data-id="'.$rw['id_pagos'].'" href="#"><i class="fa fa-search icon-view"></i></a>
                    		</td>
                    	</tr>';
	    }
		$tabla = '<div data-example-id="simple-responsive-table" class="bs-example p-20">
		              <div class="table-responsive">
		                <table id="pagos" class="table table-striped table-hover">
		                  <thead>
												<tr>
													<th>Fecha</th>
		                      <th>Referencia</th>
		                      <th>Documento</th>
		                      <th>Nombre</th>
		                      <th>Mensaje</th>
		                      <th></th>
		                    </tr>
		                  </thead>
		                  <tbody>
		                  '. $resultado .'
		                  </tbody>
		                </table>
		              </div>
		            </div>';
	} else {
	    $tabla = "<div class='alert alert-danger'>Lo sentimos, actualmente no hay estudiantes inscritos en el curso o taller seleccionado.</div>";
	}

	return $tabla;
}

function depurarInscripciones() {
	include 'conexion.php';
	$dbh = dbconnlocal2();
	mysqli_set_charset($dbh, 'utf8');

	if (!$dbh) {
	    die('Error en Conexión: ' . mysqli_error($dbh));
	    exit;
	}

	$sql = "SELECT i.inscripcion_id FROM inscripcion i INNER JOIN horarios h ON h.id_horario = i.idhorario WHERE i.inscripcion = 0 AND h.fechainicio < CURDATE()";

	$search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	$match = mysqli_num_rows($search);
	if ($match > 0) {
		$result = [];
		$i = 0;
		while ($rw = mysqli_fetch_array($search)) {
			$result[$i] = $rw['inscripcion_id'];
			$i++;
		}
		$resultado = implode(',', $result);

		$sql = "UPDATE inscripcion SET inscripcion = 2 WHERE inscripcion_id IN (" . $resultado . ")";
		if (mysqli_query($dbh, $sql)) {
			return true;
		} else {
			return false;
		}
	} else {
		return true;
	}
}

?>