<?/* 
FUNCIONES ESPECIFICAS DE ESTA INSTALACION
---------------------------------------------------------
Solo para funciones que no esten creadas en funciones.php */

function iweb_guardar_data($tabla,$columnas,$campo){
    $sql = "insert into ".$tabla."(".$columnas.") values(".$campo.")";
    $dbh=dbconn();
    $rs = mysql_query($sql,$dbh) or die(mysql_error());
    return mysql_insert_id($dbh);
}

function iweb_cdata($tabla,$columnas="*",$wh="",$gby="",$ord=""){
    $sql = "select $columnas from $tabla";
	if ($wh<>"") 
	$sql .= " where ".$wh;
	if ($gby<>"") 
	$sql .= " group by ".$gby;
	if ($ord<>"") 
	$sql .= " order by ".$ord;
    $dbh=dbconn();
    $rs = mysql_query($sql,$dbh) or die(mysql_error());
    return $rs;
}
function ultimo(){
 $dbh=dbconn();
 return mysql_insert_id($dbh);
}
function iweb_datos($tabla,$campo="*",$condicion="",$orden="",$limite="")
{
  if(!$tabla)  return false;
  $sql = "select ".$campo." from ".$tabla. iif($condicion," where ".$codicion,""). iif($orden," order by ".$orden,"") . iif($limite," limit 0,".$limite,"");
  $dbh=dbconn();
  $rs = mysql_query($sql,$dbh);
  return $rs;  
  
  function is_date( $str )
{
  $stamp = strtotime( $str );
 
  if (!is_numeric($stamp))
  {
     return FALSE;
  }
  $month = date( 'm', $stamp );
  $day   = date( 'd', $stamp );
  $year  = date( 'Y', $stamp );
 
  if (checkdate($month, $day, $year))
  {
     return TRUE;
  }
 
  return FALSE;
} 
}


function buscar($arr,$cad){
$n=count($arr);
for ($i=0;$i<$n;$i++)
	if($arr[$i]==$cad)
	  return true;
return false;		
}

 function datecheck($input,$format=""){
        if ($input<>""){
		$separator_type= array(
            "/",
            "-",
            "."
        );
        foreach ($separator_type as $separator) {
            $find= stripos($input,$separator);
            if($find<>false){
                $separator_used= $separator;
            }
        }
        $input_array= explode($separator_used,$input);
        if ($format=="mdy") {

            return checkdate($input_array[0],$input_array[1],$input_array[2]);
        } elseif ($format=="ymd") {

            return checkdate($input_array[1],$input_array[2],$input_array[0]);
        } else {

            return checkdate($input_array[1],$input_array[0],$input_array[2]);
        }
        $input_array=array();
    }else 	return false;
} 

function ArrToCad($arr){
$n=count($arr);
$i=0;
$cad="";
	if (count($arr) >0){
		foreach($arr as $valor){
			$cad .= limpia($valor).iif($i<$n-1,",","");
			$i++;
		}
	}	
	return  $cad;
}

function StrToT($input,$format=""){
 if ($input<>""){
		$separator_type= array(
            "/",
            "-",
            "."
        );
        foreach ($separator_type as $separator) {
            $find= stripos($input,$separator);
            if($find<>false){
                $separator_used= $separator;
            }
        }
        $input_array= explode($separator_used,$input);
        if ($format=="mdy") {
            return strtotime($input_array[2]."-".$input_array[0]."-".$input_array[1]);
        } elseif ($format=="ymd") {
            return strtotime($input_array[0]."-".$input_array[1]."-".$input_array[2]);
        } else {
            return strtotime($input_array[2]."-".$input_array[1]."-".$input_array[0]);
        }
    $input_array=array();
    }else 	return date("Y-m-d");
}


function StrChange($str,$stre,$strc){
		$cad = $str;
		$pos = strpos($str,$stre);
		if($pos!== false){
			$cad = str_replace($stre,"",$cad);
			$cad .= $strc;
			return 	$cad;
		}
	return $cad;
}

function verificar($arr,$text,$campo){
$n=count($arr);
if ($n ==0)
 return true;
 
 for ($i=0;$i<$n;$i++)
	if($arr[$i]==$cad)
		if ($campo =="")
		   return true;
		   
return false;	


}

function ArrVacio($arr){
$c=0;
$n = count($arr);

for($i =0;$i<$n;$i++)
	if ($arr[$i]<>"")
	 $c++;	
return $c;
	 }

?>

