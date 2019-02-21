<?php
error_reporting(1);

include "../../sec/seguro.php";
$_SESSION["ubicacion"] = "minutas";
$arrayMenu = unserialize($_SESSION["accesos"]);

include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/minutaslang.php";
include "../../sec/libfunc.php";
include "../component/library.php";

//caragaminsalon();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

}

if ($_SERVER["REQUEST_METHOD"] == "GET") {


}

?>
<!DOCTYPE html>
<html>
        <head>
        <title>Minutas - Salvador Hairdressing (Intranet)</title>
        <?php include "../../componentes/header.php"; ?>
        <link rel="stylesheet" href="../component/css/minuta.css" />
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
        <link href='//fonts.googleapis.com/css?family=Gloria+Hallelujah' rel='stylesheet' type='text/css'>

        </head>
        <body data-spy="scroll" data-target="#navbar-scroll">
        
        <!-- /.preloader -->
        <div id="top"></div>

        <!-- /.cabecera -->
        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu);?>

				  
                        </div>
                    </div>
                </div> 
            </div> 
        </div>

        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">
                        <!-- /.feature title -->
                        <p><h2>Minutas</h2><i>Minutas de Operaciones</i></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /.client section -->
        <div id="client"> 
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center" id="regiones">

                      
                      <a href="javascript:;" class="button" id="add_new">Nueva Minuta</a>
                      <div id="board">
                        
                      </div>
                      <div id="cargando" style="width: 100%; height: 100%; text-align: center"><br><br><img src='/mysteryshopper/images/loading.gif'></div>
                      

                            <form action="index.php" method="post" class="form-horizontal">
                                <div class="form-group">
                                  <input type="hidden" id="mnidusuario" value="<?php echo $_SESSION["codigo"]; ?>">  
                                  <div id="espera"></div>

                              
                                   <div id="contenedorprincipal" class="form-group"> 

                                    <?php 

                                      if (in_array("Comite1", array_column($_SESSION["accesosminuta"], 'NOMBREITEM'))) {
                                        echo '<div class="col-sm-offset-1 col-sm-10 col-md-4 col-lg-3">';
                                        echo '
                                          <p>Ver Minutas de Comité</p>
                                          <button type="submit" class="btn bouton-image monBouton" name="minutacomite" style="color:red;height:50px; width:200px">Minutas de Comité</button>
                                          ';
                                        echo '</div></div>';
                                        }
                                      if (in_array("Comite1", array_column($_SESSION["accesosminuta"], 'NOMBREITEM'))) {
                                        echo '<div class="row"><p></p><div class="col-sm-offset-1 col-sm-10 col-md-4 col-lg-3 pt-10">';
                                        echo '
                                          <p>Ver Minutas de Operaciones:</p>
                                          <a href="operaciones"><button type="button" class="btn bouton-image monBouton" name="minutaoperacion" style="color:red;height:50px; width:200px">Minutas de Operaciones</button></a>
                                          ';
                                        echo '</div></div>';

                                    }//Carga la lista de regiones?>

                                </div>        
                              </form>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-8">
                            <button class="btn btn-default"><a href="/intranet/minutas/">Volver: Principal</a></button> <!--<button class="btn btn-default">Volver: Atrás</button>!-->
                          </div>
                          <div class="col-md-4" style="text-align: right;">
                            <button class="btn btn-default" data-toggle="modal" data-target="#sendmailMinutas" data-tip=<?php echo ''.$mivalor.''; ?> data-tip2=<?php echo ''.$mivalor2.''; ?>  >Enviar por Correo</button>
                          </div>
                        </div>      
                    </div>
                </div>
            </div>

        <?php include "../../componentes/footer.php"; ?>  

        <script src="/intranet/componentes/js/opciones.js"></script>
        <script src="../component/js/m-operaciones.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script type = "javascript">
           $(document).ready(function(){
               $('[data-toggle="tooltip"]').tooltip(); 
            });
        </script>

    </body>
</html>