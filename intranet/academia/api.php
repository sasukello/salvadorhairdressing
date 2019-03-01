<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
error_log(1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["tipo"])) {
        $tipoct = $_POST["tipo"];
        switch ($tipoct) {
            case 'consultarct': // Consulta los cursos para el admin
                include "includes/conexion.php";
                include "includes/admin.php";

                echo cursos();

                break;
            case 'guardarCT': // Guarda los cursos o talleres nuevos
                include "includes/conexion.php";
                include "includes/admin.php";
                $curso = $_POST["nombrect"];
                $tipoct = $_POST["tipoct"];
                $user = $_POST["usuario"];
                $descripcion = $_POST["descripcion"];
                $materiales = $_POST["materiales"];
                $imagen = $_FILES["image"];
                $cant_notas = $_POST["cant_notas"];
                $tipo_eval = $_POST["tipo_eval"];

                if ($tipo_eval == "0") {
                    if ($cant_notas >= "1") {
                        $porc_nota1 = $_POST["porc_nota1"];
                    } else {
                        $porc_nota1 = 'null';
                    }
                    if ($cant_notas >= "2") {
                        $porc_nota2 = $_POST["porc_nota2"];
                    } else {
                        $porc_nota2 = 'null';
                    }
                    if ($cant_notas >= "3") {
                        $porc_nota3 = $_POST["porc_nota3"];
                    } else {
                        $porc_nota3 = 'null';
                    }
                    if ($cant_notas >= "4") {
                        $porc_nota4 = $_POST["porc_nota4"];
                    } else {
                        $porc_nota4 = 'null';
                    }
                    if ($cant_notas == "5") {
                        $porc_nota5 = $_POST["porc_nota5"];
                    } else {
                        $porc_nota5 = 'null';
                    }
                } else {
                    $porc_nota1 = 'null';
                    $porc_nota2 = 'null';
                    $porc_nota3 = 'null';
                    $porc_nota4 = 'null';
                    $porc_nota5 = 'null';
                }

                echo guardarCT($curso, $tipoct, $descripcion, $imagen, $user, $materiales, $cant_notas, $tipo_eval, $porc_nota1, $porc_nota3, $porc_nota2, $porc_nota4, $porc_nota5);
                break;
            case 'consultarhr': // Consulta los horarios en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";

                echo horarios();
                break;
            case 'consultarhrActivos': // Consulta los horarios en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";

                echo horariosActivos();
                break;
            case 'formhorario': // Muestra el formulario para guardar horario en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";
                $user = $_POST["user"];

                echo formHorarios($user);

                break;

            case 'guardarHR': // Guardar horario en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";
                $fechainicio = $_POST["inicio"];
                $fechafin = $_POST["final"];
                $turno = $_POST["turno"];
                $horario = $_POST["horario"];
                $cursoid = $_POST["cursos"];
                $ubicacionid = $_POST["ubicacion"];
                $idprofesor = $_POST["profesor"];
                $precio1 = $_POST["precio1"];
                $precio2 = $_POST["precio2"];
                $capacidad = $_POST["capacidad"];
                $usuario = $_POST["usuario"];

                echo guardarHorario($fechainicio, $fechafin, $turno, $horario, $cursoid, $ubicacionid, $idprofesor, $precio1, $precio2, $capacidad, $usuario);

                break;
            case 'verCT': // Muestra la informacion del curso o taller en el modal
                include "includes/conexion.php";
                include "includes/admin.php";
                $idCT = $_POST["id"];

                echo verInfoCT($idCT);

                break;

            case 'modCT': // Muestra el formulario de modificar el curso o taller en el modal
                include "includes/conexion.php";
                include "includes/admin.php";
                $idCT = $_POST["id"];
                $user = $_POST["user"];

                echo modificarInfoCT($idCT, $user);
                break;
            case 'detCT': // Muestra el formulario de modificar el curso o taller en el modal
                include "includes/conexion.php";
                include "includes/admin.php";
                $idCT = $_POST["id"];

                echo eliminarCT($idCT);
                break;
            case 'formCT':
                include "includes/conexion.php";
                include "includes/admin.php";
                $usuario = $_POST['user'];

                echo formCT($usuario);
                break;
            case 'modificarCT': // Actualiza los datos modificados del curso o taller en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";
                $id = $_POST["idcurso"];
                $tipo = $_POST["tipoct"];
                $estado = $_POST["status"];
                $nombre = $_POST["nombrect"];
                $descripcion = $_POST["descripcion"];
                $usuario = $_POST["usuario"];
                $materiales = $_POST["materiales"];
                $cant_notas = $_POST["cant_notas"];
                $tipo_eval = $_POST["tipo_eval"];

                if ($tipo_eval == "1") {
                    if ($cant_notas >= "1") {
                        $porc_nota1 = $_POST["porc_nota1"];
                    } else {
                        $porc_nota1 = 'null';
                    }
                    if ($cant_notas >= "2") {
                        $porc_nota2 = $_POST["porc_nota2"];
                    } else {
                        $porc_nota2 = 'null';
                    }
                    if ($cant_notas >= "3") {
                        $porc_nota3 = $_POST["porc_nota3"];
                    } else {
                        $porc_nota3 = 'null';
                    }
                    if ($cant_notas >= "4") {
                        $porc_nota4 = $_POST["porc_nota4"];
                    } else {
                        $porc_nota4 = 'null';
                    }
                    if ($cant_notas == "5") {
                        $porc_nota5 = $_POST["porc_nota5"];
                    } else {
                        $porc_nota5 = 'null';
                    }
                } else {
                    $porc_nota1 = 'null';
                    $porc_nota2 = 'null';
                    $porc_nota3 = 'null';
                    $porc_nota4 = 'null';
                    $porc_nota5 = 'null';
                }

                echo updateCT($id, $tipo, $estado, $nombre, $descripcion, $usuario, $materiales, $cant_notas, $tipo_eval, $porc_nota1, $porc_nota3, $porc_nota2, $porc_nota4, $porc_nota5);
                break;
            case 'verH': // Actualiza los datos modificados del curso o taller en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";
                $id = $_POST["idh"];

                echo verInfoHorarios($id);

                break;

            case 'modH': // Actualiza los datos modificados del curso o taller en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";
                $id = $_POST["idh"];
                $usuario = $_POST["user"];

                echo modificarInfoHorarios($id, $usuario);

                break;

            case 'modificarHR': // Actualiza los datos modificados del curso o taller en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";
                $ubicacion = $_POST["ubicacion"];
                $profesor = $_POST["profesor"];
                $capacidad = $_POST["capacidad"];
                $inicio = $_POST["inicio"];
                $final = $_POST["final"];
                $precio1 = $_POST["precio1"];
                $precio2 = $_POST["precio2"];
                $turno = $_POST["turno"];
                $horario = $_POST["horario"];
                $usuario = $_POST["usuario"];
                $idhr = $_POST["idhr"];

                echo modificarHorarios($ubicacion, $profesor, $capacidad, $inicio, $final, $precio1, $precio2, $turno, $horario, $usuario, $idhr);

                break;

            case 'verIns': // Actualiza los datos modificados del curso o taller en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";
                $idh = $_POST["ide"];

                echo verInscritosHorario($idh);

                break;

            case 'consultarEst': // Actualiza los datos modificados del curso o taller en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";

                echo verEstudiantes();

                break;
            case 'consultarEstMorosos': // Actualiza los datos modificados del curso o taller en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";

                echo verEstudiantesMorosos();

                break;
            case 'verEst': // Muestra la informacion completa de estudiantes en el modal de administrador
                include "includes/conexion.php";
                include "includes/admin.php";
                $id = $_POST["ide"];

                echo verInfoEstudiantes($id);

                break;

            case 'modEst': // Muestra el formulario para actualizar datos de estudiante en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";
                $id = $_POST["ide"];
                $user = $_POST["user"];

                echo modificarDatosEstudiante($id, $user);

                break;

            case 'modificarEst': // Modifica la informacion del estudiante en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";
                $tipo = $_POST["tipodoc"];
                $doc = $_POST["id"];
                $nombre = $_POST["name"];
                $apellido = $_POST["lastname"];
                $civil = $_POST["civil"];
                $profesion = $_POST["profesion"];
                $ffnn = $_POST["ffnn"];
                $paises = $_POST["paises"];
                $sexo = $_POST["sexo"];
                $telf1 = $_POST["hphone"];
                $telf2 = $_POST["cphone1"];
                $telf3 = $_POST["cphone2"];
                $correo = $_POST["email"];
                $direccion = $_POST["address"];
                $user = $_POST["usuario"];
                $idest = $_POST["idest"];
                $estado = $_POST["estado"];

                echo modificarEstudiante($tipo, $doc, $nombre, $apellido, $civil, $profesion, $ffnn, $paises, $sexo, $telf1, $telf2, $telf3, $correo, $direccion, $user, $idest, $estado);

                break;

            case 'formEstudiante': // Agrega estudiantes en la seccion estudiante del administrador
                include "includes/conexion.php";
                include "includes/admin.php";

                echo formAddEstudiante();

                break;
            case 'verProf': // Muestra la tabla de profesores en el administrador
                include "includes/conexion.php";
                include "includes/admin.php";

                echo verProfesores();

                break;

            case 'verInfoProf': // Muestra la informacion del profesor en el modal
                include "includes/conexion.php";
                include "includes/admin.php";
                $id = $_POST["idp"];

                echo verInfoProf($id);

                break;

            case 'modInfoProf': // Muestra el formulario para modificar datos de estudiantes
                include "includes/conexion.php";
                include "includes/admin.php";
                $id = $_POST["idp"];
                $usuario = $_POST["user"];

                echo modInfoProf($id, $usuario);

                break;

            case 'modificarProfesor': #Modifica los datos de profesores en la BD
                include "includes/conexion.php";
                include "includes/admin.php";
                $doc = $_POST["id"];
                $estado = $_POST["estado"];
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $correo = $_POST["correo"];
                $telef1 = $_POST["telef1"];
                $telef2 = $_POST["telef2"];
                $usuario = $_POST["usuario"];
                $idprof = $_POST["idprof"];

                echo modificarProfesor($doc, $estado, $nombre, $apellido, $correo, $telef1, $telef2, $usuario, $idprof);

                break;

            case 'addProf': // Formulario para agregar profesor
                include "includes/conexion.php";
                include "includes/admin.php";

                echo addProf();

                break;

            case 'agregarProf': // Agrega un profesor a la base de datos
                include "includes/conexion.php";
                include "includes/admin.php";
                $doc = $_POST["id"];
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $correo = $_POST["correo"];
                $pass1 = $_POST["pass1"];
                $pass2 = $_POST["pass2"];
                $telef1 = $_POST["telef1"];
                $telef2 = $_POST["telef2"];

                echo addProfesor($doc, $nombre, $apellido, $correo, $pass1, $pass2, $telef1, $telef2);

                break;

            case 'updateImage': // Sube una nueva imagen a un curso
                include "includes/conexion.php";
                include "includes/admin.php";
                $iduser = $_POST["usuario"];
                $id = $_POST["idct"];

                if (filesize($_FILES["image"]["tmp_name"]) == "") {
                    $imagen = "empty";
                } else {
                    $imagen = $_FILES["image"];
                }

                echo updateImagen($iduser, $id, $imagen);

                break;

            case 'updateGuia': // Sube una nueva guia a un curso
                include "includes/conexion.php";
                include "includes/admin.php";
                $iduser = $_POST["usuario"];
                $id = $_POST["idct"];

                if (filesize($_FILES["guia"]["tmp_name"]) == "") {
                    $guia = "empty";
                } else {
                    $guia = $_FILES["guia"];
                }

                echo updateGuia($iduser, $id, $guia);

                break;
            case 'formImagen': // Muestra el formulario para cambiar la imagen de los cursos - talleres
                include "includes/conexion.php";
                include "includes/admin.php";
                $usuario = $_POST["user"];
                $idct = $_POST["idct"];

                echo formImagen($usuario, $idct);

                break;
            case 'formGuia': // Muestra el formulario para cambiar la guia de los cursos - talleres
                include "includes/conexion.php";
                include "includes/admin.php";
                $usuario = $_POST["user"];
                $idct = $_POST["idct"];

                echo formGuia($usuario, $idct);

                break;
            case 'chgImg': // Cambia las imagenes de los cursos - talleres
                include "includes/conexion.php";
                include "includes/admin.php";
                $usuario = $_POST["user"];
                $idct = $_POST["id"];
                $img = $_POST["image"];

                echo changeImage($usuario, $idct, $img);

                break;
            case 'chgArch': // Cambia la guia de los cursos - talleres
                include "includes/conexion.php";
                include "includes/admin.php";
                $usuario = $_POST["user"];
                $idct = $_POST["id"];
                $doc = $_POST["documento"];

                echo changeArchivo($usuario, $idct, $doc);

                break;
            case 'verInscritos':
                include "includes/conexion.php";
                include "includes/admin.php";

                echo verInscritos();

                break;

            case 'verInfoIns':
                include "includes/conexion.php";
                include "includes/admin.php";
                $idinscripcion = $_POST["idinsc"];

                echo verInfoInscripciones($idinscripcion);

                break;
            case 'verInfoPago':
                include "includes/conexion.php";
                include "includes/admin.php";
                $idpago = $_POST["id"];

                echo showPago($idpago);

                break;
            case 'modInsc':
                include "includes/conexion.php";
                include "includes/admin.php";
                $idinscripcion = $_POST["idinsc"];

                echo modInscripcion($idinscripcion);

                break;

            case 'modificarInsc':
                include "includes/conexion.php";
                include "includes/admin.php";
                $idinsc = $_POST["idinsc"];
                $opcion = $_POST["opcionp"];
                $idhor = $_POST["horarios"];

                echo updateInscripcion($idinsc, $opcion, $idhor);

                break;

            case 'addPagoM':
                include "includes/conexion.php";
                include "includes/admin.php";
                $idinsc = $_POST["idi"];
                $usuario = $_POST["user"];

                echo registrarPagoManual($idinsc, $usuario);

                break;
            case 'inscManual':
                include "includes/conexion.php";
                include "includes/admin.php";

                echo formInscripcion();

                break;
            case 'aPagos':
                include "includes/conexion.php";
                include "includes/admin.php";

                echo verTodosLosPagos();

                break;
            case 'deleteFile': // Elimina guia del curso
                include "includes/conexion.php";
                include "includes/admin.php";
                $id = $_POST["id"];

                echo deleteFile($id);
                break;
            default:
                # code...
                break;
        }
    }
}
 