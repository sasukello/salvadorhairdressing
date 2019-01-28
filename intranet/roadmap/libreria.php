<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['valider'])) {
        
        $nombrepr = strtolower($_POST['nombrepr']);
        $regionpr = strtolower($_POST['regionpr']);
        $categoriapr = $_POST['categoriapr'];
        $responsable = $_POST['responsable'];
        $fechacierre = $_POST['fechacierre'];
        $descripcion = ucfirst($_POST['descripcion']);
        $user = ($_POST['user']);
       	$proyectonuevo = crearproyecto($nombrepr, $regionpr, $categoriapr, $responsable, $fechacierre, $descripcion, $user);
       if ($proyectonuevo==1){
       		header('Location: index.php?e=1');
      } else {
       		header('Location: index.php?e=0'); 
        }

    
      }
      // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    else if (isset($_POST['modificar'])) {
        $idp = $_POST['idp'];
        $nombrenuevo = strtolower($_POST['nombrenuevo']);
        $categorianueva = $_POST['categorianueva'];
        $regionnueva = $_POST['regionnueva'];
        $descripcionnueva = ucfirst($_POST['descripcionnueva']);
        $proyectomodificado = editarproyecto($idp, $nombrenuevo, $categorianueva, $regionnueva, $descripcionnueva);
        if ($proyectomodificado==1){
          header('Location: index.php?e=1');
      } else {
          header('Location: index.php?e=0'); 
        }
        
}
    else if (isset($_POST['nuevaCategoria'])) {
        $idp = $_POST['idp'];
        $nombrenuevo = strtolower($_POST['nombrenuevo']);
        $categorianueva = $_POST['categorianueva'];
        $regionnueva = $_POST['regionnueva'];
        $descripcionnueva = ucfirst($_POST['descripcionnueva']);
        $proyectomodificado = editarproyecto($idp, $nombrenuevo, $categorianueva, $regionnueva, $descripcionnueva);
        if ($proyectomodificado==1){
          header('Location: index.php?e=1');
      } else {
          header('Location: index.php?e=0'); 
        }
        
}


       else if (isset($_POST['action'])) {
          switch ($_POST['action']) {
            case 'cargarP':
              $idpr = $_POST['datos'];
              $projectOpen = verproyecto($idpr);
              echo($projectOpen);
              break;
            case 'agregarMinuta':
                $nombreminuta = $_POST['datos'];
                $idactividad = $_POST['idac'];
                $agregarMinuta = crearMinuta($nombreminuta, $idactividad);
                echo $agregarMinuta;
                break;
            case 'agregarActividad':
              $actividadnueva = $_POST['datos'];
              $categoriaActividad = $_POST['catacti'];
              $proyectoActividad = $_POST['idpr'];
              $agregarAct = crearActividad($actividadnueva, $categoriaActividad, $proyectoActividad);
              echo $agregarAct;
              break;
            case 'eliminarActividad':
              $idactiv = $_POST['id'];
              $eliminateACti  = eliminarActividad($idactiv);
              echo $eliminateACti;
              break;
            case 'eliminarMinuta':
              $idminut = $_POST['id'];
              $eliminateMinut  = eliminarMinuta($idminut);
              echo $eliminateMinut;
              break;
            case 'editarActividad':
              $idactiv = $_POST['id'];
              $nuevonombre = $_POST['nuevonombre'];
              $modificarActivi = modificarActividad($idactiv, $nuevonombre);
              echo $modificarActivi;
              break;
            case 'editarMinuta':
              $idmin = $_POST['id'];
              $nuevonombre = $_POST['nuevonombre'];
              $modificarMinut = modificarMinuta($idmin, $nuevonombre);
              echo $modificarMinut;
              break;
            case 'cambiarStatus':
              $idminuta= $_POST['datos'];
              $change = modificarStatus($idminuta);
              echo $change;
              break;
              case 'crearCategoria':
              $nombrecateg = $_POST['nuevacategoria'];
              $crearcategoria = crearCategoria($nombrecateg);
              echo $crearcategoria;
              break;

          }
        }
       
  }

