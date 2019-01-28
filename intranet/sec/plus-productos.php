<?php

//error_log("Hubo un error!", 3, "../my-errors.log");

function loadProductosActuales($action, $marca, $lineas, $salon, $ruta){
    require_once "armarconsulta.php";
    require_once "libfunc.php";
    /*$desde1 = date_create($desde);
    $desde2 = date_format($desde1, 'm/d/Y');

    $hasta1 = date_create($hasta);
    $hasta2 = date_format($hasta1, 'm/d/Y');
    
    $filtros = $desde2.";".$hasta2;*/
    
    $resulta = ""; $result = array(); $i=0;
    $error = hacerpost("$ruta/apilivesalon.php?", "clavebd=salvasis1&consultas=".productosactuales($lineas), $resulta);
    if ($error == ""){
        $manage = (array) json_decode($resulta, true);

        foreach ($manage[0] as $key) {
            $result[$i] = array($key['CODIGO'], $key['DESCRIPCION'], $key['PRECIOSINIVA1'], $key['PRECIOSINIVA2'], $key['PRECIOVENTA1'], $key['PRECIOVENTA2'], $key['COSTOUNITARIO'], $key['ALICUOTACOMPRA'], $key['ALICUOTAVENTA'], $key['PORCUTILIDAD1'], $key['PORCUTILIDAD2'], $key['ESTATUS'], $key['TIPOVENTA'], $key['UTILIDADMINIMA'], $key['UTILIDADMAXIMA']);
            $i++;
        }

        return json_encode($result);
    }
    else{ 
        echo "<div class='alert alert-warning'>
                Hubo un error al cargar la información de los Productos.<br>Por favor, intenta de nuevo.
              </div>";
        return;
    }
}

function loadServiciosActuales($action, $salon, $ruta){
    require_once "armarconsulta.php";
    require_once "libfunc.php";

    $resulta = ""; $result = array(); $i=0;
    $error = hacerpost("$ruta/apilivesalon.php?", "clavebd=salvasis1&consultas=".serviciosactuales(), $resulta);
    if ($error == ""){
        $manage = (array) json_decode($resulta, true);


       /* $result=array
      (
      array("Salvador Galerias",'1.300.000Bs','Banco Venezuela 01024562021052489602','ESTATUS PENDIENTE', '5', '6'),
      array('Salvador Corporativo','3.400.000Bs', 'Banco Provincial 01084562021052489602', 'ESTATUS PENDIENTE', '5', '6'.$resulta)
      );*/


        foreach ($manage[0] as $key) {
            $codigo = $key['CODIGO'];
            $result[$i] = array("<span id='cod".$codigo."'><a href='javascript:0;' onclick='cargarContenidoPlus(0, \"S3\");'>".$codigo."</a></span>", "<span id='desc".$codigo."'><a href='javascript:0;' onclick='cargarContenidoPlus(0, \"S3\");'>".$key['DESCRIPCION']."</a></span>", "<span id='ps1".$codigo."'>".$key['PRECIOSINIVA1']."</span>", "<span id='ps2".$codigo."'>".$key['PRECIOSINIVA2']."</span>", "<span id='pv1".$codigo."'>".$key['PRECIOVENTA1']."</span>", "<span id='pv2".$codigo."'>".$key['PRECIOVENTA2']."</span>" . "<input type='hidden' name='acompra".$codigo."' value='".$key['ALICUOTACOMPRA']."'><input type='hidden' name='aventa".$codigo."' value='".$key['ALICUOTAVENTA']."'><input type='hidden' name='estad".$codigo."' value='".$key['ESTATUS']."'><input type='hidden' name='descont".$codigo."' value='".$key['DESCONTINUADO']."'>") ;
            $i++;
        }

        return json_encode($result);
    }
    else{ 
        echo "<div class='alert alert-warning'>
                Hubo un error al cargar la información de los Servicios.<br>Por favor, intenta de nuevo.
              </div>";
        return;
    }


}   


function loadProductosMarcas($action, $salon, $ruta){
	require_once "armarconsulta.php";
    require_once "libfunc.php";
    /*$desde1 = date_create($desde);
    $desde2 = date_format($desde1, 'm/d/Y');

    $hasta1 = date_create($hasta);
    $hasta2 = date_format($hasta1, 'm/d/Y');
    
    $filtros = $desde2.";".$hasta2;*/
    
    $resulta = "";
    $error = hacerpost("$ruta/apilivesalon.php?", "clavebd=salvasis1&consultas=".productosmarcas(), $resulta);
    if ($error == ""){
        $manage = (array) json_decode($resulta, true);
        return $manage;
    }
    else{ 
        echo "<div class='alert alert-warning'>
                Hubo un error al cargar la información.<br>Por favor, intenta de nuevo.
              </div>";
        return;
    }
}

