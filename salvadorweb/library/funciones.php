<?php 
/**** FUNCIONES PARA LO RELACIONADO A LAS UBICACIONES ****/

function loadUbicaciones($where, $paso, $pais){
	include 'libcon.php';
  //$ubica = "";
  $bandera = false;
  if($pais == ""){
    $sql = "SELECT * FROM web_salones WHERE concepto = $where AND estado = 1 ORDER BY regionsalon ASC;";
    $result = miBusquedaSQL($sql);
    $ubica = armarUbicaciones($result, $paso);
    return $ubica;
  } else{
    $nuevoarray = array();$i=0;
    $sqlreg = "SELECT campo, campo2, campo3, campo4, B.CONCEPTO, B.REGIONSALON, B.ESTADO FROM ms_configuracion A INNER JOIN (SELECT CONCEPTO, ESTADO, REGIONSALON FROM web_salones) B ON A.campo = B.REGIONSALON WHERE A.grupo = 'regiones' AND B.CONCEPTO = ".$where." AND B.ESTADO = 1;";
    $regiones = (array) json_decode(miBusquedaSQL($sqlreg), true);
      foreach ($regiones as $r) {
        if($r[3] == $pais){
          $region = $r[0];
          $bandera = true;
        }

        $nuevoarray[$i] = $r[0];
        $i++;
      }

        if($bandera == true){
          $sql = "SELECT * FROM web_salones WHERE concepto = $where AND estado = 1 AND regionsalon = ".$region." ORDER BY regionsalon ASC;";
          $result = miBusquedaSQL($sql);
          $ubica = armarUbicaciones($result, $paso);
        } else if($bandera == false){
          $ubica = "<b>No hubo resultados en la región consultada. Consulte en: </b><br><br><div class='blog-posts grid-view grid-concepto'><div class='isotope row'>";
          $flag = "";$j=0;$hola="";
          $unique = array_keys(array_flip($nuevoarray)); 
          //var_dump($unique);
          $first_names = array_column($regiones, 'campo3');
          $unique2 = array_keys(array_flip($first_names)); 
          //print_r($unique2);

          foreach ($unique as $r) {
            //$flag .= "<img src='".$r[2]."' width='30px!important' height='22px' style='width:30px!important;''><br>";
            

            $flag .= '<div class="col-md-2 col-sm-3 grid-view-post item">
                        <div class="item1 post">
                          <div class="box text-center">
                            <a href="?country='.abrevRegion($r).'"><img class="ubiflags" src="'.$unique2[$j].'"><strong>'.cambiarRegion($r).'</strong></a>
                          </div>                  
                        </div>
                      </div>';
            
            $j++;
          }

          $ubica .= $flag . "</div></div>";
        }

        return $ubica;
      }
  }

function armarUbicaciones($result, $paso){
	$resu = (array) json_decode($result, true);
	$element='<div id="slide-portfolio" class="image-grid">
        <div class="items-wrapper">
          <ul class="isotope items">';
  if($resu[0] == "0" || $resu[0] == 0){
      echo "<b>No hubo resultados.<br><br>";
  } else{

    foreach ($resu as $re) {
    $miniatura = $re["URL_IMG_THUMB"];

    if($miniatura == ""){
      $miniatura = "13thumb.jpg";
    }
    $element .= '<li class="item col-md-3 col-sm-6 marginbt10">
              <figure class="icon-overlay"><a href="#0" data-type="slide-portfolio-item-1" data-sid="'.$re["ID"].'" data-tipo="1"><img src="/c/img/salons/'.$miniatura.'" alt="" /></a></figure>
              <div class="slide-portfolio-item-info box">
                <h4 class="post-title">'.$re["NOMBRECOMPLETO"].'</h4>
                <div class="meta marginbt0">'.cambiarRegion($re["REGIONSALON"]).'</div>
                <div class="text-center">'.numStars($re["ID"], $re["VOTOS"], $re["SUMAVOTOS"],1).'</div>
              </div>
            </li>';
    }
  }

	return $element . '</ul>
        </div>
      </div>';
}