function crearproyecto($nombrepr, $regionpr, $categoriapr, $responsable, $fechacierre, $descripcion, $user)
				{
					include "../cms/library/common.php";
					$sql = "INSERT INTO intranet_roadmap(nombrepr, regionpr, categoriapr, descripcion, fechaest, fechapr) VALUES ('$nombrepr', $regionpr, $categoriapr, '$descripcion','$fechacierre', NOW())";
					$busqueda = miActionSQL($sql);
					if ($busqueda==1){
            $last_id = "SELECT MAX(idpr) AS id FROM intranet_roadmap";
            $ultimo_id = json_decode(miBusquedaSQL($last_id), true, 512, JSON_UNESCAPED_UNICODE);
            $id = $ultimo_id[0]['id'];
            $sql3 = "INSERT INTO intranet_roadmap_users (prid, userid) VALUES ($id, '$user')";
            $busqueda3 = miActionSQL($sql3);
					$mensaje=1;
					} else {
						$mensaje= $busqueda;

					}
				return $mensaje;
				}
function crearActividad($actividadnueva, $categoriaActividad, $proyectoActividad){
          include "../cms/library/common.php";
          $sql3 = "INSERT INTO intranet_roadmap_actividades(value1, valuecateg, valuepr, Status) VALUES ('$actividadnueva', $categoriaActividad, '$proyectoActividad', 0)";
          $busqueda3 = miActionSQL($sql3);
          if ($busqueda3==1){
            $last_id = "SELECT MAX(id) AS id FROM intranet_roadmap_actividades";
            $ultimo_id = json_decode(miBusquedaSQL($last_id), true, 512, JSON_UNESCAPED_UNICODE);
            $id = $ultimo_id[0]['id'];
              

      //       $sql='SELECT value1 FROM intranet_roadmap_actividades WHERE id = '.$id.'';
      // $consulta=json_decode(miBusquedaSQL($sql), true, 512, JSON_UNESCAPED_UNICODE);
      // $titulo = $consulta[0]['value1'];
      // return $titulo;


            } else {
                $id = 0;

            }
            
           
  return $id;
}
function crearCategoria($nombrecateg)
        {
          include "../cms/library/common.php";
          $sql5 = "INSERT INTO intranet_roadmap_categorias(nombre) VALUES ('$nombrecateg')";
          $busqueda5 = miActionSQL($sql5);
          if ($busqueda5==1){
          $mensaje5=1;
          } else {
            $mensaje5= $busqueda5;

          }
        return $mensaje5;
        }
function eliminarActividad($id){
  include "../cms/library/common.php";
  $sql = "DELETE FROM intranet_roadmap_actividades WHERE id = $id";
  $busqueda = miActionSQL($sql);
  if ($busqueda==1){
          $mensaje=1;
          } else {
            $mensaje= $busqueda;

          }
        return $mensaje;
         
}
function eliminarMinuta($id){
  include "../cms/library/common.php";
  $sql = "DELETE FROM intranet_roadmap_minutas WHERE id = $id";
  $busqueda = miActionSQL($sql);
  if ($busqueda==1){
          $mensaje=1;
          } else {
            $mensaje= $busqueda;

          }
        return $mensaje;
         
}
function modificarActividad($idactiv, $nuevonombre){
  include "../cms/library/common.php";
  $sql = "UPDATE intranet_roadmap_actividades SET value1 = '$nuevonombre' WHERE id = $idactiv";
  $busqueda = miActionSQL($sql);
  if ($busqueda==1){
          $mensaje=1;
          } else {
            $mensaje= $busqueda;

          }
        return $mensaje;
}
function crearMinuta($nombreminuta, $idpadre)
        {
          include "../cms/library/common.php";
          $sql4 = "INSERT INTO intranet_roadmap_minutas(descripcion, actipadre_id, fechacreada) VALUES ('$nombreminuta', $idpadre, NOW())";
          $busqueda4 = miActionSQL($sql4);
          if ($busqueda4==1){
          $mensaje4=1;
          } else {
            $mensaje4= $busqueda4;

          }

        return $mensaje4;
        }
