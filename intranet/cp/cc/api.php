<?php

include "/intranet/sec/libcon.php";
function t1(){
 require_once "libfunc.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    /* AÑADIR REGISTRO DE DEPARTAMENTO */
    $sql = "INSERT INTO configuraciondescargas (seccionurl, secciontitulo, secciondescripcion, seccionimage, estado) VALUES ('$url2', 'SECCION DE DESCARGAS: " . $tit2 . "', '" . $descripcion . "', 'ND', '1')";
  
    if (mysqli_query($dbh, $sql)) {
        RegistrarOperacion($usu, $tipo, $tit2);
        header("location:/intranet/descargas/admin/actualizar/departamento.php?est=1");
        return;
    }
        ?>

    <table class="table">
        <thead>
            <tr>
                <th>SALÓN</th>
                <th>ClientCards Entregadas</th>
                <th>ClientCards Activas</th>
                <th>Última ClientCard Entregada</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
        </tbody>
    </table>
<?php } ?>