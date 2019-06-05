<?php
function loadNewsIndex(){
	include 'libcon.php';
	//include 'funciones.php';
	
	$result = array();
	$sql = "SELECT * FROM web_novedades ORDER BY (id) DESC LIMIT 5;";
	$result = (array) json_decode(miBusquedaSQL($sql), true);

	foreach ($result as $r) {
		echo '<div class="item post">
            <figure class="main"><img src="'.$r["imagen_thumb"].'" alt="" /></figure>
            <div class="box text-center">
              <div class="category cat16"><span><a href="#novedades">'.$r["categoria"].'</a></span></div>
              <h4 class="post-title"><a href="#novedades" style="color: #e32028;"><br>'.$r["titulo"].'</a></h4>
              <div class="meta"><span class="date">'.formatMiDate($r["fecha"]).'</span></div>
              <p>'.$r["descripcion"].'</p>
            </div>            
          </div>';
	}
	return;
}
?>