function modificarMinuta($idminut, $nuevonombre){
  include "../cms/library/common.php";
  $sql = "UPDATE intranet_roadmap_minutas SET descripcion = '$nuevonombre' WHERE id = $idminut";
  $busqueda = miActionSQL($sql);
  if ($busqueda==1){
          $mensaje=1;
          } else {
            $mensaje= $busqueda;

          }
        return $mensaje;
}
function modificarStatus($idminuta){
  include "../cms/library/common.php";
  $miconsulta = "SELECT estado FROM intranet_roadmap_minutas WHERE id = $idminuta";
  $valorstatus = miBusquedaSQL($miconsulta);
  $valorestado = (array) json_decode($valorstatus, true);
  if ($valorestado[0]['estado']==0) {
    $sql = "UPDATE intranet_roadmap_minutas SET estado = 1 WHERE id = $idminuta";
  $busqueda = miActionSQL($sql);
                  if ($busqueda==1){
                          $mensaje=1;
                          } else {
                            $mensaje= $busqueda;

                          }
                        return $mensaje;
    
  } else if ($valorestado[0]['estado']==1) {
   
    $sql = "UPDATE intranet_roadmap_minutas SET estado = 0 WHERE id = $idminuta";
  $busqueda = miActionSQL($sql);
                  if ($busqueda==1){
                          $mensaje=1;
                          } else {
                            $mensaje= $busqueda;

                          }
                        return $mensaje;
    
  }
  
}

function editarproyecto($idp, $nombrenuevo, $categorianueva, $regionnueva, $descripcionnueva)
        {
          include "../cms/library/common.php";
          $sql2 = "UPDATE intranet_roadmap SET nombrepr='".$nombrenuevo."', categoriapr=".$categorianueva.", descripcion='".$descripcionnueva."', regionpr=".$regionnueva.", fechamodif=NOW() WHERE idpr=".$idp;
      $busqueda2 = miActionSQL($sql2);
          if ($busqueda2==1){
          $mensaje2=1;
          } else {
            $mensaje2= $busqueda2;

          }
        return $mensaje2;
                   
        }

function listarproyecto() {
          include "../cms/library/common.php";
          $query = "SELECT idpr, nombrepr FROM intranet_roadmap";
          $result = (array) json_decode(miBusquedaSQL($query), true) ;
          foreach ($result as $pr) {
          $proyectos .= '<li class="nav-item " id="'.$pr["idpr"].'">
                    <a class="nav-link" href="#" onclick="cargarProyecto('.$pr["idpr"].')">
                      <i class="material-icons">done</i>
                      <p>'.$pr['nombrepr'].'</p>
                    </a>
                  </li>';
                }
        return $proyectos;

}
function listadocategoria() {    //listado que sale en el select de 'nuevo proyecto'
          $query9 = "SELECT * FROM intranet_roadmap_categorias";
          $result9 = (array) json_decode(miBusquedaSQL($query9), true) ;
          foreach ($result9 as $pr9) {
          $proyectos .= '<option value="'.$pr9['id_categoria'].'">'.$pr9['nombre'].'</option>    
';
                }
        return $proyectos;
}

