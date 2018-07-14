<?php
//$msg = "Ingresa tu Usuario y Contraseña del <b>Salvador Corporativo Plus</b>, para activar tu cuenta.<br>";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['u'])) {
        require_once "../s/rsdh654j686uyj6j65je4j8uepl97.php";
        require_once "../s/libfunc.php";

        $user = $_GET["u"];
        $password = $_GET["p"];
        $nombre = strtoupper($user);
        $nombreUsuario = "";
        $permisoUsuario = "";

        $con = Conectarfb();
        $sql = "SELECT hash('$password'), CLAVEHASH, CODIGO, NOMBRECOMPLETO, NIVEL FROM usuarios WHERE CODIGO = '$nombre'";
        $result = ibase_query($con, $sql);

        $rawdata = array();
        $i = 0;

        while ($row = ibase_fetch_object($result)) {
            $rawdata[$i] = $row;
            $i++;
        }
        
        $array = json_encode($rawdata);
        $array2 = json_decode($array);
        
        $usuarioTemp = $array2[0]->CODIGO;
        $nombreUsuarioTemp = $array2[0]->NOMBRECOMPLETO;
        $permisoUsuario = $array2[0]->NIVEL;
        $clavehash1 = $array2[0]->HASH;
        $clavehash2 = $array2[0]->CLAVEHASH;
        
        if($clavehash1 === $clavehash2){

        $usuario = ucwords($usuarioTemp);
        $nombreUsuario = ucwords($nombreUsuarioTemp);
        $nombreUsuario = ucwords(strtolower($nombreUsuario));
        
        if($permisoUsuario >= 50){
            $tipo = '2';
            RegistrarLogin($usuario, $tipo);
            $cod = base64_encode(strtoupper($usuario));
            $nomcod = base64_encode($nombreUsuario);
            $percod = base64_encode($permisoUsuario);

            $_SESSION["codigo"] = $usuario;
            $_SESSION["usuario"] = $nombreUsuario;
            $_SESSION["permiso"] = $permisoUsuario;
            header("location:http://www.salvadorhairdressing.com/descargas/admin/index.php?u=$nomcod&p=$percod&c=$cod");
            return;
            } else if($permisoUsuario < 50){
            $tipo = '1';
            RegistrarLogin($usuario,$tipo);
            $cod = base64_encode(strtoupper($usuario));
            $nomcod = base64_encode($nombreUsuario);
            $percod = base64_encode($permisoUsuario);

            $_SESSION["codigo"] = $usuario;
            $_SESSION["usuario"] = $nomcod;
            $_SESSION["permiso"] = $percod;
            header("location:http://www.salvadorhairdressing.com/descargas/cuenta/index.php?u=$nomcod&p=$percod&c=$cod");
            return;
            } // TIPO DE USUARIO

    } else{
        header("location:http://www.salvadorhairdressing.com/descargas/index.php?m=3");
        return;
    }
    }
}
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Salvador Peluquerías: Descargas - Activa tu cuenta</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/normalizeloginactiva.css">   
        <style>
      body {
  font-family: "Open Sans", sans-serif;
  height: 100vh;
  /*background: url("http://i.imgur.com/HgflTDf.jpg") 50% fixed;*/
  background: url("/images/bg.jpg") repeat;
  background-size: cover;
}

@keyframes spinner {
  0% {
    transform: rotateZ(0deg);
  }
  100% {
    transform: rotateZ(359deg);
  }
}
* {
  box-sizing: border-box;
}

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
  /*background: rgba(4, 40, 68, 0.85);*/
  background: rgba(5, 4, 20, 0.85);
}