function armarUbicacionesDetalle($data, $paso){
  include '../library/libcon.php';
	$sql = "SELECT * FROM web_salones WHERE ID = '".$data."';";
	$resu = (array) json_decode(miBusquedaSQL($sql), true);
	
	$element="";

	foreach ($resu as $re) {
		$element .= '<h2 class="text-center">'.$re["NOMBRECOMPLETO"].'<br></h2><h4 class="text-center">'.cambiarRegion($re["REGIONSALON"]).'</h4><br>
      <div class="row text-center"><img src="/c/img/salons/'.$re["URL_IMG"].'" width="80%" alt=""></div>
      <p class="text-center"><br>
        <b>'. _("Dirección") .':</b> '.$re["DIRECCION"].'</b>
        <br><b>'. _("Teléfonos") .':</b> '.$re["TELEFONO1"].'/ '.$re["TELEFONO2"].'
      </p>
      <div class="divide25"></div>';
      $instagram = $re["INSTAGRAM"];
      if($instagram !== ""){
        $element .= '<div class="row text-center">
                        <h3>'. _("Síguenos en:") .'</h3>
                        <a href="//www.instagram.com/'.$instagram.'" target="_blank"><i class="fab fa-instagram" style="font-size:1.5em;"></i> '.$instagram.'</a>
                    </div>';
      }

      
	}
	return $element;
}

function armarUbicacionesMapa($data, $paso){
  include '../library/libcon.php';
  $sql = "SELECT latitud, longitud FROM web_salones WHERE ID = '".$data."' LIMIT 1;";
  $resu = (array) json_decode(miBusquedaSQL($sql), true);
  $element = "";
  foreach ($resu as $re) {
    if($re["latitud"] == ""){
      $element = _("Ubicación no disponible.");
    } else{
      $element = '<img src="https://maps.googleapis.com/maps/api/staticmap?center='.$re["latitud"].','.$re["longitud"].'&zoom=15&size=600x300&maptype=roadmap&markers=color:red%7Clabel:S%7C'.$re["latitud"].','.$re["longitud"].'&key=AIzaSyBBTYoweUiZnxwTuuS1qH34U5oQ12ztbIU">';
    }
  }
  return $element;

}

function cambiarRegion($entrada){
	$region = "";
	switch ($entrada) {
		case '1':
			$region = "Venezuela";
			break;
		case '2':
			$region = _("Panamá");
			break;
		case '3':
			$region = _("Estados Unidos");
			break;
		case '72':
			$region = _("República Dominicana");
			break;
		case '249':
			$region = _("Colombia");
			break;
		case '302':
			$region = _("Ecuador");
			break;
		case '304':
			$region = _("Curazao");
			break;
		case '376':
			$region = _("México");
			break;
		case '378':
			$region = _("Perú");
			break;
        case '430':
          $region = _("Italia");
          break;
	}
	return $region;
}

function abrevRegion($entrada){
  $region = "";
  switch ($entrada) {
    case '1':
      $region = "ve";
      break;
    case '2':
      $region = _("pty");
      break;
    case '3':
      $region = _("usa");
      break;
    case '72':
      $region = _("rd");
      break;
    case '249':
      $region = _("col");
      break;
    case '302':
      $region = _("ec");
      break;
    case '304':
      $region = _("crz");
      break;
    case '376':
      $region = _("mex");
      break;
    case '378':
      $region = _("per");
      break;
    case '430':
      $region = _("it");
      break;
  }
  return $region;
}

