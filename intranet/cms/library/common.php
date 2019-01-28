<?php
error_reporting(1);

function miActionSQL($sql){

    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    $resultado = 0;
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        $resultado = 0;
        exit;
    }
    $textsql = $sql;
    if (mysqli_query($dbh, $textsql)) {
        $resultado = 1;
    } else{
        $resultado = "0;".mysqli_error($dbh);
    }

    mysqli_close($dbh);
    return $resultado;
}

function miBusquedaSQL($sql){

    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        echo "Error BD";
        exit;
    }
    $textsql = $sql;
    $search = mysqli_query($dbh, $textsql) or die("<div class='alert alert-danger'><strong>Error 002:</strong>".mysqli_error($dbh)."</div>");
    $result = array();
    $i = 0;
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $result[$i] = $rw;
            $i++;
        }

    } else {
        $result[0] = "0";
    }
    return json_encode($result);
}

    function dbconn() {
    // Create connection
    //$link = mysqli_connect('www.salvadorpeluquerias.com', 'sopor907_admin', 'salvaAdmin2', 'sopor907_cp');
    $link = mysqli_connect('localhost', 'root', '', 'sopor907_cp');

    // Check connection
    if (!$link) {
           //header('location: /mysteryshopper/index.php');
       // alert("ERROR");
            return $link;
        }
    return $link;
    }

?>