function loadProductosLineas($action, $marcas, $salon, $ruta){
	require_once "armarconsulta.php";
    require_once "libfunc.php";
    /*$desde1 = date_create($desde);
    $desde2 = date_format($desde1, 'm/d/Y');

    $hasta1 = date_create($hasta);
    $hasta2 = date_format($hasta1, 'm/d/Y');
    
    $filtros = $desde2.";".$hasta2;*/
    

    $resulta = "";
    $error = hacerpost("$ruta/apilivesalon.php?", "clavebd=salvasis1&consultas=".productoslineas($marcas), $resulta);
    if ($error == ""){
        $manage = (array) json_decode($resulta, true);
        return $manage;
    }
    else{ 
        echo "<div class='alert alert-warning'>
                Hubo un error al cargar la información.<br>Por favor, intenta de nuevo.
              </div>";
        return;
    }
}

function populateselect($what, $data){
	//require_once "libfunc.php";

	switch ($what) {
		case 'marca':
			$select = '<select multiple="multiple" class="form-control" name="filtro1[]" id="filtro1">';
			$options = '';
			foreach ($data[0] as $marca) {
				$options .= '<option value="'.$marca["CODMARCA"].'">'.$marca["NOMMARCA"].'</option>';
			}
			$final = $select."".$options."</select>";

			break;
		case 'lineas':
			$select = '<select multiple="multiple" class="form-control" name="filtro2[]" id="filtro2">';
			$options = '';
			foreach ($data[0] as $linea) {
				$options .= '<option value="'.$linea["CODIGO"].'">'.$linea["NOMBRE"].'</option>';
			}
			$final = $select."".$options."</select>";

			break;
		default:
			# code...
			break;
	}

	return $final;
}

//<select multiple class="form-control" name="filtro2" id="filtro2"></select>
function armarTablaPlus($data){
    if($data == "1" || $data == 1){
        $filtros1 = '<div class="col-md-6 col-sm-12"><div class="row"><div class="form-group"><label for="filtro1">Selecciona la(s) Marca(s) que deseas consultar:</label> <span id="plusproductos-filtro1"></span></div>
                  <div class="center"></div><span id="plusproductos-filtro1-content">
                  <select multiple class="form-control" name="filtro1" id="filtro1">
                    <option>Aún no hay elementos disponibles...</option>
                  </select></span></div></div>';
        $filtros2 = '<div class="col-md-6 col-sm-12"><div class="row"><span id="plusproductos-filtro2"></span><button type="button" onclick="cargarContenidoPlus(0,3);" class="btn btn-default" style="margin-top:0px;">Consultar Líneas</button><span id="plusproductos-filtro2-content"></span>
                      </div></div>';
        /*$filtros3 = '<div class="col-md-12 col-sm-12"><div class="row"><div class="form-group"><label for="filtro3">¿Descontinuado?</label>&#32;&#32;&#32;<br>
                    <label class="radio-inline"><input type="radio" name="filtro3">Si</label>
                    <label class="radio-inline"><input type="radio" checked name="filtro3">No</label>
                    <label class="radio-inline"><input type="radio" name="filtro3">Ambas</label></div></div></div>';*/

        $tablatemp = '<div class="col-md-12 col-sm-12"><div class="form-group"><button type="button" class="btn btn-primary active" onclick="cargarContenidoPlus(0,4);">Consultar Productos</button><button type="button" class="btn btn-primary active" onclick="crearContenidoPlus(0,\'P\');">Agregar Productos</button></div></div>';
        
        //return $filtros1."".$filtros2."".$filtros3."".$tablatemp;
        return $filtros1."".$filtros2."".$tablatemp;

    } else if($data == "2" || $data == 2){
        $filtros1 = '<div class="col-md-12 col-sm-12"><div class="row">
                <span id="plusservicios-filtro1"></span>
                
                </div>';
        $tablatemp = '<div class="row"><span id="plusservicios-filtro1-content"><div class="form-group"><button type="button" class="btn btn-primary active" onclick="cargarContenidoPlus(0,\'S2\');">Consultar Servicios</button><button type="button" class="btn btn-primary active" onclick="crearContenidoPlus(0,\'S\');">Agregar Nuevo Servicio</button></div></span></div></div>';
        
        return $filtros1."".$tablatemp;
    }
	
}