function conceptosbar($ubi, $idioma){
  if($ubi == "mod"){
    switch ($idioma) {
      case 'en_US':
        $texto = "Business Models";
        break;
      
      default:
        $texto = _("Modelos de Negocio");
        break;
    }
    
  } else {

    switch ($idioma) {
      case 'en_US':
        $texto = "Our Business Models";
        break;
      
      default:
        $texto = _("Nuestros Modelos de Negocio");
        break;
    }
  }

  if($idioma != ""){
    $url = '?lang='.$idioma;
  }

	echo '<div class="blog-posts grid-view grid-concepto">
            <h2 class="post-title text-center texttipo2">'.$texto.'</h2>
            <div class="isotope row">
              <div class="col-md-2 col-sm-6 grid-view-post item">
                <div class="item1 post">
                  <div class="box text-center">
                    <a href="/modelos/instituto.php'.$url.'"><img src="/c/img/logos/instituto-logo.png"></a>
                  </div>                  
                </div>
              </div>
              
              <div class="col-md-2 col-sm-6 grid-view-post item">
                <div class="item1 post">
                  <div class="box text-center">
                    <a href="/modelos/express.php'.$url.'"><img src="/c/img/logos/express-logo.png"></a>
                  </div>                  
                </div>
              </div>

              <div class="col-md-2 col-sm-6 grid-view-post item">
                <div class="item1 post">
                  <div class="box text-center">
                    <a href="/modelos/uomo.php'.$url.'"><img src="/c/img/logos/uomologo.png"></a>
                  </div>                  
                </div>
              </div>

              <div class="col-md-2 col-sm-6 grid-view-post item">
                <div class="item1 post">
                  <div class="box text-center">
                    <a href="/modelos/kids.php'.$url.'"><img src="/c/img/logos/kids-logo.png"></a>
                  </div>
                </div>
              </div>

              <div class="col-md-2 col-sm-6 grid-view-post item">
                <div class="item1 post">
                  <div class="box text-center">
                    <a href="/modelos/nailsbar.php'.$url.'"><img src="/c/img/logos/nails-logo.png"></a>
                  </div>                  
                </div>
              </div>

              <div class="col-md-2 col-sm-6 grid-view-post item">
                <div class="item1 post">
                  <div class="box text-center">
                    <a href="/modelos/beautystore.php'.$url.'"><img src="/c/img/logos/beauty-logo.png"></a>
                  </div>                  
                </div>
              </div>

              <div class="col-md-2 col-sm-6 grid-view-post item">
                <div class="item1 post">
                  <div class="box text-center">
                    <a href="/modelos/barbershop.php'.$url.'"><img src="/c/img/logos/barber-logo.png"></a>
                  </div>                  
                </div>
              </div>

              <div class="col-md-2 col-sm-6 grid-view-post item">
                <div class="item1 post">
                  <div class="box text-center">
                    <a href="/modelos/eyebrows.php'.$url.'"><img src="/c/img/logos/eyebrows-logo.png"></a>
                  </div>                  
                </div>
              </div>

            </div>            
          </div>';
    return;
}

function showUbiDet($idsa, $paso){
  include '../library/libcon.php';
  if($paso == "1"){
    $sql = "SELECT nombrecompleto, concepto, direccion, telefono1, telefono2, latitud, longitud, regionsalon, instagram, url_img, url_img_thumb FROM web_salones WHERE id = '".$idsa."' LIMIT 1;";
    $result = (array) json_decode(miBusquedaSQL($sql), true);
    foreach ($result as $r) {
      $salon = '<br><br><div id="slide-portfolio" class="image-grid">
                    <div class="items-wrapper">
                      <ul class="isotope items">
                        <li class="item col-md-6 col-sm-6 marginbt10">
                          <figure class="icon-overlay"><img src="/c/img/salons/'.$r["url_img_thumb"].'" alt="" /></figure>
                          <div class="slide-portfolio-item-info box">
                            <h4 class="post-title">'.$r["nombrecompleto"].'</h4>
                            <div class="meta marginbt0">'.cambiarRegion($r["regionsalon"]).'</div>
                            <div class="meta marginbt0"><b>'. _("Teléfono") .':</b> '.$r["telefono1"].' / '.$r["telefono2"].'</div>
                            <div class="meta marginbt0"><b>'. _("Dirección") .':</b> '.$r["direccion"].'</div>
                            <a href="//www.instagram.com/'.$r["instagram"].'" target="_blank"><i class="fab fa-instagram"></i> @'.$r["instagram"].'</a>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>';
    }
    $final = $salon;
  } else {
    $final = _("No hay Resultados");
  }
  return $final;
}


function miBusquedaSQL($sql){

    $dbh = conex();
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
    mysqli_close($dbh);
    return json_encode($result);
}

function miActionSQL($sql){

    $dbh = conex();
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

function miActionSQL_LastId($sql){
    $dbh = conex();
    mysqli_set_charset($dbh, 'utf8');
    $resultado = array();
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        $resultado = 0;
        exit;
    }
    $textsql = $sql;
    if (mysqli_query($dbh, $textsql)) {
        $resultado[0] = 1;
        $resultado[1] = mysqli_insert_id($dbh);
    } else{
        $resultado[0] = "0;".mysqli_error($dbh);
        $resultado[1] = "";
    }

    mysqli_close($dbh);
    return $resultado;
}


function formatMiDate($date){
    if($date == ""){
        $datef = "";
    } else{
        $datei = date_create($date);
        $datef = date_format($datei,"d/m/Y");
    }

    return $datef;
}

