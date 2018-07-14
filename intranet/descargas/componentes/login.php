<h2 id="ayudah2">INICIA SESIÓN</h2>
<div id='line1' style='height:auto;width: 100%;margin-left: auto;margin-right: auto;'>
    <img src='/images/line_header.jpg' width='991' height='6' style="width: 100%;"/>
</div>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['postlogin'])) {
        require_once "s/rsdh654j686uyj6j65je4j8uepl97.php";
        comprobarLogin(); 
    }
}
?>
<p id="loginIndex">Introduce tu nombre y contraseña para entrar a tu cuenta:</p>
<form action="" id="loginIndex" method="post">

    <div class="form-group">
        <label class="control-label col-sm-4" for="user">Usuario:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="usuario" placeholder="Ingrese su usuario" name="usuario" required value="" />
        </div>
    </div>    
    <br><br>
    <div class="form-group">
        <label class="control-label col-sm-4" for="password">Contraseña:</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" id="password" placeholder="Ingrese su contraseña" name="password" required value="" />
        </div>
    </div>    
    <br><br>
    <input type="submit" class="botones" name="postlogin" value="Entrar" />
    <br><br><div id='line1' style='height:auto;width: 100%;margin-left: auto;margin-right: auto;'>
    <img src='/images/line_header.jpg' width='991' height='6' style="width: 100%;"/>
</div>
    <!--<br><a href="ayuda/recuperarclave.php">¿Olvidaste tú Contraseña?</a><br><br>!-->
</form>