function armarTablaPlus2($step){
    if($step == "1" || $step == 1){
    $option = "";
    $tablahead = '<div class="row">
        <div class="col-sm-12"><table id="productosplus" class="table table-bordered display responsive" style="width:100%">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>PrecioSinImp.1</th>
                <th>PrecioSinImp.2</th>
                <th>PrecioVenta1</th>
                <th>PrecioVenta2</th>
                <th>CostoUnitario</th>
            </tr>
        </thead>
        <tbody><tr><td colspan="6">Cargando resultados...</td></tr>';
    $tablafoot = '</tbody>
    <tfoot>
            <tr>
                <th>Código</th> 
                <th>Descripción</th>
                <th>PrecioSinImp.1</th>
                <th>PrecioSinImp.2</th>
                <th>PrecioVenta1</th>
                <th>PrecioVenta2</th>
                <th>CostoUnitario</th>
            </tr>
        </tfoot>
    </table><div></div>';

    $fin = $tablahead."".$tablafoot;
    return $fin;
    } else if($step == "2" || $step == 2){ // LOAD TABLA DE SERVICIOS
    $tablahead = '<div class="row">
        <div class="col-sm-12"><table id="serviciosplus" class="table table-bordered display responsive" style="width:100%">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>PrecioSinImp.1</th>
                <th>PrecioSinImp.2</th>
                <th>PrecioVenta1</th>
                <th>PrecioVenta2</th>
            </tr>
        </thead>
        <tbody><tr><td colspan="6">Cargando Servicios...</td></tr>';
    $tablafoot = '</tbody>
    <tfoot>
            <tr>
                <th>Código</th> 
                <th>Descripción</th>
                <th>PrecioSinImp.1</th>
                <th>PrecioSinImp.2</th>
                <th>PrecioVenta1</th>
                <th>PrecioVenta2</th>
            </tr>
        </tfoot>
    </table><div></div>';

    $fin = $tablahead."".$tablafoot;
    return $fin;

    }
}

function loadOperacionesEdit($lineas, $marcas, $datos, $action){
    switch ($action) {
        case 'plusproductedit':
        //var_dump($datos);
            echo loadTablaEdit($action);
            break;
        
        default:
            # code...
            break;
    }
}

function loadTablaEdit($action, $misc){
    if($action == "plusproductedit"){
            $tabla = '<div class="row">
            <div class="col-sm-12" id="tablelive"><table id="liveeditplus" class="table table-bordered display responsive" style="width:100%">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>PrecioVenta1</th>
                    <th>PrecioVenta2</th>
                    <th>PrecioSinImp.1</th>
                    <th>PrecioSinImp.2</th>
                </tr>
            </thead>
            <tbody>
                <tr><td colspan="6">Cargando...</td></tr>
            </tbody>
        <tfoot>
                <tr>
                    <th>Código</th> 
                    <th>Descripción</th>
                    <th>PrecioVenta1</th>
                    <th>PrecioVenta2</th>
                    <th>PrecioSinImp.1</th>
                    <th>PrecioSinImp.2</th>
                </tr>
            </tfoot>
        </table><div></div>';
        return $tabla;

    } else if($action == "plusproductedit2"){
        $content = "";
            $tabla = '<div class="row">
            <div class="col-sm-12" id="tablelive"><table id="liveeditplus" class="table table-bordered display responsive" style="width:100%">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Precio Sin Imp.1</th>
                    <th>Precio Sin Imp.2</th>
                    <th>Precio Venta1</th>
                    <th>Precio Venta2</th>                    
                    <th style="display:none;">Costo Unitario</th>
                    <th style="display:none;">Alic. Compra</th>
                    <th style="display:none;">Alic. Venta</th>
                    <th style="display:none;">Ut. P1</th>
                    <th style="display:none;">Ut. P2</th>
                    <th style="display:none;">Estado</th>
                    <th style="display:none;">Tipo Venta</th>
                    <th style="display:none;">Ut. Máxima</th>
                    <th style="display:none;">Ut. Mínima</th>
                </tr>
            </thead>
            <tbody>';

            $foot = '</tbody>
            <tfoot>
                <tr>
                    <th>Código</th> 
                    <th>Descripción</th>
                    <th>Precio Sin Imp.1</th>
                    <th>Precio Sin Imp.2</th>
                    <th>Precio Venta1</th>
                    <th>Precio Venta2</th>
                    <th style="display:none;">Costo Unitario</th>
                    <th style="display:none;">Alic. Compra</th>
                    <th style="display:none;">Alic. Venta</th>
                    <th style="display:none;">Ut. P1</th>
                    <th style="display:none;">Ut. P2</th>
                    <th style="display:none;">Estado</th>
                    <th style="display:none;">Tipo Venta</th>
                    <th style="display:none;">Ut. Máxima</th>
                    <th style="display:none;">Ut. Mínima</th>
                    </tr>
                </tfoot>
            </table><div></div><p></p>';
            foreach ($misc as $key) {
            $content .= "<tr><td><a data-toggle='modal' href='#miniprompt' data-search='".$key[0]."' data-type='p'>".$key[0]."</a></td><td id='desc".$key[0]."'><a data-toggle='modal' href='#miniprompt' data-search='".$key[0]."' data-type='p'>".$key[1]."</a></td><td id='psi1".$key[0]."'>".number_format($key[2], 2, '.', ',')."</td><td id='psi2".$key[0]."'>".number_format($key[3], 2, '.', ',')."</td><td id='pv1".$key[0]."'>".number_format($key[4], 2, '.', ',')."</td><td id='pv2".$key[0]."'>".number_format($key[5], 2, '.', ',')."</td><td id='cu".$key[0]."' style='display:none;'>".number_format($key[6], 2, '.', ',')."</td><td id='ac".$key[0]."' style='display:none;'>".$key[7]."</td><td id='av".$key[0]."' style='display:none;'>".$key[8]."</td><td id='upuno".$key[0]."' style='display:none;'>".$key[9]."</td><td id='updos".$key[0]."' style='display:none;'>".$key[10]."</td><td id='estatus".$key[0]."' style='display:none;'>".$key[11]."</td><td id='tpvnt".$key[0]."' style='display:none;'>".$key[12]."</td><td id='utmin".$key[0]."' style='display:none;'>".$key[13]."</td><td id='utmax".$key[0]."' style='display:none;'>".$key[14]."</td></tr>";
            /*$result[$i] = array($key['CODIGO'], $key['DESCRIPCION'], round($key['PRECIOVENTA1'],2), round($key['PRECIOVENTA2'],2), round($key['PRECIOSINIVA1'],2), round($key['PRECIOSINIVA2'],2));
            $i++;*/
        }
            return $tabla."".$content."".$foot;
        }
        
    }

