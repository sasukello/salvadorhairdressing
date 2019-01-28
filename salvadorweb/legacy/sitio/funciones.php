<?/*
---------------------------------
INTEGRACION SITIO-EQFRAMEWORK:
---------------------------------
Leonardo Castro A.
Exceed Quality de Venezuela, S.A.
info@eqs.com.ve
--------------------------------- */
//---------------------------------------------------------------------------------------------------------------------------------------------------
// AGREGANDO FUNCIONES DEL FRAMEWORK NECESARIAS
//---------------------------------------------------------------------------------------------------------------------------------------------------
include("../iweb/config/config.php");
include($_SESSION["EQ_frwkURL"]."config/funciones.php");


if (!isset($_SESSION['EQ_moneda'])) $_SESSION['EQ_moneda']=getmoneda();
if (!isset($_SESSION['EQ_impuesto'])) $_SESSION['EQ_impuesto']=getiva();

/* GENERA UNA MATRIZ CON LOS VALORES DE UN SELECT QUERY
   Los elementos de la matriz utilizan el nombre de los campos en la tabla a consultar. La funcion devuelve una matriz.
   P.Ej. Los datos de la tabla usuario(id,nombre,clave) se leen: matriz['id'], matriz['nombre'], matriz['clave']
   Parametros: $db = nombre de la tabla
               $fd = campo(s) a consultar (por defecto *)
               $cnd= condicion de la consulta
               $ord= orden 
   Ejemplo: <?php
            $atabla=sitio_data("inventario","id,nombre");
            foreach($atabla as $acampo){ echo "Producto: ".encode($acampo["nombre"])."<br/>";} ?>
*/
function sitio_data($db="",$fd="*",$cnd="",$ord=""){
   if ($db=="") return false;
   $aretorno=array();
   $afieldn=array();
   $xtabsufix=0;
   if (!strpos($fd,".")===false) $xtabsufix=1;
   $afieldm=split(",",",".$fd);
   $atablem=split(",",",".$db);
   $dbh=dbconn();
   foreach($atablem as $xtabla){
      if ($xtabla<>""){
         $ressf_x=mysql_query(mysql_real_escape_string(stripslashes("describe ".$xtabla)),$dbh);
         while($rowsf_x=mysql_fetch_array($ressf_x)){ 
            $gopush=0;
            if ($fd<>"*"){
               if (!array_search(iif($xtabsufix==1,$xtabla.".","").$rowsf_x['Field'],$afieldm)===false) $gopush=1;
	        }
	        else $gopush=1;
	        if ($gopush==1) array_push($afieldn,$rowsf_x['Field']);
		 }
	  }
   }
   $ressf=mysql_query("select ".$fd." from ".$db.iif($cnd<>""," where ".$cnd,"").iif($ord<>""," order by ".$ord,""),$dbh);
   while($rowsf=mysql_fetch_array($ressf)){ 
      $xfd="";
      for($x=0;$x<mysql_num_fields($ressf);$x++){
	     $xfd.=",".$afieldn[$x]."=>'".$rowsf[$afieldn[$x]]."'";
	  }
	  eval("array_push("."$"."aretorno,array(".substr($xfd,1)."));");
   }
   return $aretorno;
}

// crear todas las combinaciones de un valor
/*function permuta($items,$perms=array()) {
   static $amatrizcombinaciones;
   if (empty($items)) $amatrizcombinaciones[]=$perms;
   else {
      for($i=count($items)-1;$i>=0;--$i){
         $newitems=$items;
         $newperms=$perms;
         list($foo)=array_splice($newitems,$i,1);
         array_unshift($newperms,$foo);
         permuta($newitems,$newperms);
      }
      return $amatrizcombinaciones;
   }
}*/

// Loguea a un usuario
function sitio_logueo($usuario,$clave) {
   $usuario=limpia($usuario);
   $clave=limpia($clave);
   if ($usuario<>"" and $clave<>"") {
      $result=sitio_confirmUser($usuario,$clave);
      if ($result==0) {
         $dbh=dbconn();
         $res=mysql_query("select * from clientes where login='".$usuario."' and clave='".$clave."'",$dbh);
         if ($row = mysql_fetch_array($res)) {
		    @setcookie("AVASITE1",$usuario,time()+86400,"/");
            @setcookie("AVASITE2",$clave,time()+86400,"/");
            $_SESSION['sitio_user_token']=createRandomNumber(6);
            $_SESSION['sitio_clave']=$clave;
            $_SESSION['sitio_username1']=$usuario;
            $_SESSION['sitio_logged_in']=true;
            $_SESSION['sitio_user_name']=encode($row["nombre"]);
            $_SESSION['sitio_user_id']=$row["id"];
		    $_SESSION['sitio_user_email']=$row["email"];
            $_SESSION['sitio_user_lastlog']=$row["lastlog"];
         }
		 $reso=mysql_query("update clientes set lastlog=now() where id='".$_SESSION['sitio_user_id']."'",$dbh);
         echo "<meta http-equiv='Refresh' content='0;url=index.php'></head></html>";	   
         exit;	   
	  }
	  else {
	     $_SESSION['sitio_logged_in']=false;
         echo "<meta http-equiv='Refresh' content='0;url=login.php?error=2,1'></head></html>";	   
         exit;	   
	  }
   }
   else {
      $_SESSION['sitio_logged_in']=false;
      echo "<meta http-equiv='Refresh' content='0;url=login.php?error=1,2'></head></html>";	   
      exit;	   
   }
}  