function listadoregiones() {    //listado que sale en el select de 'nuevo proyecto'
          $query8 = "SELECT * FROM intranet_roadmap_regiones";
          $result8 = (array) json_decode(miBusquedaSQL($query8), true) ;
          foreach ($result8 as $pr8) {
          $proyectos .= '<option value="'.$pr8['id_region'].'">'.$pr8['nombre_region'].'</option>    
';
                }
        return $proyectos;

}
function proyectos($where, $iduser) {
        switch ($where) {
          case '1':
              $titulo = "Ultimos Proyectos Agregados";
              $relleno = rellenoUltimos($iduser);
              $fecha = "Fecha de Creado";
              $color = "info";
            break;
          case '2':
              $relleno = rellenoTodos($iduser);
              $titulo = "Proyectos";
              $fecha = "Fecha de Creado";
              $color = "info";
              break;
          case '3':
              $relleno = rellenoModificados($iduser);
              $titulo = "Modificados Recientemente";
              $fecha = "Última Modificación";
              $color = "danger";
          }
          $cabecera = '<div class="col-md-6 col-sm-6">
              <div class="card">
                <div class="card-header card-header-'.$color.'">
                  <h3 class="card-title">'.$titulo.'</h3>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-'.$color.'">
                      <th>Nombre</th>
                      <th>Categoria</th>
                      <th>Región</th>
                      <th>'.$fecha.'</th>
                    </thead>
                    <tbody>
                      '.$relleno.'
                    </tbody>
                  </table>
              </div>
            </div>
          </div>';
return $cabecera;
          
}
function rellenoTodos(){
  include "../cms/library/common.php";
  $query2 = "SELECT * FROM intranet_roadmap ORDER by idpr";
  $result3 = (array) json_decode(miBusquedaSQL($query2), true) ;
    foreach ($result3 as $pr3) {
        $query3 = "SELECT * FROM intranet_roadmap_regiones WHERE id_region = ".$pr3['regionpr']."";
        $result4 = (array) json_decode(miBusquedaSQL($query3), true) ;
        $region= $result4[0]['nombre_region'];
        $query4 = "SELECT * FROM intranet_roadmap_categorias WHERE id_categoria = ".$pr3['categoriapr']."";
        $result5 = (array) json_decode(miBusquedaSQL($query4), true) ;
        $categoria= $result5[0]['nombre'];

      
     
              $proyectos3 .= '<tr style="cursor: pointer;" onclick="cargarProyecto('.$pr3["idpr"].')">
            <td style="text-transform: capitalize;">'.$pr3["nombrepr"].'</td>
            <td>'.$categoria.'</td>
            <td>'.$region.'</td>
            <td>'.$pr3['fechapr'].'</td></tr>'; 
                }
        return $proyectos3;
} 
 function rellenoUltimos($iduser){

  $query2 = "SELECT * FROM intranet_roadmap INNER JOIN intranet_roadmap_users ON intranet_roadmap.idpr = intranet_roadmap_users.prid  WHERE userid ='".$iduser."' ORDER by idpr DESC LIMIT 5";
          $result3 = (array) json_decode(miBusquedaSQL($query2), true) ;

  foreach ($result3 as $pr3) {
    $query3 = "SELECT * FROM intranet_roadmap_regiones WHERE id_region = ".$pr3['regionpr']."";
    $result4 = (array) json_decode(miBusquedaSQL($query3), true) ;
    $region=$result4[0]['nombre_region'];
    $query5 = "SELECT * FROM intranet_roadmap_categorias WHERE id_categoria = ".$pr3['categoriapr']."";
    $result6 = (array) json_decode(miBusquedaSQL($query5), true) ;
    $categoria= $result6[0]['nombre'];

    
              $proyectos3 .= '<tr style="cursor: pointer;" onclick="cargarProyecto('.$pr3["idpr"].')">
            <td style="text-transform: capitalize;">'.$pr3["nombrepr"].'</td>
            <td>'.$categoria.'</td>
            <td>'.$region.'</td>
            <td>'.$pr3['fechapr'].'</td></tr>'; 
                }
        return $proyectos3;
} 

