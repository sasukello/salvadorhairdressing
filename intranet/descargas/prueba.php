<!doctype html>
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="my_file[]" multiple>
            <input type="submit" value="Upload">
        </form>
        <?php
            if (isset($_FILES['my_file'])) {
                $myFile = $_FILES['my_file'];
                $fileCount = count($myFile["name"]);

                for ($i = 0; $i < $fileCount; $i++) {
                    ?>
                        <p>File #<?= $i+1 ?>:</p>
                        <p>
                            Name: <?= $myFile["name"][$i] ?><br>
                            Temporary file: <?= $myFile["tmp_name"][$i] ?><br>
                            Type: <?= $myFile["type"][$i] ?><br>
                            Size: <?= $myFile["size"][$i] ?><br>
                            Error: <?= $myFile["error"][$i] ?><br>
                        </p>
                    <?php
                    $target_dir = "archivos/prueba/prueba2/";

                    if (!file_exists($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }
                    $target_file = $target_dir . basename($myFile["name"][$i]);
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                    // Check if image file is a actual image or fake image
                    if(isset($_FILES['my_file'])) {
                        $check = getimagesize($myFile["tmp_name"][$i]);
                        if($check !== false) {
                            echo "File is an image - " . $check["mime"][$i] . ".";
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
                    if ($myFile["size"][$i] > 5000000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" && $imageFileType != "pdf" ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                        //header("location:/descargas/admin/actualizar/contenido.php?est=4");
                        return;
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($myFile["tmp_name"][$i], $target_file)) {
                            echo "<br>The file ". basename( $myFile["name"][$i]). " has been uploaded.";
                            //header("location:/descargas/s/nk5w7835.php?y=$nombre&yy=$imageFileType&y3=$tipo&y4=$user&y5=$cat2&y6=".$_FILES["fileToUpload"]["name"]."");
                            //return;
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                            //header("location:/descargas/admin/actualizar/contenido.php?est=4");
                            //return;
                        }
                    }
                    
                    
                }
                if($fileCount == $i){
                    echo "<br>Se subieron todos los archivos.";
                } else{
                    echo "<br>Al parecer no se subieron todos los archivos.";
                }
            }
        ?>
    </body>
</html>