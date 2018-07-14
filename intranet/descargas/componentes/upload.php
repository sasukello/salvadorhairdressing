<?php
$departamento = "otros";
$categoria = "etc";
$nombre = "ND";
$user = "N/A";
$msg = "";
if(isset($_POST['postcontenido'])){
    $nombre = $_POST['titulo'];
    $arrayCompleto = $_POST['padre'];
    $tipo = $_POST['tipo'];
    $user = $_POST['usuario'];
    list($departamento, $categoria) = explode(";", $arrayCompleto);
    $cat = strtolower($categoria);
    $cat2 = str_replace(' ', '', $cat);
}
$target_dir = "../archivos/$departamento/$cat2/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["postregistro"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "doc" 
&& $imageFileType != "docx" ) {
    //$msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $msg = "5";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
    header("location:/descargas/admin/actualizar/contenido.php?est=$msg");
    return;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        header("location:/descargas/s/nk5w7835.php?y=$nombre&yy=$imageFileType&y3=$tipo&y4=$user&y5=$cat2&y6=".$_FILES["fileToUpload"]["name"]."");
        return;
    } else {
        //echo "Sorry, there was an error uploading your file.";
        header("location:/descargas/admin/actualizar/contenido.php?est=4");
        return;
    }
}
?>