function rellenoModificados($iduser){

  $query2 = "SELECT * FROM intranet_roadmap INNER JOIN intranet_roadmap_users ON intranet_roadmap.idpr = intranet_roadmap_users.prid  WHERE userid ='".$iduser."' ORDER by fechamodif DESC LIMIT 5";
          $result3 = (array) json_decode(miBusquedaSQL($query2), true) ;

  foreach ($result3 as $pr3) {
    $query3 = "SELECT * FROM intranet_roadmap_regiones WHERE id_region = ".$pr3['regionpr']."";
    $result4 = (array) json_decode(miBusquedaSQL($query3), true) ;
    $region=$result4[0]['nombre_region'];
    $query5 = "SELECT * FROM intranet_roadmap_categorias WHERE id_categoria = ".$pr3['categoriapr']."";
    $result6 = (array) json_decode(miBusquedaSQL($query5), true) ;
    $categoria= $result6[0]['nombre'];

              $proyectos3 .= '<tr style="cursor: pointer;" onclick="cargarProyecto('.$pr3["idpr"].')">
            <td style="text-transform: capitalize;">'.$pr3["nombrepr"].'</td>
            <td>'.$categoria.'</td>
            <td>'.$region.'</td>
            <td>'.$pr3['fechamodif'].'</td></tr>'; 
                }
        return $proyectos3;
}
function rellenoUltimosusuario($iduser){

  $query6 = "SELECT * FROM intranet_roadmap INNER JOIN intranet_roadmap_users ON intranet_roadmap.idpr = intranet_roadmap_users.prid  WHERE userid ='".$iduser."' ORDER by idpr DESC LIMIT 5";
          $result6 = (array) json_decode(miBusquedaSQL($query6), true) ;

 foreach ($result6 as $rs6){    
              $proyectos5 .= '<a style="cursor: pointer;" onclick="cargarProyecto('.$rs6["idpr"].')" class="dropdown-item">'.$rs6["nombrepr"].'</a>
                 '; 
                }
        return $proyectos5;
}
function rellenoActividadesUsuario($iduser){

  $query6 = "SELECT * FROM intranet_roadmap LEFT JOIN intranet_roadmap_actividades ON intranet_roadmap.idpr = intranet_roadmap_actividades.valuepr INNER JOIN intranet_roadmap_users ON intranet_roadmap.idpr = intranet_roadmap_users.prid WHERE userid ='".$iduser."' ORDER by intranet_roadmap_actividades.id DESC LIMIT 5";
          $result6 = (array) json_decode(miBusquedaSQL($query6), true) ;

 foreach ($result6 as $rs6){    
              $proyectos5 .= '<a style="cursor: pointer; margin:10px 20px; padding:4px 8px;" onclick="cargarProyecto('.$rs6["valuepr"].')"><h5 style="margin-bottom:0px; text-transform: capitalize;">'.$rs6["value1"].'</h5><span style="float:right;"><h7>Proyecto: '.$rs6["nombrepr"].'</h7></span></a>
                 '; 
                }
        return $proyectos5;
}
function listarcategoria($categoria) {
  include "../cms/library/common.php";
          $query = "SELECT * FROM intranet_roadmap_categorias";
          $result = (array) json_decode(miBusquedaSQL($query), true);

          $i=0;
          foreach ($result as $rs){
            $id = $rs['id_categoria'];
            $contenido = rellenartabla($id);
            $i++;
            if ($id==1) {
              $color = 'primary';
            } else if ($id==2) {
              $color = 'danger';
            } else if ($id==3) {
              $color = 'info';
            } else if ($id==4) {
              $color = 'success';
            } else if ($id==5) {
              $color = 'warning';
            }

            $tabla .= '<div class="col-md-6 col-sm-6">
              <div class="card">
                <div class="card-header card-header-'.$color.'">
                  <h3 class="card-title">'.$rs['nombre'].'</h3>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-'.$color.'">
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Actividades</th>
                      <th>Progreso</th>
                    </thead>
                    <tbody>
                      '.$contenido.'
                    </tbody>
                  </table>
              </div>
            </div>
          </div>';
          }
        return $tabla;
}
function rellenartabla($categoria){
  $query = "SELECT idpr, nombrepr, regionpr FROM intranet_roadmap WHERE categoriapr = ".$categoria."";
  $result = (array) json_decode(miBusquedaSQL($query), true);
  

  if ($result[0]==0) {
    $proyectos = '<tr>
            <td colspan="4" style="text-align:center;"><h3>Categoría sin <strong>Proyectos</strong> creados.</h3></td>
            '; 
  } else {

  foreach ($result as $rs){
    $numero = contarActividades($rs['idpr']);
    $numero2 = sumaActividades($rs['idpr']); 

    $proyectos .= '<tr style="cursor: pointer;" onclick="cargarProyecto('.$rs["idpr"].')">
            <td>'.$rs["idpr"].'</td>
            <td style="text-transform: capitalize;">'.$rs['nombrepr'].'</td>
            <td>Realizadas: '.$numero2.'/'.$numero.' </td>
            <td><progress value="'.$numero2.'" max="'.$numero.'">70 %</progress></td></tr>'; 
  }}
               
  return $proyectos;

}

