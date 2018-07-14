<?php
	function consultapagos($salon){

    	require "libfunc.php";

    	$user = "JGutierrez";
  	$error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$user&funcion=ordenespago", $resulta);

    if ($error == ""){        
       // $manage  = $resulta; 
       //  regcuent($manage);
        // foreach ($manage as $recorrido) {
        //   $UNO = $recorrido["NOMBRECUENTA"]." Y ".$recorrido["MONTO"];
        // }

        $manage = (array) json_decode($resulta, true); 
          $arreglo=array();
          $i=0;
          foreach ($manage as $d) {
          $arreglo[$i] =  array(comprobarcampos($d['NOMBRECUENTA']),comprobarcampos($d['MONTO']),'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPago" data-tipo="banco" data-id="S11">Banco</button>',comprobarcampos($d['FECHAEJECUTADO']));//,comprobarcampos($d['MONTO']),comprobarcampos($d['BANCOCUENTA']),comprobarcampos($d['FECHAEJECUTADO
          $i++;              
                }
        $result= json_encode($arreglo);
        return $result;


    }
                    
                

    else{ 
        return "<b>Hubo un error al cargar los asociados activos:</b> " . $error;
    }




  /*  $arreglo=array
      (
      array("Salvador Galerias",'1.300.000Bs','Banco Venezuela 01024562021052489602','ESTATUS PENDIENTE'),
      array('Salvador Corporativo','3.400.000Bs', 'Banco Provincial 01084562021052489602', 'ESTATUS PENDIENTE')
      );

$result= json_encode($arreglo);

[{"ID":2,"FECHALIMITE":"2018-04-14","DOCUMENTOIDENTIDADCUENTA":"11783136","NOMBRECUENTA":"MARIANELA DEL VALLE PEDRIQUE RIVAS","NUMEROCUENTA":"01340587515873003779","BANCOCUENTA":"BANESCO","CONCEPTO":"PRESTAMO A CUENTA DE PLAN DE AHORRO","FECHAPROGRAMADO":"2018-04-07","FECHAEJECUTADO":null,"USUARIOPROGRAMADO":"ECOLMENARES","USUARIOEJECUTADO":null,"OBSERVACION":"","CODIGOSALON":"S10","TICKETRELACIONADO":54343}]*/



}

function comprobarcampos($data){
  if ($data=="null"||$data=="") {
    $data="0";
  } 
    return $data;

}


function regcuent($manage){
     $bc = substr($manage,179);
     $i=strpos($bc,",");
     $bc=substr($bc,0,$i-1);
     $nc=substr($manage,142,20);
     echo $bc." : ".$nc;

}

?>