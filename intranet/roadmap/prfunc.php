<?php 
error_reporting(1);
include "../sec/libcon.php";

function listaProyectos($user, $paso){

	if($paso == 1){
	    $pr1 = json_decode((getProyectos($user, $paso)), true);
		foreach ($pr1 as $pr) {
			$user1 = getUsers($pr["idpr"]);
			armarListaPro($pr["idpr"], $pr["nombrepr"],  $pr["regionpr"],  $pr["categoriapr"], $pr["fechapr"], $user1);
		}
	}
	return;
}
        //listado en index.php
function armarListaPro($id, $titulo, $region, $cate, $fecha, $users){
	echo '<div class="col-md-12 padding-0 pad" style="height:auto;">
		<div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
          <div class="col-md-7 col-sm-7 col-xs-7">';
          foreach ($users as $u) {
          	armarUsuarios($u["userid"]);
          }
          echo '<a data-toggle="modal" href="#infopr" data-i="'.$id.'" data-ii="'.ucwords(strtolower($titulo)).'"><h4>'.ucwords(strtolower($titulo)).'</h4></a>
          </div>
          <div class="col-md-5 col-sm-5 text-center box-v6-progress">
            <div class="progress" id ="progreso-'.$id.'">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> 70 % Completo
              </div>
            </div>
            <p style="font-size: 14px;">Fecha de Inicio: '.$fecha.'</p>
          </div>
        </div>
    </div>';
}

function armarUsuarios($nombre){
	echo "<span data-letters='".substr($nombre, 0,2)."'></span>";
}

function getProyectos($user, $paso){
	$result = miSQL("SELECT A.idpr, A.nombrepr, A.regionpr, A.categoriapr, A.fechapr FROM `intranet_roadmap` A INNER JOIN `intranet_roadmap_users` B ON A.`idpr` = B.`prid` WHERE B.`userid` = '$user';");
	return $result;
}

function getUsers($idpr){
	$idp = intval($idpr);
    $dbh = dbconnlocal();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    $sql = "SELECT userid FROM `intranet_roadmap_users` WHERE prid = ".$idp.";";
    $result = array();
    $i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    if (mysqli_num_rows($search) > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $result[$i] = $rw;
            $i++;
        }
    } else {
        $result = "No se encontró ningún resultado.";      
    }

    mysqli_close($dbh);
    $r = json_encode($result);
    return $result;
}

function listaProyectDetalles($prid){
	$detalles = getDetalleProy($prid);
	armarDetalleProy($detalles);
	return;
}

function getDetalleProy($prid){
	//var_dump($prid);
	$result = miSQL("SELECT * FROM `intranet_roadmap` WHERE idpr = ".$prid.";");
	return $result;
}
    //listado detallado
function armarDetalleProy($datos){
	$dat = json_decode($datos, true);
	$categoria = intval($dat[0]["categoriapr"]);
	$categ = getCategorias(1, $categoria);
	$categfi = ucwords(strtolower($categ[0]["valor1"]));
	$userpr = getUsers(intval($dat[0]["idpr"]));
	echo '<div class="form-group row list-group-item sel">

      <div class="col-xs-6 bord">
        <span><strong>Estado: </strong>'.estadoProy($dat[0]["estado"]).'</span>
      </div>

      <div class="col-xs-6">
        <span><strong>Fechita de Inicio:</strong> '.$dat[0]["fechapr"].'</span>

      </div>
    </div>

    <div class="form-group row list-group-item sel">

      <div class="col-xs-6 bord">
        <span><strong>Categoría:</strong> '.$categfi.'</span>
      </div>

      <div class="col-xs-6">
        <span><strong>Región:</strong> '.regionBanderas($dat[0]["regionpr"]).'</span>

      </div>
    </div>

    <span class="list-group-item"><strong>Descripción del Proyecto:</strong> '.$dat[0]["descripcion"].'</span>

    <span class="list-group-item"><strong>Personal a cargo:</strong> ';
    foreach ($userpr as $u) {
      armarUsuarios($u["userid"]);
    }
    echo '<span class="pe-7s-add-user addpruser"></span></span><span class="list-group-item"><div class="demo-wrapper">
            <div class="dashboard clearfix">
              <ul class="tiles">
                <div class="col1 clearfix">
                  <a data-toggle="modal" data-i="'.intval($dat[0]["idpr"]).'" data-ii="'.$dat[0]["nombrepr"].'" data-iii="'.$categoria.';'.$u["userid"].'" href="#actipr"><li class="tile tile-big tile-1 slideTextUp" data-page-type="r-page" data-page-name="random-r-page">
                    <div><p>Actividades</p></div>
                    <div><p>Ver las Actividades</p></div>
                  </li>
                </div>
              </ul>
            </div>
          </div>';
	return;
}