function contarActividades($id){
  $sql = "SELECT * FROM intranet_roadmap LEFT JOIN intranet_roadmap_actividades ON intranet_roadmap.idpr = intranet_roadmap_actividades.valuepr WHERE intranet_roadmap.idpr = $id ";
  $prAct= miBusquedaSQL($sql);
  $result4 = (array) json_decode($prAct, true);
  $i = 0;
      foreach ($result4 as $rs) {
             $i=$i+1;
                    }
      return $i;
      }

function sumaActividades($id){
  $activid1 = "SELECT * FROM intranet_roadmap LEFT JOIN intranet_roadmap_actividades ON intranet_roadmap.idpr = intranet_roadmap_actividades.valuepr WHERE intranet_roadmap.idpr = $id ";
          $activid3  = miBusquedaSQL($activid1);
          $result3 = (array) json_decode($activid3, true) ;
          $completadas = 0;
      foreach ($result3 as $rs) {
        if ($rs['Status']==1){
             $completadas=$completadas+1;
                   } }
      return $completadas;
      
}
function contarMinutas($id){      //id actividad
       $sql = "SELECT * FROM intranet_roadmap_actividades LEFT JOIN intranet_roadmap_minutas ON intranet_roadmap_actividades.id = intranet_roadmap_minutas.actipadre_id WHERE intranet_roadmap_actividades.id = $id ";
  $prAct= miBusquedaSQL($sql);
  $result4 = (array) json_decode($prAct, true);
  $i = 0;
      foreach ($result4 as $rs) {
             $i=$i+1;
                    }
      return $i;
      }    
function sumaMinutas($id){
  $activid1 = "SELECT * FROM intranet_roadmap_actividades LEFT JOIN intranet_roadmap_minutas ON intranet_roadmap_actividades.id = intranet_roadmap_minutas.actipadre_id WHERE intranet_roadmap_actividades.id = $id ";
          $activid3  = miBusquedaSQL($activid1);
          $result3 = (array) json_decode($activid3, true) ;
          $completadas = 0;
      foreach ($result3 as $rs) {
        if ($rs['estado']==1){
             $completadas=$completadas+1;
                   } }
      return $completadas;
      
}
 
