<?php

function listadoCXC($ruta, $paso){

    $_SESSION["tabla_completa"] = "1";

    $_SESSION["tabla_basica"] = "1";

    require_once "armarconsulta.php";

    

    list($idsalon,$rutasalon) = explode(";", $ruta);

    $rutabd = base64_decode($rutasalon);

    if($paso == 1){

        $resulta = "";

        $error = hacerpost("$rutabd/apilivesalon.php?", "clavebd=salvasis1&consultas=".deudatotal("C"), $resulta);

        if ($error == ""){
            $manage = (array) json_decode($resulta, true); 
            tablaCXC($manage);
            return;

        } else{

            echo "<div class='alert alert-warning'>

                    <strong>Advertencia:</strong> Sucedió un error interno.<br>$error

                  </div>";

            return;

        }

    } else if($paso == 2){

        $arrcod = $_POST["is"]; $arrcod2 = explode(',',$arrcod);
        $arrnom = $_POST["noms"]; $arrnom2 = explode(',',$arrnom);

       // echo "<br>";var_dump($arrcod2);echo "<br>"; var_dump($arrnom2);

        $resulta = "";
        $arr = array();
        $error = hacerpost("$rutabd/apilivesalon.php?", "clavebd=salvasis1&consultas=".movimientosdeudas($arrcod2, $arrnom2, "C"), $resulta);

        if ($error == ""){
            $manage = (array) json_decode($resulta, true); 

            tablaDetCXC($manage, $arrnom2, $rutasalon);
            return;
        } else{

            echo "<div class='alert alert-warning'>
                    <strong>Advertencia:</strong> Sucedió un error interno.<br>$error
                  </div>";

           //header("location: salon.php?oo=$error");
            return;
        }
    }
}

function tablaCXC($datos){

    //$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

    $opc = $_GET['o'];

    echo "<div class='text-center'><h2>Resumen General de <b>Cuentas Por Cobrar (CXC)</b>:</h2></div>";

    echo "<br><form name='ctcxc1' action='?o=$opc' method='POST'>

        <div class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>

        <table id='vt3' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%';><thead>";

    echo "<tr><th style='text-align:center;'>Código Cliente - <i class='glyphicon glyphicon-list-alt wow fadeInUp' data-wow-delay='0.2s' style='text-align:center;'></i></th>";

    $cabecera = array(1 => "Nombre",

            2 => "Cargos", 3 => "Pagos", 4 => "Saldo");

    

    foreach($cabecera as $cab){

            echo "<th>".$cab."</th>";

        }

        echo "</tr></thead>

              <tbody>";       

        foreach ($datos[0] as $linea){

                   echo "<tr>";                   

                   echo "<td style='text-align:center;'>".$linea['CODIGOCLIENTE']."</td>";

                   echo "<td>".$linea['NOMBRECLIENTE'] ."</td>";

                   echo "<td>".number_format((float)$linea['CARGOS'], 2, '.', ',')."</td>";

                   echo "<td>".number_format((float)$linea['PAGOS'], 2, '.', ',')."</td>";

                   echo "<td>".number_format((float)$linea['SALDO'], 2, '.', ',')."</td>";

                   echo "</tr>";

               }

    echo "</tbody>

          </table>

          </div>";

    echo "<span id='oculto'></span><div class='text-center'>

              <button type='submit' name='submcxc1' id='button-js' class='btn btn-default' style='margin-top: 0px;'>

                  <span class='pe-7s-right-arrow  pe-5x pe-va wow fadeInUp'></span> Consultar Selección(es)

            </button></div></form>";

    return ;

}



