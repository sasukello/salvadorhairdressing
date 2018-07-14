<?php
ob_start();
?>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/intranet/descargas/componentes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/cc/css/estilo.css"/>
    <link rel="stylesheet" type="text/css" href="/cc/css/socialmedia.css"/>
    <link href="/cc/css/menu.css" rel="stylesheet" type="text/css"/>
    <link href="/css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/descargas/componentes/css/descargas.css"/>
    <link href="/cc/css/movil.css" rel="stylesheet" type="text/css" media="only screen and (max-width: 480px), only screen and (max-device-width: 480px)"/>
    <link rel="stylesheet" type="text/css" href="/cc/css/normalize2.css" />
    <link rel="stylesheet" type="text/css" href="/cc/css/demo2.css" />
    <link rel="stylesheet" type="text/css" href="/cc/css/component2.css" />
    <link rel="stylesheet" type="text/css" href="/cc/css/component.css" />
    <script src="/cc/js/modernizr2.custom.js"></script>
    <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="/intranet/descargas/componentes/bootstrap/js/bootstrap.min.js"></script>
</head>
<script>
    jQuery(document).ready(function($) {
        $('#sidebar-btn').click(function() {
            $('#sidebar').toggleClass('visible');
        });
    });
</script>
<div class="headerWrap">
    <div id="indexHeader">
        <a href="/index.php"><div id="logo_salvador"></div></a>
        <div id="contactanos_ad" style="width: 100px;height: 75px;float: left;margin: 20px 0 10px 130px;"><a href="/contactenos.php"><img src="/images/boton-gif.gif" height="100%" width="100%"></a></div>
        <div id="social" style="margin: 55px 208px 0 0;">
            <iframe src="//www.facebook.com/plugins/like.php?locale=es_LA&href=http%3A%2F%2Fwww.facebook.com%2FSalvadorPeluquerias&amp;send=false&amp;layout=standard&amp;width=300&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:35px;" allowTransparency="true"></iframe>
        </div> 
        <div id='line1' style='height:auto;width: 100%;margin-left: auto;margin-right: auto;'>
            <img src='/images/line_header.jpg' width='991' height='6' style="width: 100%;"/>
        </div>
        <?php if(isset($perusu)){
            if($perusu < '50'){
        echo "<div class='container' id='line1'><section class='color-5'>
                    <nav class='cl-effect-5'>
                        <ul>
                        <div  style='text-align: center;'>
                            <a href='/descargas/cuenta'><span data-hover='HOME'>INICIO</span></a>
                            <a href='/descargas/cuenta/d'><span data-hover='DOWNLOAD'>DESCARGAS</span></a>
                            <a href='/descargas/cuenta/logout.php'><span data-hover='LOGOUT'>CERRAR SESIÓN</span></a>
                        </div>    
                        </ul>
                    </nav>
            </section></div>";
            } else if($perusu >= '50'){
                if(isset($_SESSION["ubicacion"])){
                    $ubicacion = $_SESSION["ubicacion"];
                    if($ubicacion === "true"){
                       echo "<div class='container' id='line1'>
                        <section class='color-5'>
                            <nav class='cl-effect-5'>
                                <ul><div  style='text-align: center;'>
                                        <a href='/descargas/admin'><span data-hover='HOME'>INICIO</span></a>
                                        <a href='/descargas/admin/actualizar'><span data-hover='UPDATE'>ACTUALIZAR</span></a>
                                        <a href='/descargas/cuenta/d'><span data-hover='DOWNLOAD'>DESCARGAR</span></a>
                                        <a href='/descargas/cuenta/logout.php'><span data-hover='LOGOUT'>CERRAR SESIÓN</span></a>
                                    </div>    
                                </ul>
                            </nav>
                        </section>
                    </div>";  
                    }
                } else
                echo "<div class='container' id='line1'>
                        <section class='color-5'>
                            <nav class='cl-effect-5'>
                                <ul><div  style='text-align: center;'>
                                        <a href='/descargas/admin'><span data-hover='HOME'>INICIO</span></a>
                                        <a href='/descargas/admin/actualizar'><span data-hover='UPDATE'>ACTUALIZAR</span></a>
                                        <a href='/descargas/cuenta'><span data-hover='DOWNLOAD'>DESCARGAR</span></a>
                                        <a href='/descargas/admin/logout.php'><span data-hover='LOGOUT'>CERRAR SESIÓN</span></a>
                                    </div>    
                                </ul>
                            </nav>
                        </section>
                    </div>";
            } 
            }else {
                echo "<div class='container' id='line1'><section class='color-5'>
                            <nav class='cl-effect-5'>
                                <ul><div  style='text-align: center;'>
                                    <a href='index.php'><span data-hover='SALVADOR PELUQUERÍAS: DESCARGAS'>SALVADOR PELUQUERÍAS: ÁREA DE DESCARGAS</span></a></li>
                                </div>    
                                </ul>
                            </nav>
                    </section></div>";
            }
        ?>
        <div id='line2' style='height:auto;width: 100%;margin-left: auto;margin-right: auto;'>
            <img src='/images/line_header.jpg' width='991' height='6' style="width: 100%;"/>
        </div>
    </div>
</div>
<?php
ob_end_flush();
?>