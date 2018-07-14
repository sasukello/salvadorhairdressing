<?php
$departamento = "otros";
$categoria = "etc";
$nombre = "ND";
$user = "N/A";
$msg = "";
if(isset($_POST['postcontenido'])){
    $idDepartamento = $_POST['padre'];
    $idCategoria = $_POST['categoria'];
    
    
    $tipo = $_POST['tipo'];
    $user = $_POST['usuario'];
    list($departamento, $categoria) = explode(";", $arrayCompleto);
    $cat = strtolower($categoria);
    $cat2 = str_replace(' ', '', $cat);
}



            if (isset($_FILES['my_file'])) {
                $myFile = $_FILES['my_file'];
                $fileCount = count($myFile["name"]);

                for ($i = 0; $i < $fileCount; $i++) {
                    ?>
                        <!--<p>File #<?= $i+1 ?>:</p>
                        <p>
                            Name: <?//= $myFile["name"][$i] ?><br>
                            Temporary file: <?= $myFile["tmp_name"][$i] ?><br>
                            Type: <?//= $myFile["type"][$i] ?><br>
                            Size: <?//= $myFile["size"][$i] ?><br>
                            Error: <?//= $myFile["error"][$i] ?><br>
                        </p>!-->
                    <?php
                    $target_dir = "../archivos/$idDepartamento/$idCategoria/";

                    if (!file_exists($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }
                    $target_file = $target_dir . basename($myFile["name"][$i]);
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                    // Check if image file is a actual image or fake image
                    /*if(isset($_FILES['my_file'])) {
                        $check = getimagesize($myFile["tmp_name"][$i]);
                        if($check !== false) {
                            echo "File is an image - " . $check["mime"][$i] . ".";
                            $uploadOk = 1;
                        } else {
                            $msg = 6;
                            //echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    }*/
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        $msg = 7;
                        //echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }
                    // Check file size
                    if ($myFile["size"][$i] > 5000000) {
                        //echo "Sorry, your file is too large.";
                        $msg = 8;
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" && $imageFileType != "pdf" ) {
                        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $msg = "5";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        //echo "Sorry, your file was not uploaded.";
                        header("location:/intranet/descargas/admin/actualizar/contenido.php?est=$msg");
                        return;
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($myFile["tmp_name"][$i], $target_file)) {
                            //REGISTRO en BASE DE DATOS
                            $nombre = $myFile["name"][$i];
                            $tamaño = $myFile["size"][$i];
                            if(registrarContenido($nombre, $idDepartamento, $idCategoria, $tamaño) == 1){
                                $msg = 1;
                            } else if(registrarContenido($nombre, $idDepartamento, $idCategoria, $tamaño) == 0){
                                $msg = 9;
                            }
                            
                            //echo "<br>The file ". basename( $myFile["name"][$i]). " has been uploaded.";
                            //header("location:/descargas/s/nk5w7835.php?y=$nombre&yy=$imageFileType&y3=$tipo&y4=$user&y5=$cat2&y6=".$_FILES["fileToUpload"]["name"]."");
                            //return;
                        } else {
                            //echo "Sorry, there was an error uploading your file.";
                            header("location:/intranet/descargas/admin/actualizar/contenido.php?est=4");
                            return;
                        }
                    }
                    
                    
                }
                if($fileCount == $i){
                    //echo "<br>Se subieron todos los archivos.";
                    header("location:/intranet/descargas/admin/actualizar/contenido.php?est=$msg");
                    return;
                } else{
                    $msg = 9;
                    //echo "<br>Al parecer no se subieron todos los archivos.";
                    header("location:/intranet/descargas/admin/actualizar/contenido.php?est=$msg");
                    return;
                }
            }
            
function registrarContenido($nombre, $idseccion, $idpadre, $tamaño){
require_once "../s/libfunc.php";
$dbh = dbconn();
mysqli_set_charset($dbh, 'utf8');
if (!$dbh) {
    die('Error en Conexión: ' . mysqli_error($con));
    exit;
}

$sql = "INSERT INTO `configuraciondescargascontenido` (idseccion, idpadre, titulo, url, tamaño) VALUES ('$idseccion', '$idpadre', '$nombre', '$nombre', $tamaño)";
if (mysqli_query($dbh, $sql)) {
        //RegistrarOperacion($user, $tipo, $nombre);
        return 1;
    } else {
        die(mysqli_error($dbh));
        return 0;
    }
}
?>