function getCategorias($paso, $condicion){
	if($paso === 1){ // condicion - id cat
		$dbh = dbconnlocal();
	    mysqli_set_charset($dbh, 'utf8');

	    if (!$dbh) {
	        die('Error en Conexión: ' . mysqli_error($dbh));
	        exit;
	    }
	    $sql = "SELECT valor1, valor2, valueorden FROM intranet_roadmap_meta where id = ".$condicion.";";
	    $result = array();
	    $i = 0;
	    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
	    if (mysqli_num_rows($search) > 0) {
	        while ($rw = mysqli_fetch_array($search)) {
	            $result[$i] = $rw;
	            $i++;
	        }
	    } else {
	        $result = "No se encontró ningún resultado.";      
	    }

	    mysqli_close($dbh);
	    $r = json_encode($result);

	} else { // condicion - nivel user
		
		echo miSQL("SELECT valor1, valor2, valueorden FROM intranet_roadmap_meta where id = ".$condicion.";");		
		//echo miSQL("SELECT valor1, valor2 valueorden FROM intranet_roadmap_meta where META = 'CAT'");		
		return;
	}
	return $result;
}

function actividadesMain($datos){
    list($idpr, $catpr, $usuario) = explode(";", $datos);
    $idp = intval($idpr);
    $catp = intval($catpr);

    $actividades = getActividades($catp.";".$idp, 2);
    //var_dump($actividades);
    armarActividades($actividades, $idp, $catp, $usuario);

    //echo '';
}

function getActividades($prid, $paso){
	if($paso === 1){
		echo miSQL("SELECT A.categoriapr, B.value1 FROM intranet_roadmap A INNER JOIN intranet_roadmap_actividades B ON A.categoriapr = B.valuecateg WHERE A.idpr = $prid OR B.valuepr = $prid ORDER BY B.valueorden ASC;");
	} else if ($paso === 2){ // prid == id de categoria -- lista de actividades
    $acti = array();
		list($cat, $pri) = explode(";", $prid);
		$sql = "SELECT id, value1, valuecateg FROM intranet_roadmap_actividades WHERE valuecateg = ".$cat." ORDER BY (valueorden) ASC;";
		$sql2 = "SELECT id, value1, valuecateg FROM intranet_roadmap_actividades WHERE valuepr = ".$pri." ORDER BY (valueorden) ASC;";

		$acti[0] = miSQL($sql);
    $acti[1] = miSQL($sql2);
	}
	return $acti;
}

function armarActividades($datos, $idproy, $catproy, $usuario){
    

	//$acti = json_decode($datos, true);
	echo '<span class="list-group-item"><strong>Actividades Pendientes:</strong>
            <ul class="list-group">
              <div class="panel-group" id="accordion">
                  <div class="panel panel-default">';
foreach ($datos as $dat) {
    $acti = json_decode($dat, true);
    foreach ($acti as $ac) {

    echo '<div class="panel-heading" style="height: 35px;">
                      <h4 class="panel-title">
                        <div class="col-md-8 col-sm-8 col-xs-8">
                        <a data-toggle="collapse" data-parent="#accordion" href="#'.$ac["id"].'">'.$ac["value1"].'</a>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;  padding-top: 4px;">
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="80"
                            aria-valuemin="0" aria-valuemax="80" style="width:80%">
                              80%
                            </div>
                          </div>
                        </div>
                      </h4>
                    </div>

                    <div id="'.$ac["id"].'" class="panel-collapse collapse">
                        <div class="well" style="overflow: auto;">
                          <ul class="list-group checked-list-box">';
                          $minutas = getMinutas($ac["id"], $idproy);
                          foreach ($minutas as $minu) {
                            $min = json_decode($minu, true);
                            foreach ($min as $m) {
                            echo '<li class="list-group-item clist" data-checked="true"><div class="checkbox">
                            <label><input type="checkbox" value="">Option 1</label>
                            </div></li>';
                            }
                          }
                          //var_dump($minutas);
                          echo '<span id="newminutaspace'.$ac["id"].'"></span></ul>
                       <span class="addminActi"><a href="#" onClick="newminuta1('.$ac["id"].','. $idproy.',\''. $usuario .'\', 0)";><i class="pe-7s-plus"></i> <span id="min1" style="vertical-align: text-bottom;">Minuta</span></a></span></div>
                    </div>';
    }}
	echo '</div></div></ul></span>';
    return;
}