function verproyecto($id) {
          include "../cms/library/common.php";
          $activid = "SELECT * FROM intranet_roadmap LEFT JOIN intranet_roadmap_actividades ON intranet_roadmap.idpr = intranet_roadmap_actividades.valuepr WHERE intranet_roadmap.idpr = $id ";
          $activid2  = miBusquedaSQL($activid);
          $result2 = (array) json_decode(miBusquedaSQL($activid), true) ;
          
        $query4 = "SELECT * FROM intranet_roadmap_categorias WHERE id_categoria = ".$result2[0]['categoriapr']."";
        $result5 = (array) json_decode(miBusquedaSQL($query4), true) ;
        $categoria = $result5[0]['nombre'];
        
        $query6 = "SELECT * FROM intranet_roadmap_regiones WHERE id_region = ".$result2[0]['regionpr']."";
        $result6 = (array) json_decode(miBusquedaSQL($query6), true) ;
        $region = $result6[0]['nombre_region'];
        
          $query7 = "SELECT * FROM intranet_roadmap INNER JOIN intranet_roadmap_users ON intranet_roadmap.idpr = intranet_roadmap_users.prid WHERE prid = $id";
          $result3 = (array) json_decode(miBusquedaSQL($query7), true) ;
          foreach ($result3 as $rs3){
                $responsable.= "- ".ucwords($rs3['userid'])."<br>";
          }
          



          if ($result2[0]['estado']==0) {
            $estado='Asignado';
          } else if ($result2[0]['estado']==1) {
            $estado='Comenzado';
          } else if ($result2[0]['estado']==2) {
            $estado='Terminado';
          } 

         if ($result2[0]['fechacierre']='0000-00-00') {
            $fechacierre='Fecha Aun no Programada';
          } else {
            $fechacierre=$result2[0]['fechacierre'];
          } 

          
          $mivariable = 
          '<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h2 class="card-title" style="text-transform: capitalize;">'.$result2[0]['nombrepr'].'</h2>
                  <h4 class="card-category">'.$categoria.'</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>Region</th>
                        <th>Apertura de Proyecto</th>
                        <th>Cierre Estimado</th>
                      </thead>
                      <tbody>
                        <tr>
                           <td>'.$region.'</td>
                          <td>'.$result2[0]['fechapr'].'</td>
                          <td>'.$fechacierre.'</td>
                         
                        </tr>
                         <thead class=" text-primary">
                         <th>Encargado(s)</th>
                         <th>Sponsor</th>
                        <th>
                          Estado
                        </th>
                        
                        
                      </thead>
                        <tr>
                          
                          <td>
                            '.$responsable.'
                          </td>
                          <td>Salvador</td>
                          <td>
                            '.$estado.'
                          </td>
                         
                          
                        </tr>
                        <thead class=" text-primary">
                        <th>
                          Descripción
                        </th>
                        </thead>
                        <td>
                            '.$result2[0]['descripcion'].'
                          </td>
                      </tbody>
                    </table><a href="modificar.php?idp='.$id.'"><button class="btn btn-info btn-sm">Modificar Proyecto</button></a>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>

<div></div>
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title"><h4>Actividades</h4></span>
                      
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                      <table class="table">
                        <tbody>';
                     if ($result2[0]['value1']==NULL) {
                      $actividades.= '<tr id="nohay">
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="" checked>
                                  
                                </label>
                              </div>
                            </td>
                            
                            <td colspan="4" style="text-align: center;"><strong>NO HAY ACTIVIDADES</strong></td>
                            </tr>
                            <td id="actividadagregada"><td>
                          ';
                          
                        }  else {   
                     foreach ($result2 as $act) {
                    // if ($act['Status'] == 1) {
                    //   $status = 'checked';
                    //   } else {
                    //     $status = '';
                    //   } 
                      $numerototal =  contarMinutas($act['id']);
                      $numeroCompletadas= sumaMinutas($act['id']);
                      $div = $numerototal / $numeroCompletadas;
                      if ($div == 1) {
                      $sql2 = "UPDATE intranet_roadmap_actividades SET Status=1  WHERE id=".$act['id']."";
                      $busqueda2 = miActionSQL($sql2);
                        $status = 'checked';
                      } else {
                        $sql2 = "UPDATE intranet_roadmap_actividades SET Status=0  WHERE id=".$act['id']."";
                      $busqueda2 = miActionSQL($sql2);
                        $status = '';
                      }  
                      $actividades.= '<tr id="actividad'.$act['id'].'">
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="" '.$status.'  disabled>
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td id="nombre'.$act['id'].'">'.$act['value1'].'</td>
                            
                            <td class="td-actions text-right" style="float:right;">
                              <button type="button" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-tipo= "verAct" data-otro="'.$act['value1'].'" data-id="'.$act['id'].'" data-target="#minimodal"><i class="material-icons">search</i>
                                </button>
                              <button type="button" rel="tooltip" title="Edit Task" data-toggle="modal" class="btn btn-primary btn-link btn-sm" data-tipo="modificarAct" data-otro="'.$act['value1'].'" data-target="#minimodal"  data-id="'.$act['id'].'">
                              <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" onclick="deleteactivity('.$act['id'].')" >
                                <i class="material-icons">close</i>
                              </button>
                              
                            </td>
                          </tr>';
                        }
                        }
                        $mivariable2=' <tr id="nohay"></tr>
                        <tbody id="actividadagregada"></tbody>
                         
                        </tbody>
                        
                      </table>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-tipo="nuevaAct" data-otro="'.$result2[0]['categoriapr'].'" data-target="#minimodal" data-id="'.$result2[0]['idpr'].'">Agregar Actividad</button>                    </div>
                    
                  </div>
                </div>
              </div>
            </div>';

        return $mivariable.''.$actividades.''.$mivariable2;
}