function tablaDetCXC($datos, $arrnom2, $ruta){
    echo "<div class='text-center'><h2>Resumen Detallado de <b>Cuentas Por Cobrar (CXC)</b>:</h2></div>";
    echo "<br><div class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>";
    echo "<input type = 'hidden' id = 'cxxdet'>";
    //var_dump($datos); var_dump($arrnom2);
    echo "<table id='vt3' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%';>";
    echo "<thead><tr>";

    $cabecera = array(1 => "CORRELATIVO", 2 => "NOMBRE", 3 => "DOCUMENTO", 4 => "TIPODOCUMENTO   ", 5 => "FECHAINGRESO", 6 => "MONTOTOTAL", 7 => "MONTOCANCELADO", 
      8 => "SALDO");

    foreach($cabecera as $cab){
            echo "<th>".$cab."</th>";
        }
        echo "</tr></thead><tbody>";
        foreach ($datos as $items){
              foreach ($items as $linea)  {
                    $tipodoc = $linea['TIPODOCUMENTO'];


                      echo "<tr>";                   
                      echo "<td style='text-align:center;'>".$linea['CORRELATIVO']."</td>";
                      echo "<td>".$linea['NOMBRECLIENTE']."</td>";
                      if($tipodoc === "FAC"){
                        echo "<td><span style='vertical-align: middle;'><a href='#facturacxc' data-toggle='modal' data-id='' data-whatever='".$linea['DOCUMENTO']."' data-whatevertu='".$tipodoc."' data-whatevertri='".$ruta."'><i class='pe-7s-expand1 pe-5x pe-va' style='visibility: visible;font-size: 20px;vertical-align: bottom;'></i> - ".$linea['DOCUMENTO'] ."</a></span></td>";
                      } else {
                        echo "<td><span style='vertical-align: middle;'>".$linea['DOCUMENTO'] ."</span></td>";
                      }
                      
                      echo "<td>".$tipodoc ."</td>";
                      echo "<td>".$linea['FECHAINGRESO'] ."</td>";
                      echo "<td>".number_format((float)$linea['MONTOTOTAL'], 2, '.', ',')."</td>";
                      echo "<td>".number_format((float)$linea['MONTOCANCELADO'], 2, '.', ',')."</td>";
                      echo "<td>".number_format((float)$linea['SALDO'], 2, '.', ',')."</td>";
                      echo "</tr>";
              }
        }

    echo "</tbody></table></div>";
    echo "<div class='col-sm-6 feat-list'>
              <button type='button' name='return' class='btn btn-default'>
                  <a href='javascript:history.go(-1)' id='backbtn'><span class='pe-7s-left-arrow  pe-5x pe-va wow fadeInUp' style='font-size: 17px;font-weight: bold;'></span> Regresar</a>
            </button>
        </div>";
       modalCXC(); 
    return;
}

function listadoCXP($ruta, $paso){

    $_SESSION["tabla_completa"] = "1";

    $_SESSION["tabla_basica"] = "1";

    require_once "armarconsulta.php";

    

    list($idsalon,$rutasalon) = explode(";", $ruta);

    $rutabd = base64_decode($rutasalon);



    if($paso == 1){

        $resulta = "";

        $error = hacerpost("$rutabd/apilivesalon.php?", "clavebd=salvasis1&consultas=".deudatotal("P"), $resulta);

        if ($error == ""){



            $manage = (array) json_decode($resulta, true); 

            tablaCXP($manage);

            return;

        } else{

            echo "<div class='alert alert-warning'>

                    <strong>Advertencia:</strong> Sucedió un error interno.<br>$error

                  </div>";

            return;

        }        

    }  else if($paso == 2){

        $arrcod = $_POST["is"]; $arrcod2 = explode(',',$arrcod);

        $arrnom = $_POST["noms"]; $arrnom2 = explode(',',$arrnom);

        $arrdiv = $_POST["divs"]; $arrdivs = explode(',',$arrdiv);

        $resulta = "";        
        $error = hacerpost("$rutabd/apilivesalon.php?", "clavebd=salvasis1&consultas=".movimientosdeudas($arrcod2, $arrdivs, "P"), $resulta);

        if ($error == ""){

            $manage = (array) json_decode($resulta, true);             
            tablaDetCXP($manage);

            return;

        } else{

            echo "<div class='alert alert-warning'>

                    <strong>Advertencia:</strong> Sucedió un error interno.<br>$error

                  </div>";

            return;

        }

    }  

}



