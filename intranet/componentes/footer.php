<?php
if(isset($usuario)){
    $user = $usuario;
}

$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
?>

        <style type="text/css">
            #footer {
                padding: 30px 0 0px;
                margin-top: 60px;
            }
        </style>

        <footer id="footer" style="background: #26262a;">
            <div class="container" style="padding-bottom: 20px;">
                <div class="main-footer">
                    <div class="social text-center" >
                        <div><img src="http://www.salvadorhairdressing.com/c/img/salvadorblanco.png" width="150px" style="padding-bottom: 10px;"></div>
                         <?php if(isset($user)){echo "<span style='color: #fff;'>Usuario: ".$user."</span><input type='hidden' name='ui' value='".$iduser."'>";} else{ ?>
                        <p class="conte1"><a href="#" class="lang_flag_es" onclick="cambiarIdiomaES();"></a>
                         <a href="#" class="lang_flag_en" onclick="cambiarIdiomaEN();"></a></p><br><br><?php }?>
                        <p class="text-center wow fadeInUp" style="font-size: 14px;">Página Cargada en: <?php echo number_format((float)$time, 5, '.', ',');?> segundos</p>
                    </div>
                    
                    <a href="#" class="scrollToTop"><i class="pe-7s-up-arrow pe-va"></i></a>
                </div>  
                
            </div>
            <div class="sub-footer" style="background: #000;     padding: 30px 0;">
                <div class="container">
                    <div class="col-sm-12">
                        <div class="row copmob">
                          <span><?php echo _('Salvador Hairdressing &copy; 2016 - 2018. Todos los derechos reservados.'); ?></span>
                          <span style="float: right; color: #fff;">
                            <a target="_blank" href="https://salvadorhairdressing.com"><i style="color: #777; font-size: 22px; font-weight: normal;" class="pe-7s-global"></i></a>
                          </span>
                        </div>
                    </div>           
                </div>
            </div>
        </footer>

        

        <!-- /.javascript files -->
        <script src="/intranet/componentes/js/jquery-3.2.1.min.js"></script>
        <script src="/intranet/componentes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/intranet/componentes/js/jquery.sticky.js" type="text/javascript"></script>
        <script src="/intranet/componentes/plugins/wow.min.js" type="text/javascript"></script>
        <script src="/intranet/componentes/plugins/owl.carousel.min.js" type="text/javascript"></script>
        <script src="/intranet/componentes/plugins/jquery.blockUI.js" type="text/javascript"></script>
        <script src="/intranet/componentes/js/opciones.js" type="text/javascript"></script> 
        <script src="/intranet/componentes/plugins/bootstrap-notify.min.js" type="text/javascript"></script> 

        <?php 

        if(isset($_SESSION['tv']) || isset($_SESSION["tabla_basica"]) || isset($_SESSION["filtros_ventas"]) ){ ?>
        <script src="/intranet/componentes/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="/intranet/componentes/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <?php if(isset($_SESSION["tabla_completa"])){ if($_SESSION["tabla_completa"] === "1"){?>
            <script src="/intranet/componentes/datatables/btn/dataTables.buttons.min.js" type="text/javascript"></script>
            <script src="/intranet/componentes/datatables/btn/buttons.bootstrap.min.js" type="text/javascript"></script>
            <script src="/intranet/componentes/datatables/btn/buttons.flash.min.js" type="text/javascript"></script>
            <script src="/intranet/componentes/datatables/btn/buttons.html5.min.js" type="text/javascript"></script>
            <script src="/intranet/componentes/datatables/btn/buttons.print.min.js" type="text/javascript"></script>
            <script src="/intranet/componentes/datatables/dataTables.fixedHeader.min.js" type="text/javascript"></script>
            <script src="/intranet/componentes/datatables/dataTables.select.min.js" type="text/javascript"></script>
        <?php } else if($_SESSION["tabla_completa"] === "0"){ ?> <script>$(document).ready(function() {$('#vt3').DataTable({responsive: true});} );</script> <?php }} 
        if(isset($_SESSION["tabla_responsive"]) && $_SESSION["tabla_responsive"] == 1){ ?>
            <script src="/intranet/componentes/datatables/rspnsv/dataTables.responsive.min.js" type="text/javascript"></script>
        <?php }  ?>
        <script>
            $(document).ready(function() {
                $('#vt').DataTable({responsive: true});
            } );
        </script>

        <?php } if(isset($_SESSION["tabla_completa"])){ if($_SESSION["tabla_completa"] === "1"){?>
            <script src="/intranet/componentes/js/tablas-opc.js" type="text/javascript"></script>

        <?php   }} ?>
        
        <?php if(isset($_SESSION["cliente"])){ ?>
            <script src="/intranet/componentes/js/clientes.js" type="text/javascript"></script>
        <?php } if(isset($_SESSION["asociado"])){ ?>
            <script src="/intranet/componentes/js/asociado.js" type="text/javascript"></script>
        <?php } if(isset($_SESSION["servicio"])){ ?>
            <script src="/intranet/componentes/js/servicios.js" type="text/javascript"></script>
            <script src="/intranet/componentes/js/asociado.js" type="text/javascript"></script>
        <?php } if(isset($_SESSION["calendar_live"]) && $_SESSION["calendar_live"] == 1){ ?>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
            <link rel="stylesheet" type="text/css" href="/intranet/componentes/css/jquery.datetimepicker.css"/>
            <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
            <script>
                $(function() {
                   $( "#date_desde" ).datepicker();
                   $( "#date_hasta" ).datepicker();
                   $( "#date" ).datepicker();
                   $( "#date_desde").datepicker('setDate', new Date());
                   $( "#date_hasta" ).datepicker('setDate', new Date());
                 });
            </script>
        <?php } if($_SESSION["ubicacion"] == "ayuda"){
            echo '<script src="/intranet/componentes/js/ayuda.js" type="text/javascript"></script>';
            } else if($_SESSION["ubicacion"] == "live"){
                echo '<script src="/intranet/componentes/js/liveplus.js" type="text/javascript"></script>';
                echo '<script src="/intranet/componentes/select/jquery.multi-select.js" type="text/javascript"></script>';
            } else if($_SESSION["ubicacion"] == "apps"){
                echo '<script src="/intranet/componentes/select/jquery.multi-select.js" type="text/javascript"></script>';
            } ?> ?>    
        <script> new WOW().init(); </script>
        <script>$(window).on('load', function() {
            $("#preloader").fadeOut("slow");;
        });</script>
        <script>
            $('#betatester').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);var recipient = button.data('id');var modal = $(this)
                document.getElementById("beta_nombre").innerHTML = "<input type='text' class='form-control' name='beta_name' value='"+recipient+"' disabled>";
                if (recipient === "") {
                    document.getElementById("beta_nombre").innerHTML = "";
                    return;
                }
            });
        </script>