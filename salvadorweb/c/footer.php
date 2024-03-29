  <?php 
$language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
putenv("LC_ALL=$language");
setlocale(LC_ALL, $language);
bindtextdomain("salvador_web", "./locale");
textdomain("salvador_web");
?>
  <div class="dark-wrapper">
    <div class="container">
 
    </div>
  </div>

  <!-- /.light-wrapper -->
  <footer class="footer inverse-wrapper" id="footer">
    <div class="row text-center">
              <ul>
                <li class="footlist"><?php echo _('<a class="link-footer" href="/nosotros.php">NOSOTROS</a>'); ?></li>
                <li class="footlist"><?php echo _('<a class="link-footer" href="/servicios.php">SERVICIOS</a>'); ?></li>
                <li class="footlist"><?php echo _('<a class="link-footer" href="/modelos/">MODELOS DE NEGOCIO</a>'); ?></li>
                <li class="footlist"><?php echo _('<a class="link-footer" href="/franquicias.php">FRANQUICIAS</a>'); ?></li>
                <li class="footlist"><?php echo _('<a class="link-footer" href="/ubicaciones">UBICACIONES</a>'); ?></li>
                <!--<li class="footlist"><?php echo _('<a class="link-footer" href="/novedades">NOVEDADES</a>'); ?></li>-->
                <li class="footlist"><?php echo _('<a class="link-footer" href="/contacto.php">CONTACTO</a>'); ?></li>
              </ul>
            </div>
            <div class="row text-center">
              <ul>
                <li class="footlist"><a class="link-footer" href="/app">APP</a></li>
                <li class="footlist"><a class="link-footer" href="/cc">CLIENTCARD</a></li>
                <li class="footlist"><a class="link-footer" href="/mysteryshopper">MYSTERY SHOPPER</a></li>
                <li class="footlist"><a class="link-footer" href="/fsmag.php">FS MAGAZINE</a></li>
                <!--<li class="footlist"><a class="link-footer" href="/academy">THE ACADEMY</a></li>-->
              </ul>
            </div>
      <div class="row">
        <!--<div class="col-sm-12 onmob-pad">
          <div class="col-sm-3">
            <div class="row">
            <div class="widget">
              <h4 class="widget-title">Suscríbete al Boletín</h4>
              <form class="searchform" method="get">
                <input type="text" id="s2" name="s" value="Ingresa tu correo electronico" onfocus="this.value=''" onblur="this.value='Suscribete'">
                <button type="submit" class="btn btn-default">Aceptar</button>
              </form><p></p><p></p>
            </div>
          </div>
          </div>
        </div> -->      
      </div>
      <!-- /.row --> 
    <!-- .container -->
    
    <div class="sub-footer">
      <div class="container">
          <div class="col-sm-12">
            <div class="row copmob">
              <span><?php echo _('Salvador Hairdressing &copy; 2018. Todos los derechos reservados.'); ?></span>
              <span class="icon-pos">
                <a target="_blank" href="https://es-la.facebook.com/SalvadorWorld/"><i class="zoom size-iconp fab fa-facebook-f"></i></a>
                <a target="_blank" href="https://www.instagram.com/mundosalvador"><i class="zoom size-iconp fab fa-instagram"></i></a>
                <a target="_blank" href="https://twitter.com/mundosalvador"><i class="zoom size-iconp fab fa-twitter"></i></a>
                <a target="_blank" href="https://www.pinterest.com/mundosalvador/"><i class="zoom size-iconp fab fa-pinterest-p"></i></a>
                <a target="_blank" href="https://www.youtube.com/user/salvadorpeluqueria"><i class="zoom size-iconp fab fa-youtube" style="padding-right: 0;"></i></a>
              </span>
            </div>
          </div>           
      </div>

      
      <!--<div class="container inner">
        <p class="text-center"><?php //echo _('© 2011-2018 Salvador Hairdressing. Todos los derechos reservados.'); ?></p>
      </div>-->
      <!-- /c/img/60-bs.png.container --> 
    </div>
    <!-- .sub-footer --> 
  </footer>
  <!-- /footer --> 
  