function saveHistorialProductos($who, $datos, $usuario, $paso, $dataset){
    if($who == "p"){
        if($paso == "1"){
            require_once "libfunc.php";
            require_once "armarconsulta.php";

            $datos64 = base64_decode($dataset);
            $datosdec = (array) json_decode($datos64, true);
            $ruta = base64_decode($datosdec["route"]);

            /*saveProductEdit($datos, $usuario);*/

            $resulta = ""; $result = array(); $i=0;
            $error = hacerpost("$ruta/apilivesalon.php?", "clavebd=salvasis1&consultas=".saveProductEdit($datos, $usuario), $resulta);
            if ($error == ""){
                echo "1";
            }
            else{
                echo "<div class='alert alert-warning'>
                        Hubo un error al cargar la información de los Productos. Por favor, intenta de nuevo.<br>".$resulta." 
                      </div>";
                return;
            }
        } else if($paso == "2"){
            require_once "libfunc.php";
            require_once "armarconsulta.php";

            $datosdec = (array) json_decode($dataset, true);
            $ruta = base64_decode($datosdec["route"]);

            $resulta = ""; $result = array(); $i=0;
            $error = hacerpost("$ruta/apilivesalon.php?", "clavebd=salvasis1&consultas=".createProduct($datos, $usuario), $resulta);
            if ($error == ""){
                echo "1";
            }
            else{
                echo "<div class='alert alert-warning'>
                        Hubo un error al cargar la información del Servicio. Por favor, intenta de nuevo.<br>".$resulta." 
                      </div>";
                return;
            }
        }

    } else if($who == "s"){
        if($paso === "3"){  /*** CREAR SERVICIO NUEVO ***/
            require_once "libfunc.php";
            require_once "armarconsulta.php";

            $datosdec = (array) json_decode($dataset, true);
            $ruta = base64_decode($datosdec["route"]);

            $resulta = ""; $result = array(); $i=0;
            $error = hacerpost("$ruta/apilivesalon.php?", "clavebd=salvasis1&consultas=".createService($datos, $usuario), $resulta);
            if ($error == ""){
                echo "1";
            }
            else{
                echo "<div class='alert alert-warning'>
                        Hubo un error al cargar la información del Servicio. Por favor, intenta de nuevo.<br>".$resulta." 
                      </div>";
                return;
            }

        }
    }
}

function armarLiveEdit($data, $step){
    if($step == 1 && !empty($data)){
        $midata = array(); $i=0;
        $midata = (array) json_decode($data, true);
        //var_dump($midata);
        echo loadTablaEdit("plusproductedit2", $midata);
        return;
    }
}

function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }



?>