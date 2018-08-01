<script>
function editColumn(Id)
{
var params  = 'option=edit&Id=' + Id ;
var DivId = 'edit_' + Id;
ajax_function('ajax_edit.php', params, DivId);
}

function saveColumn(Id)
{
 var value = document.getElementById('salary_'+Id).value;
 var params     = 'option=save&value=' + value + '&Id' + Id ;
var DivId = 'edit_' + Id;
ajax_function('ajax_edit.php', params, DivId);
}
</script>
<link href="estilos.css" rel="stylesheet" type="text/css">
<?php
require_once('common.php');
?>
<table>
<tr>
    <th>Id</th>
    <th>Name</th>
    <th>Salary</th>
</tr>
<?php
foreach($EmployeeArray as $k=>$v)
{
$Id = $v['id'];
$Name = $v['name'];
$Salary = $v['salary'];
echo '
<tr>
    <td>'.$Id.'</td>
    <td>'.$Name.'</td>
    <td ondblclick="return editColumn(\''.$Id.'\');">
    <div id="edit_'.$Id.'">'.$Salary.'</div></td>
    </tr>
';  
}
?>

    </table>
    <table>
    <tr>
        <td contenteditable>I'm editable</td>
    </tr>
    <tr>
        <td>I'm not editable</td>
    </tr>
</table>

<form action="update.php" method="post">
  <strong>Your Message</strong>
<div contenteditable id="textArea"></div>
<input type="button" value="Save" id="saveBtn" />
</form>




<br><br><br><br><br>
<form action="http://url.pagina.destino" method="post">
2 <input type="hidden" name="variable1" value="valor1" />
3 <input type="hidden" name="variable2" value="valor2" />
4 <input type="text" value="" />
5 <input type="submit" value="Buscar" />
6 </form>

<div class="datagrid">
<table>
<tr><th width="20%">Nombre de Proyecto:</th><td>este ve</td></tr>
<td>
<tr>
<th width="10%">Estado:</th><td width="10%">este ve</td>
<th width="20%">Fecha de inicio:</th><td>000-00-00  </td>
</tr>
<tr>
<th width="10%">Categoría:</th><td width="10%">este ve</td>
<th width="20%">Región:</th><td>Vzla</td>
</tr>
<tr><th width="20%">Descripción del Proyecto:</th><td>este ve</td></tr>


</table>
</div>

  <div id="main">
<ul>
    <li><a href="#">Inicio</a></li>
    <li><a href="#">Sobre nosotros</a></li>
    <li><a href="#">Producto</a></li>
    <li><a href="#">Contacto</a></li>
</ul>

</div>