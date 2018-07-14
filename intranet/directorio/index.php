<?php
error_reporting(1);

$user = "";$iduser = "";$codUser = "";$codPermiso = "";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION["permiso"] = 50;
    $_SESSION["ubicacion"] = "default";
    if(isset($_SESSION["codigo"])){

        $user = $_SESSION["usuario"];
        $iduser = $_SESSION["codigo"];
        $peruser = $_SESSION["permiso"];
        $hash = $_SESSION["hash"];
        $arrayMenu = unserialize($_SESSION["accesos"]);
        $codUser = base64_encode($iduser);
        $codPermiso = base64_encode($peruser);
        $_SESSION["tabla_basica"] = 1;        

        if($hash == "s6a5486dasdas31"){
            $bandera = true;
        } else{
        header("location:logout.php");
        }
    } else{
       header("location:logout.php");
    }

}else{

    $_SESSION["ubicacion"] = "default";

}

include "../sec/intranetvarios.php";

include "../sec/libfunc.php";

include "../sec/directorio.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["r"])){
      $reg = $_GET["r"];
      
  }
}

?>

<!DOCTYPE html>

<html>

        <head>

        <title>Salvador Hairdressing - Intranet</title>

        <?php include "../componentes/header.php"; ?>

        <link href="../componentes/css/directorio.css" media="all" rel="stylesheet" type="text/css" />

        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader -->

        <div id="preloader"></div>

        <div id="top"></div>

        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu);

            include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/intranetvarios.php"); ?>

                        </div>

                    </div>

                </div> 

            </div> 

        </div>

        <!-- /.seccion principal -->

        <div id="main">

        <div class="container text-center">
        <p></p>
        <div><h2>Directorio</h2></div>
        <p><i>Selecciona la región</i></p>

        </div>

        <div id="client">

            <div class="container">

                    <div class="col-md-10 col-md-offset-1 col-sm-12 feature-title">

                        <?php if(isset($mensaje)){ ?>

                            <br><div class="alert alert-success">

                              <?php echo mensajeenviado; ?>

                            </div>

                        <?php }  ?>

                <div class="col-md-12 top-20 padding-0">
                <?php 

                if (!isset($reg)) {
                  echo '<div class="col-sm-12 text-center" id="regiones">'.regionCargar($iduser).'</div>'; 
                }
                else {



                ?> 
                <div class="col-md-12">
                                    
                        <div style="text-align: right; padding-bottom: 10px;">
                            <a href="#" data-toggle="modal" data-target="#agregar"><span class="pe-7s-add-user"></span> Agregar Proveedor</a>
                        </div>
                      <div class="responsive-table">
                      <table id="directorio-intra" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Proveedor</th>
                          <th>Productos y/o Servicios</th>
                          <th>Teléfono</th>
                          <th>Correo</th>
                          <th>Calificación</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        </tr>
                      </tbody>
                        </table>
                      </div>
              </div> 
              <?php }
              ?>
              </div>

            </div>

            </div>

          </div>

        </div>

    </div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Agregar un nuevo proveedor
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" id="cuerpomodal">  
                <form role="form">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Proveedor</label>
                      <input type="text" class="form-control"
                      id="proveedor" name="proveedor" value="" placeholder="Proveedor"/>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Productos y Servicios</label>
                      <input type="text" class="form-control"
                      id="servicios" name="servicios" value="" placeholder="Productos y Servicios"/>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Teléfono</label>
                      <input type="text" class="form-control"
                      id="telefono" name="telefono" value="" placeholder="Teléfono"/>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Región</label>
                        <select id="region" name="region" style="width: 100%; height: 34px; border-radius: 4px;">
                            <option value="">Selecciona una región...</option>
                            <option value="380">Chile</option>
                            <option value="249">Colombia</option>
                            <option value="382">Costa Rica</option>
                            <option value="304">Curazao</option>
                            <option value="302">Ecuador</option>
                            <option value="3">Estados Unidos</option>
                            <option value="376">México</option>
                            <option value="2">Panamá</option>
                            <option value="378">Perú</option>
                            <option value="72">República Dominicana</option>
                            <option value="1">Venezuela</option>
                        </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Calificación</label>
                        <select id="calificacion" name="calificacion" style="width: 100%; height: 34px; border-radius: 4px;">
                            <option value="">Selecciona...</option>
                            <option value="1">1 Estrella</option>
                            <option value="2">2 Estrella</option>
                            <option value="3">3 Estrella</option>
                            <option value="4">4 Estrella</option>
                            <option value="5">5 Estrella</option>
                        </select>
                  </div>
                  <div class="form-group col-md-8" style="padding-right: 15px; padding-left: 15px;">
                    <label for="exampleInputEmail1">Correo Electrónico</label>
                      <input type="email" name="correo" class="form-control" id="correo" value="" placeholder="Correo Electrónico"/>
                  </div>
                  <div class="form-group" style="padding-right: 15px; padding-left: 15px;">
                    <label for="exampleInputPassword1">Comentario</label>
                      <input type="textarea" class="form-control" value="" id="comentario" placeholder="Ingresa un comentario"/>
                  </div>
                </form>
            </div>      
            <!-- Modal Footer -->
            <div class="modal-footer" style="padding-right: 30px;">
                <button type="button" class="btn"data-dismiss="modal" style="background-color: gray; color: white;">Cerrar</button>
                <button type="button" onclick="addproveedor();" class="btn" style="background-color: #d34a4a; color: white;">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Agregar -->

<!-- Modal Modificar -->
<div class="modal fade" id="modificar" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Información del Proveedor
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">  
                <form role="form">
                  <div class="form-group col-md-6">
                    <label>Proveedor</label>
                      <div id="proveedor1"></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Productos y Servicios</label>
                      <div id="servicios1"></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Teléfono</label>
                      <div id="telefono1"></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Región</label>
                      <div id="region1"></div>
                  </div>
                  <div class="form-group col-md-4" style="padding-right: 15px; padding-left: 15px;">
                    <label>Calificación</label>
                      <div id="calificacion1"></div>
                  </div>
                  <div class="form-group col-md-8" style="padding-right: 15px; padding-left: 15px;">
                    <label>Correo Electrónico</label>
                      <div id="correo1"></div>
                  </div>
                  <div class="form-group" style="padding-right: 15px; padding-left: 15px;">
                    <label>Comentario</label>
                      <div id="comentario1"></div>
                  </div>
                </form>
            </div>      
            <!-- Modal Footer -->
            <div class="modal-footer" style="padding-right: 30px;">
                <button type="button" class="btn"data-dismiss="modal" style="background-color: gray; color: white;">Cerrar</button>
                <!--<button type="button" class="btn" style="background-color: #d34a4a; color: white;">Eliminar</button>
                <button type="button" class="btn" style="background-color: #d34a4a; color: white;">Modificar</button>-->
            </div>
        </div>
    </div>
</div>
<!-- End Modal Modificar -->

<?php include "../componentes/footer.php"; ?>  

<script>
            $(document).ready(function() {
              $region = <?php echo $reg; ?>;
              $('#directorio-intra').DataTable({
                      "ajax": {
                        "url": "directorio.php",
                        "dataSrc": "",
                        "type": "POST",
                        "data":{action:'postdir1', datos: 'ALUGO;'+$region+''}
                      }
                  });

            });

</script>
<script src="../componentes/js/directorio.js" type="text/javascript"></script>

</body>
</html>