function showRegDet($data, $paso){ /* PARA UBICACIONES, CUANDO HAGO CLICK EN REGION */
  include '../library/libcon.php';

    $sql = "SELECT id, nombrecompleto, concepto, direccion, telefono1, telefono2, latitud, longitud, regionsalon, instagram, url_img, url_img_thumb FROM web_salones WHERE REGIONSALON = '".$data."' AND ESTADO NOT IN (0, 3);";
    $result = (array) json_decode(miBusquedaSQL($sql), true);
    $salon = '';

    foreach ($result as $r) {
      $miniatura = $r["url_img_thumb"];

    if($miniatura == ""){
      $miniatura = "13thumb.jpg";
    }
    $salon .= '<li class="listP item col-md-4 col-sm-6 marginbt10">
              <figure class="icon-overlay"><a href="#0" data-type="slide-portfolio-item-1" data-sid="'.$r["id"].'" data-tipo="1"><img src="/c/img/salons/'.$miniatura.'" alt="" /></a></figure>
              <div class="slide-portfolio-item-info box">
                <h4 class="post-title">'.$r["nombrecompleto"].'</h4>
                 <div class="meta marginbt0"><b>'. _("Teléfono") .':</b> '.$r["telefono1"].' / '.$r["telefono2"].'</div>
                 <div class="meta marginbt0"><b>'. _("Dirección") .':</b> '.$r["direccion"].'</div>
                  <a href="//www.instagram.com/'.$r["instagram"].'" target="_blank" style="font-size: 14px;"><i class="fab fa-instagram"></i> @'.$r["instagram"].'</a>
                <div class="meta marginbt0">'.cambiarRegion($r["regionsalon"]).'</div>
              </div>
            </li>';
  }

      

  $pais = cambiarRegion($data);

    $dos = '<div class="dark-wrapper mb50" id="ubicaciones">
      <div class="container inner2">
        <h3 class="section-title text-center mt10">Ubicaciones</h3>
        <div class="divide30"></div>'.$salon.'
      </div>
    </div>';

  $msg = '<h2 class="fondobuscar">'.$pais.'</h2>
            <div class="col-md-12">
              <div class="col-md-6">
                  <h3>Listado de Salones:</h3>
              </div>
            </div>'.$dos;




  return $msg;
}

function showSalonesLista($regiones, $paso){

  $pais = cambiarRegion($regiones);
  $msg = '<h2 class="fondobuscar">'.$pais.'</h2>
            <div class="col-md-12">
              <div class="col-md-6">
                  <h3>Listado de Salones:</h3>
                  <img src="/c/img/lang/pty1.png">
                  <img src="/c/img/lang/domrep1.png">
              </div>
            </div>';

  return $msg;
}

function showFlag($idioma){
  switch ($idioma) {
    case 'es_VE':
      return '<img src="/c/img/lang/langes.png" width="25">';
      break;
    case 'en_US':
      return '<img src="/c/img/lang/langeng.png" width="25">';
      break;
    case 'it_IT':
      return '<img src="/c/img/lang/langit.png" width="25">';
      break;
    case 'fr_FR':
      return '<img src="/c/img/lang/langfr.png" width="25">';
      break;
    default:
      # code...
      break;
  }
}

function ratingSalon($idsalon, $calificacion, $campo){
  //include '../library/libcon.php';

  $sql = "SELECT id, votos, sumavotos FROM web_salones WHERE id = '".$idsalon."';";
  $result = (array) json_decode(miBusquedaSQL($sql), true);

  foreach ($result as $r) {
    $id = $r["id"];
    $newVotos = $r["votos"] + 1;
    $newSuma = $r["sumavotos"] + $calificacion;
    $newCalificacion = $newSuma/$newVotos;
  }

  if ($campo == 1) {
    return $newCalificacion;
  } else if ($campo == 2) {
      $sql = "UPDATE web_salones SET sumavotos = $newSuma, votos = $newVotos WHERE id = '$idsalon';";
      $result = miActionSQL($sql);

      return $result;
  }

}

function numStars($id, $votos, $sumavotos, $origen){

    if ($origen == 1) {

        if ($votos == 0) {
          $stars = '<i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><small> N/D</small>';
        } else {
          $calificacion = $sumavotos/$votos;
          $ctruncate = round($calificacion);
          $star = "";

          for ($i=0; $i < $ctruncate; $i++) { 
            $star .= '<i class="fa fa-star" style="color: red;"></i>';
          }

          $stars = '<h3>'.$star.' <small style="letter-spacing: 1.5px;"> '.$calificacion.'</small></h3>';
        }

    } else if ($origen == 2) {
      
        if ($votos == 0) {
          $stars = 0;
        } else {
          $calificacion = $sumavotos/$votos;          
          $stars = $calificacion;
        }

    }

  return $stars;

}

?>