function tablaCXP($datos){

    $opc = $_GET['o'];

    echo "<div class='text-center'><h2>Resumen General de <b>Cuentas Por Pagar (CXP)</b>:</h2></div>";

    echo "<br><form name='ctcxp1' action='?o=$opc' method='POST'>

        <div class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>

        <table id='vt3' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%';><thead>";

    echo "<tr><th style='text-align:center;'>Código Proveedor - <i class='glyphicon glyphicon-list-alt wow fadeInUp' data-wow-delay='0.2s' style='text-align:center;'></i></th>";

    $cabecera = array(1 => "Razón Social", 2=>"Id Div", 3 => "División",

            4 => "Cargos", 5 => "Pagos", 6 => "Saldo");

    

    foreach($cabecera as $cab){

            echo "<th>".$cab."</th>";            

        }

        echo "</tr></thead>

              <tbody>";       
      
        $idx = 0; 
        foreach ($datos[0] as $linea){

                   echo "<tr>";                   

                   echo "<td style='text-align:center;'>".$linea['CODIGOPROVEEDOR']."</td>";

                   echo "<td>".$linea['NOMBREPROVEEDOR'] ."</td>";
                   echo "<td>".$linea['DIVISIONPROVEEDOR'] ."</td>";
                   echo "<td>".$linea['NOMBREDIVISION'] ."</td>";

                   echo "<td>".number_format((float)$linea['CARGOS'], 2, '.', ',')."</td>";

                   echo "<td>".number_format((float)$linea['PAGOS'], 2, '.', ',')."</td>";

                   echo "<td>".number_format((float)$linea['SALDO'], 2, '.', ',')."</td>";

                   echo "</tr>";                   
                   $idx++; 
               }

    echo "</tbody>

          </table>

          </div>";
    echo "<input type = 'hidden' id = 'cxp'>";
    echo "<span id='oculto'></span><div class='text-center'>

              <button type='submit' name='submcxp1' id='button-js' onclick='return PreSubmit(this.form);' class='btn btn-default' style='margin-top: 0px;'>

                  <span class='pe-7s-right-arrow  pe-5x pe-va wow fadeInUp'></span> Consultar Selección(es)

            </button></div>";

    return ;

}



function tablaDetCXP($datos){

    echo "<input type = 'hidden' id = 'cxxdet'>";
    echo "<div class='text-center'><h2>Resumen Detallado de <b>Cuentas Por Pagar (CXP)</b>:</h2></div>";

    echo "<br><div class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>        
        <table id='vt3' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%';><thead>";

    echo "<tr>";


    $cabecera = array(1 => "CORRELATIVO", 2 => "PROVEEDOR",

            3 => "DOCUMENTO", 4 => "TIPODOCUMENTO   ", 5 => "FECHAINGRESO", 6 => "MONTOTOTAL", 7 => "MONTOCANCELADO", 8 => "SALDO");

    

    foreach($cabecera as $cab){

            echo "<th>".$cab."</th>";

        }

        echo "</tr></thead>

              <tbody>";       
        foreach ($datos as $item ) 
        foreach ($item as $linea){

                   echo "<tr>";                                      
                   echo "<td style='text-align:center;'>".$linea['CORRELATIVO']."</td>";                   
                   echo "<td>".$linea['NOMBREPROVEEDOR']."</td>";                   
                   echo "<td>".$linea['DOCUMENTO'] ."</td>";

                   echo "<td>".$linea['TIPODOCUMENTO'] ."</td>";

                   echo "<td>".$linea['FECHAINGRESO'] ."</td>";

                   echo "<td>".number_format((float)$linea['MONTOTOTAL'], 2, '.', ',')."</td>";

                   echo "<td>".number_format((float)$linea['MONTOCANCELADO'], 2, '.', ',')."</td>";

                   echo "<td>".number_format((float)$linea['SALDO'], 2, '.', ',')."</td>";

                   echo "</tr>";

               }

    echo "</tbody>

          </table>

          </div>";

    echo "<div class='col-sm-6 feat-list'>

              <button type='button' name='return' class='btn btn-default'>

                  <a href='javascript:history.go(-1)' id='backbtn'><span class='pe-7s-left-arrow  pe-5x pe-va wow fadeInUp' style='font-size: 17px;font-weight: bold;'></span> Regresar</a>

            </button>

        </div>";

    return ;

}

function modalCXC(){
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/livectax.php";
        echo "
        <div id='facturacxc' class='modal fade' role='dialog'>
            <div class='modal-dialog  modal-lg'>

                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                        <h4 class='modal-title'><b>". $_SESSION["datossalon"]["NOMBREEMPRESA"] ."</b></h4>
                    </div>
                    <div class='modal-body'>";
                        echo $trrif.": ".$_SESSION["datossalon"]["RIF"]."<br>";
                        echo $trtelf1.": ".$_SESSION["datossalon"]["TELEFONO"]."<br>";
                        echo "

                        <input type='hidden' class='form-control' id='recipient-name'>
                        <span id='texto'></span>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                    </div>
                </div>
            </div>
        </div>";
}
?>