</main>

<!-------- Modal -------->
<div class="modal fade" id="rating-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document" style="z-index: 99999;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center" id="exampleModalLabel" style="text-transform: uppercase;">Calificar Salón</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="rating-body">
        <form method="POST">
          <div class="form-group">
            <h6 class="col-form-label">Calificación actual:</h6>
            <h3><span id="estrellas-db"><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><small> 5.0</small></span></h3>
          </div>
          <span id="rating-db"></span>
          <br>
          <div class="form-group">
            <h6 class="col-form-label">Selecciona tu calificación:</h6>
            <select name="calificacion" id="calificacion">
              <option value="5">5</option>
              <option value="4">4</option>
              <option value="3">3</option>
              <option value="2">2</option>
              <option value="1">1</option>
            </select>
          </div>
          <div class="text-center">
            <button onclick="sendStars();" id="calificar-btn" type="button" class="btn btn-primary">Calificar</button>
          </div>
          <div class="text-center">
          <span id="result-rating"></span>
          </div>

          <br>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-------- Modal -------->
<!--/.body-wrapper --> 

<script src="/style/js/jquery.min.js"></script> 
<script src="/style/js/bootstrap.min.js"></script> 
<script src="/style/js/plugins.js"></script> 
<script src="/style/js/classie.js"></script> 
<script src="/style/js/jquery.themepunch.tools.min.js"></script> 
<script src="/style/js/scripts.js"></script>
<script src="/c/js/options.js"></script> 
<script src="/c/js/jquery.autocomplete.js"></script> 
<script src="/c/js/jquery.mockjax.js"></script> 
<script src="/c/js/demo.js"></script> 
<script src="/c/js/countries.js"></script> 
<script src="/c/js/formhelpers/bootstrap-formhelpers-countries.js"></script>
<script src="/c/js/formhelpers/lang/es_ES/bootstrap-formhelpers-countries.es_ES.js"></script>

<script>
//Function que captura los parametros de la url del idioma
function GetURLParameter(sParam){
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++){
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam){ 
            return sParameterName[1];
        }
    }
}
//Se guarda la llamada de la funcion en una varible
var lenguaje = GetURLParameter("lang");
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
    $('.pagination li a').on('click', function(){
    $('.items').html('<div class="loading" style="text-align:center;"><img src="/c/img/loading.gif" width="" height=""/><br><br></div>');
    var page = $(this).attr('data');
    var dataPagin = 'page='+page;
    //aqui se verifica si el idioma es ingles o italiano llame una funcion ajax
    if (lenguaje === "en_US") {
      $.ajax({
        type: "GET",
        url: "ajax.php",
        data:{page:page,lenguaje:lenguaje},
        // data:dataPagin,
        success: function(data) {            
          $('.items').fadeIn(2000).html(data);
          $('.pagination li').removeClass('active');
          $('.pagination li a[data="'+page+'"]').parent().addClass('active');
        }
      });
      return false;
    }else if (lenguaje === "it_IT"){
      $.ajax({
        type: "GET",
        url: "ajax.php",
        data:{page:page,lenguaje:lenguaje},
        success: function(data) {            
          $('.items').fadeIn(2000).html(data);
          $('.pagination li').removeClass('active');
          $('.pagination li a[data="'+page+'"]').parent().addClass('active');
        }
      });
      return false;
      //por ultimo se comprueba que si el idioma por defecto al cargar la pag es español llamara ajax_ve
    }else{
      $.ajax({
        type: "GET",
        url: "ajax_ve.php",
        data:dataPagin,
        success: function(data) {            
          $('.items').fadeIn(2000).html(data);
          $('.pagination li').removeClass('active');
          $('.pagination li a[data="'+page+'"]').parent().addClass('active');
        }
      });
      return false;  
    }
  });
});
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b35294fd0b5a547968246ef/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->