function getMinutas($idact_padre, $idproy){
    $minutas = array();

    $sql = "SELECT id, descripcion, fechacreada, fechacerrada, usuariocreada, usuariocerrada, estado FROM intranet_roadmap_minutas WHERE actipadre_id = ".$idact_padre.";";
    $sql2 = "SELECT id, descripcion, fechacreada, fechacerrada, usuariocreada, usuariocerrada, estado FROM intranet_roadmap_minutas WHERE proy_id = ".$idproy.";";

    $minutas[0] = miSQL($sql);
    $minutas[1] = miSQL($sql2);
    return $minutas;
}

function estadoProy($estado){
	switch ($estado) {
		case '0':
			return "Activo";
			break;
		case '1':
			return "Completado";
			break;
		case '2':
			return "Pausado";
			break;
		case '3':
			return "Cancelado";
			break;
		default:
			return "No disponible.";
			break;
	}
}

function miSQL($query){
    $dbh = dbconnlocal();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    $sql = $query;
    $result = array();
    $i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    if (mysqli_num_rows($search) > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $result[$i] = $rw;
            $i++;
        }
    } else {
        $result = "";      
    }

    mysqli_close($dbh);
    $r = json_encode($result);
    return $r;
}

function regionBanderas($id){
	$id = intval($id);
    switch ($id) {
        case '1':
            return "<img id='flag' alt='Venezuela' src='/images/flags/ve128.png' width='30' height='30' style='visibility: block;'>";
            break;
        case '2':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Panamá'><img alt='pty' src='/images/flags/pty128.png' class='wow fadeInUp' data-wow-delay='0.2s'></a>";
            break; 
        case '3':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Estados Unidos'><img alt='usa' src='/images/flags/usa128.png' class='wow fadeInUp' data-wow-delay='0.3s'></a>";
            break;
        case '72':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='República Dominicana'><img alt='repdom' src='/images/flags/domrep128.png' class='wow fadeInUp'></a>";
            break;
        case '249':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Colombia'><img alt='col' src='/images/flags/col128.png' class='wow fadeInUp' data-wow-delay='0.5s'></a>";
            break;
        case '302':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Ecuador'><img alt='ec' src='/images/flags/ec128.png' class='wow fadeInUp' data-wow-delay='0.6s'></a>";
            break;
        case '304':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Curazao'><img alt='crz' src='/images/flags/cu128.png' class='wow fadeInUp' data-wow-delay='0.7s'></a>";
            break;
        case '376':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='México'><img alt='mex' src='/images/flags/mex.png' class='wow fadeInUp' data-wow-delay='0.8s'></a>";
            break;
        case '378':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Perú'><img alt='per' src='/images/flags/per.png' class='wow fadeInUp' data-wow-delay='0.9s'></a>";
            break;
        case '380':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Chile'><img alt='chl' src='/images/flags/chile128.png' class='wow fadeInUp' data-wow-delay='1s'></a>";
            break;
        case '382':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' role='button' title='Costa Rica'><img alt='ven' src='/images/flags/cr128.png' class='wow fadeInUp' data-wow-delay='1.1s'></a>";
            break;
        default:
            break;
    }
}

?>