<?php

// pone las noticias
//-------------------------------------------
$anoticias=iweb_getnoticias();
if (is_array($anoticias)){
   foreach($anoticias as $noticia){?>
      <div>
          <b><?=encode($noticia["titulo"]);?><br/></b>
		  <?=getfecha2($noticia["fecha"]);?><br/>
		  <?=substr(encode($noticia["texto"]),0,120)."...";?>
      </div>
 <?}
}
//-------------------------------------------


// inserta informacion de contacto
//-------------------------------------------
$contacto_nombre=limpia("mi nombre");   // se reemplazan estos valores con las variables post del formulario
$contacto_empresa=limpia("mi empresa");
$contacto_texto=limpia("texto de prueba");

$dbh=dbconn();
$rsq=mysql_query("insert into contactos (fecha,nombre,empresa,texto) values (now(),'".$contacto_nombre"','".$contacto_empresa."','".$contacto_texto."')",$dbh);
$nume=mysql_insert_id($dbh);
echo $nume;
//-------------------------------------------


// obtiene la informacion del contacto
//-------------------------------------------
$dbh=dbconn();
$rsq2=mysql_query("select fecha,nombre,empresa,texto from contactos order by fecha",$dbh);
while($rwq2=mysql_fetch_array($rsq2)){?>
      <div>
		  Fecha: <?=getfecha2($rwq2["fecha"]);?><br/>
		  Nombre: <?=encode($rwq2["nombre"]);?><br/>
		  Empresa: <?=encode($rwq2["empresa"]);?>
		  Mensaje: <?=encode($rwq2["mensaje"]);?>
      </div>
<?}
//-------------------------------------------



?>