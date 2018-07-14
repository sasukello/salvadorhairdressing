<?php
include "../../sec/seguro.php";
$_SESSION["ubicacion"] = "default";
$_SESSION["calendar_live"] = 1;
$_SESSION["tabla_basica"] = 1;
$arrayMenu = unserialize($_SESSION["accesos"]);
$code64 = base64_encode($iduser);

$_SESSION["tabla_basica"] = 1;

include "../../sec/libfunc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

}
?>

<!DOCTYPE html>
<html>
        <head>
        <title>Salvador Hairdressing - Intranet</title>
        <?php include "../../componentes/header.php"; ?>
        <!--<link rel="stylesheet" type="text/css" href="componentes/css/fa-svg-with-js.css">-->
        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader
        <div id="preloader"></div>-->
        <div id="top"></div>

        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu);
             ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.Seccion Principal -->

        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-center feature-title">
                        <h2>Lista de Pago Pendiente</h2>
                    </div>
                        <table id="tablapagos" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Monto a Pagar</th>
                                    <th>Banco</th>
                                    <th>Subir Factura</th>
                                </tr>
                            </thead>

                            <!-- <tbody>
                                <tr>
                                    <td>Salvador Galerias</td>
                                    <td><1.300.000bs-</td>
                                    <td><<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-tipo="banco" data-id="S01" data-target="#modalPago">Banco</button></td>
                                    <td><<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-tipo="factura" data-id="S01" data-target="#modalPago">Pagar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Salvador Express</td>
                                    <td>1.500.000bs</td>
                                    <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-tipo="banco" data-id="S11" data-target="#modalPago">Bancos</button></td>
                                    <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-tipo="banco" data-id="S11" data-target="#modalPago">Pagar</button>
                                    </td>
                                </tr>
                            </tbody> -->
                             <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Monto a Pagar</th>
                                    <th>Banco</th>
                                    <th>Subir Factura</th>
                                </tr>
                            </tfoot>
                        </table>
<!--  MODAL  -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
 -->

                </div>
            </div>
             <!-- Modal -->
            <div id="modalPago" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span id="pago-titulo"></span></h4>
                  </div>
                  <div class="modal-body">
                    <span id="pago-body"></span>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
                </div>
            </div>
        <?php include "../../componentes/footer.php"; ?>
        <script type="text/javascript" src="/intranet/componentes/js/corp-admin.js"></script>
       <!-- <script type="text/javascript" src="/intranet/componentes/js/fontawseone-all.min.js"></script>-->
        <script>
        

                     $('#tablapagos').DataTable({
                      "ajax": {
                        "url": "/intranet/api.php",
                        "dataSrc": "",
                        "type": "POST",
                        "data":{action:'pagop', datos: '<?php echo $iduser;?>' }
                      }
                  });
        </script>
    </body>
</html>