.login {
  border-radius: 0px 0px 5px 5px;
  padding: 10px 20px 20px 20px;
  width: 90%;
  max-width: 320px;
  background: #ffffff;
  position: relative;
  padding-bottom: 80px;
  box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
}
.login.loading button {
  max-height: 100%;
  padding-top: 50px;
}
.login.loading button .spinner {
  opacity: 1;
  top: 40%;
}
.login.ok button {
  background-color: #8bc34a;
}
.login.ok button .spinner {
  border-radius: 0;
  border-top-color: transparent;
  border-right-color: transparent;
  height: 20px;
  animation: none;
  transform: rotateZ(-45deg);
}
.login input {
  display: block;
  padding: 15px 10px;
  margin-bottom: 10px;
  width: 100%;
  border: 1px solid #ddd;
  transition: border-width 0.2s ease;
  border-radius: 2px;
  color: #ccc;
}
.login input + i.fa {
  color: #fff;
  font-size: 1em;
  position: absolute;
  margin-top: -47px;
  opacity: 0;
  left: 0;
  transition: all 0.1s ease-in;
}
.login input:focus {
  outline: none;
  color: #444;
  border-color: #2196F3;
  border-left-width: 35px;
}
.login input:focus + i.fa {
  opacity: 1;
  left: 30px;
  transition: all 0.25s ease-out;
}
.login a {
  font-size: 0.8em;
  color: #2196F3;
  text-decoration: none;
}
.login .title {
  color: #444;
  font-size: 1.2em;
  font-weight: bold;
  margin: 10px 0 30px 0;
  border-bottom: 1px solid #eee;
  padding-bottom: 20px;
  text-align: center;
}
.login button {
  width: 100%;
  height: 100%;
  padding: 10px 10px;
  background: #2196F3;
  color: #fff;
  display: block;
  border: none;
  margin-top: 20px;
  position: absolute;
  left: 0;
  bottom: 0;
  max-height: 60px;
  border: 0px solid rgba(0, 0, 0, 0.1);
  border-radius: 0 0 2px 2px;
  transform: rotateZ(0deg);
  transition: all 0.1s ease-out;
  border-bottom-width: 7px;
}
.login button .spinner {
  display: block;
  width: 40px;
  height: 40px;
  position: absolute;
  border: 4px solid #ffffff;
  border-top-color: rgba(255, 255, 255, 0.3);
  border-radius: 100%;
  left: 50%;
  top: 0;
  opacity: 0;
  margin-left: -20px;
  margin-top: -20px;
  animation: spinner 0.6s infinite linear;
  transition: top 0.3s 0.3s ease, opacity 0.3s 0.3s ease, border-radius 0.3s ease;
  box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.2);
}
.login:not(.loading) button:hover {
  box-shadow: 0px 1px 3px #2196F3;
}
.login:not(.loading) button:focus {
  border-bottom-width: 4px;
}

footer {
  display: block;
  padding-top: 50px;
  text-align: center;
  color: #ddd;
  font-weight: normal;
  text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.2);
  font-size: 0.8em;
}
footer a, footer a:link {
  color: #fff;
  text-decoration: none;
}
.statusmsg{   
    height: 80px;
    width: 320px;
    padding: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    text-align: center;
    background-color: white;
}
    </style>
        <script src="js/prefixfree.min.js"></script>
  </head>
  <body>
    <div class="wrapper">
    <?php
    if (isset($msg)) { // Check if $msg is not empty
        echo '<div class="statusmsg">' . $msg . '</div>'; // Display our message and add a div around it with the class statusmsg
    }
    ?>
  <form action="" method="post" class="login">
    <p class="title">Salvador Descargas<br>Activar tu cuenta:</p>
    <input type="text" name="usuario" placeholder="Usuario" autofocus required/>
    <i class="fa fa-user"></i>
    <input type="password" name="password" placeholder="Contrase&#241;a" required />
    <i class="fa fa-key"></i>
    <!--<a href="#">&#191;Olvidaste tu Contrase&#241;a?</a>!-->
    <button type="submit" name="postlogin">
      <i class="spinner"></i>
      <span class="state">Activar</span>
    </button>
  </form>
  </p>
</div>
    <!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="js/index.js"></script>!-->
  </body>
</html>