function verModifProyecto($idp) {
        include "../cms/library/common.php";
      $sql='SELECT * FROM intranet_roadmap WHERE idpr = '.$idp;
      $consulta=(array)json_decode(miBusquedaSQL($sql), true, 512, JSON_UNESCAPED_UNICODE);

      
        

         
      foreach ($consulta as $datos) {

        if ($datos['estado']=='0') {
            $estado='Asignado';
          } else if ($datos['estado']=='1') {
            $estado='Comenzado';
          } else if ($datos['estado']=='2') {
            $estado='Terminado';
          } 
          if ($datos["categoriapr"]=='1') {
            $categ='Publicidad';
          } else if ($datos["categoriapr"]=='2') {
            $categ='Academia';
          } else if ($datos["categoriapr"]=='3') {
            $categ='Recursos Humanos';
          } else if ($datos["categoriapr"]=='4') {
            $categ='Recepcion';
          } else if ($datos["categoriapr"]=='5') {
            $categ='Sistemas';
          } else {
            $categ='sin categoria';
          }

          if ($datos['regionpr']=='0') {
            $region='Venezuela';
          } else if ($datos['regionpr']=='1') {
            $region='Panama';
          } else if ($datos['regionpr']=='2') {
            $region='Aruba';
          }else if ($datos['regionpr']=='3') {
            $region='Estados Unidos';
          }else if ($datos['regionpr']=='4') {
            $region='Kazajistan';
          }
         
 
$cuerpo=' 
          <div class="col-md-12">
              <div class="card"><form method="post" action="libreria.php">
                <div class="card">
                <div class="card-header card-header-primary">
                  <h3 class="card-title ">Modificar Proyecto</h3>
                  <p class="card-category">Estado: '.$estado.'</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" >
                      <thead class=" text-primary">
                        <th colspan="2">
                          Nombre del Proyecto
                        </th>
                      </thead>
                      <tr>
                          <td colspan="4">
                          <textarea name="nombrenuevo" id="nombrenuevo" class="form-control" rows="2">'.$datos["nombrepr"].'</textarea>
                            
                          </td>
                          </tr>

                      <thead class=" text-primary">
                        <th colspan="2">
                          Categoría
                        </th>
                        <th colspan="2">
                          Región
                        </th>
                        
                      </thead>
                      <tbody>
                        <tr>
                          <td colspan="2"><select class="form-control form-control-sm" name="categorianueva" required><option value="'.$datos["categoriapr"].'">'.$categ.'</option>
                                  <option value="1">Publicidad</option>    
                                  <option value="2">Academia</option>    
                                  <option value="3">Recursos Humanos</option>    
                                  <option value="4">Recepcion</option>    
                                  <option value="5">Sistemas</option>  
                            </select></td>
                          <td colspan="2">
                          <select class="form-control form-control-sm" name="regionnueva" id="regionnueva"><option value="'.$datos["regionpr"].'">'.$region.'</option>
                                  <option value="0">Venezuela</option>    
                                  <option value="1">Panama</option>    
                                  <option value="2">Aruba</option>    
                                  <option value="3">Estados Unidos</option>    
                                  <option value="4">Kazajistan</option>  
                            </select></td>
                            </tr>
                        <tr>
                        <thead class=" text-primary">
                        <th colspan="4">
                          Descripción
                        </th>
                        
                        
                      </thead>
                       </tr>
                        <tr>
                          <td colspan="4">
                          <textarea name="descripcionnueva" id="descripcionnueva" class="form-control" rows="2">'.$datos["descripcion"].'</textarea>
                            
                          </td>
                          </tr>
                          <tr>
                        <thead class=" text-primary">
                        <th colspan="4">
                          Personal a Cargo: 
                        </th>
                        
                        
                      </thead>
                       </tr>
                        <tr>
                          <td colspan="4">
                            Fulano
                          </td>
                          
                        </tr>
                        
                        
                      </tbody>
                    </table>
                    <input type="hidden" name="idp" value="'.$idp.'">
                  <input type="submit" name="modificar" class="btn btn-info" value="Guardar"> 
                <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
                </form>';
      }        
        return $cuerpo;
}
function consultatitulo($id){
  $sql='SELECT value1 FROM intranet_roadmap_actividades WHERE id = '.$id.'';
      $consulta=json_decode(miBusquedaSQL($sql), true, 512, JSON_UNESCAPED_UNICODE);
      $titulo = $consulta[0]['value1'];
      return $titulo;
}

?>