// Confirma los datos del usuario
function sitio_confirmUser($username,$password){
   $xconu=5;
   $dbh=dbconn(); 
   $result=mysql_query("select login,clave from clientes where login='".$username."'",$dbh);
   if(mysql_num_rows($result)<1) $xconu=1; //MAL
   else {
      if ($dbarray=mysql_fetch_array($result)) {
         if ($password==$dbarray['clave']) $xconu=0; //BIEN
		 else $xconu=2; //MAL
      }
   }
   return $xconu; 
}

// Verifica que el usuario este logueado
function sitio_checkLogin(){
   if (isset($_COOKIE['AVASITE1']) and isset($_COOKIE['AVASITE2'])) {
      $_SESSION['sitio_username1']=$_COOKIE['AVASITE1'];
      $_SESSION['sitio_clave']=$_COOKIE['AVASITE2'];
   }
   if (isset($_SESSION['sitio_username1']) and isset($_SESSION['sitio_clave'])) {
      if (sitio_confirmUser($_SESSION['sitio_username1'],$_SESSION['sitio_clave'])>=1) {
         @setcookie("AVASITE1","",time()-(60*60*24*100),"/");
         @setcookie("AVASITE2","",time()-(60*60*24*100),"/");
         unset($_SESSION['sitio_username1']);
         unset($_SESSION['sitio_clave']);
         unset($_SESSION['sitio_user_id']);
         unset($_SESSION['sitio_user_lastlog']);
         unset($_SESSION['sitio_user_name']);
		 unset($_SESSION['sitio_user_email']);
	     unset($_SESSION['sitio_user_token']);
         $_SESSION['sitio_logged_in']=false;
         return false;
      }
	  $_SESSION['sitio_logged_in']=true;
      return true;
   }
   else {
      $_SESSION['sitio_logged_in']=false;   
      return false;
   }
}
//---------------------------------------------------------------------------------------------------------------------------------------------------
// FUNCIONES DEL SITIO
//---------------------------------------------------------------------------------------------------------------------------------------------------
include("iweb.php"); // incluye las funciones propias de la instalacion

// Obtiene una o varias categorias
function iweb_getcategorias($xid="",$pdr=""){
   $xcond="";
   if($xid<>"") $xcond.=" and id='".$xid."'";
   if($pdr<>"") $xcond.=" and padre='".$pdr."'";
   $xcond=substr($xcond,5);
   $acategoria=sitio_data("categorias","*",$xcond);
   return $acategoria;
}

// Obtiene uno o todos los clientes
function iweb_getclientes($xid=""){
   $xcond="";
   if($xid<>"") $xcond.=" and id='".$xid."'";
   $xcond=substr($xcond,5);
   $acliente=sitio_data("clientes","*",$xcond);
   return $acliente;
}

// Obtiene una encuesta
// mostrar=1 pregunta
// mostrar=2 pregunta y resultados
function iweb_getencuestas($xid="",$mostrar=1){
   if ($xid=="") return false;
   $flds="*";
   if ($mostrar==1) $flds="id,fecha,titulo,opciones";
   $aencuesta=sitio_data("encuestas",$flds,"id='".$xid."'");
   if ($mostrar==2){
      $aencuesta_tmp=array();
      if (is_array($aencuesta)) {
         foreach($aproducto as $productomatriz){
            $avalores=split("\|",$productomatriz["valores"]);
            foreach($avalores as $valor){
               if (array_search($valor,$amatriz_tmp)===false){
                  list($cate,$val)=split(":",$valor);
                  array_push($amatriz_tmp,array("indice"=>$cate,"valor"=>$val));
               }
            }
         }
      }
      $aencuesta=$aencuesta_tmp;
   }
   return $aencuesta;
}

// Obtiene las noticias
function iweb_getnoticias($xid=""){
   $xcond="";
   if($xid<>"") $xcond.=" and id='".$xid."'";
   $xcond=substr($xcond,5);
   $anoticia=sitio_data("iweb_noticias","*",$xcond,"id desc");
   return $anoticia;
}

?>