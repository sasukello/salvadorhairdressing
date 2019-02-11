<?php
if(isset($_GET['mail'])){
    $mailPart = $_GET['mail'];
    $tipoOp = $_GET['t'];
    if(isset($_GET['e'])){
        $error = $_GET['e'];
        if($error == 1){
            $msg = "La contraseña no coincide con el usuario indicado.";
            $clase = "";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ms_loginexterno'])) {
        if($_POST['tipoOp'] == '1'){
            // TIPO 1
            require_once "../sitio/sec/ms/libfunc.php";
            $email = $_POST['email'];
            $password = $_POST['password'];
            $participante = $_POST['mailPart'];
            comprobarLoginCorpExterno($email, $password, $participante, 1); 
        } else if($_POST['tipoOp'] == '2'){
            // TIPO 2
            require_once "../sitio/sec/ms/libfunc.php";
            $email = $_POST['email'];
            $password = $_POST['password'];
            $participante = $_POST['mailPart'];
            comprobarLoginCorpExterno($email, $password, $participante, 2); 
        }
    }
}
if(isset($msg)){
    echo $msg;
}
?>

<form class="form-header" role="form" method="POST" id="ms_email">
    <input type="hidden" name="u" value="503bdae81fde8612ff4944435">
    <input type="hidden" name="id" value="bfdba52708">
    <input type="hidden" name="mailPart" value="<?php echo $mailPart; ?>">
    <input type="hidden" name="tipoOp" value="<?php echo $tipoOp; ?>">
    <div class='form-group'>
        <input class='form-control input-lg' name='email' id='email' type='text' placeholder='Ingresa tu usuario' required>
    </div>
    <div class='form-group'>
        <input class='form-control input-lg' name='password' id='password' type='password' placeholder='Ingresa tu contraseña' autofocus required>
    </div>
    <div class='form-group last'>
        <br><input type='submit' name='ms_loginexterno' class='btn btn-warning btn-block btn-lg' value='ENTRAR'>
    </div>
</form>
