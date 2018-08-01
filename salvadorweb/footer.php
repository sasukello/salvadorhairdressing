  <!--  Language  -->
  <div class="fixedlang">
    <select class="dropup form-control selectpicker" data-dropupAuto="false" id="Select2" data-width="40%" data-size="3"> 
      <option data-content='<span class="flag-icon flag-icon-us"></span> EN'>English</option>
      <option  data-content='<span class="flag-icon flag-icon-mx"></span> ES'>Español</option>
      <!--option data-content='<span class="flag-icon flag-icon-us"></span> FR'>Frances</option>
      <option  data-content='<span class="flag-icon flag-icon-mx"></span> IT'>Italiano</option>
      <option data-content='<span class="flag-icon flag-icon-us"></span> ZH'>Mandarín</option-->
    </select>
  </div>

  <div class="light-wrapper">
    <div class="container">
      <div class="row text-center">

        <div class="thin text-center" style="padding-top: 5%;">
          <h3 class="section-title"><?php echo _('Síguenos'); ?></h3>
          <div style="border-bottom: 2px solid; width: 80px; margin-left: auto; margin-right: auto;"></div>
        </div>

        <div class="iconos-principal">
            <a target="_blank" href="https://es-la.facebook.com/SalvadorWorld/"><i class="size-iconp fab fa-facebook-f"></i></a>
            <a target="_blank" href="https://www.instagram.com/mundosalvador"><i class="size-iconp fab fa-instagram"></i></a>
            <a target="_blank" href="https://twitter.com/mundosalvador"><i class="size-iconp fab fa-twitter"></i></a>
            <a target="_blank" href="https://www.pinterest.com/mundosalvador/"><i class="size-iconp fab fa-pinterest-p"></i></a>
            <a target="_blank" href="https://www.youtube.com/user/salvadorpeluqueria"><i class="size-iconp fab fa-youtube" style="padding-right: 0;"></i></a>
        </div>

      </div> 
    </div>
  </div>

  <!-- /.light-wrapper -->
  <footer class="footer inverse-wrapper" id="footer">
    <div class="padding-50">
      <div class="row">
        <!--<div class="col-sm-12">
        <div class="col-sm-4 col-sm-offset-4">
          <div class="widget text-center">
            <h4 class="widget-title">Suscríbete al Boletín</h4>
            <form class="searchform" method="get">
              <input type="text" id="s2" name="s" value="Ingresa tu correo electronico" onfocus="this.value=''" onblur="this.value='Suscribete'">
              <button type="submit" class="btn btn-default">Aceptar</button>
            </form><p></p><p></p>
          </div>
        </div>
        </div>-->
        <div class="col-sm-12 onmob-pad">
            <div class="widget">
                <div class="text-center">
                  <h5 id="onmob-line">
                    <?php echo _('<a class="link-footer" href="/nosotros.php">NOSOTROS</a>'); ?>
                    <?php echo _('<a class="link-footer" href="/servicios.php">SERVICIOS</a>'); ?>
                    <?php echo _('<a class="link-footer" href="/modelos/">MODELOS DE NEGOCIO</a>'); ?>
                    <?php echo _('<a class="link-footer" href="/franquicias">FRANQUICIAS</a>'); ?>
                    <?php echo _('<a class="link-footer" href="/ubicaciones">UBICACIONES</a>'); ?>
                    <?php echo _('<a class="link-footer" href="/contacto.php">CONTACTO</a>'); ?>
                  </h5>
                </div>
            </div>
        </div>       
      </div>
      <!-- /.row --> 
    </div>
    <!-- .container -->
    
    <div class="sub-footer">
      <div class="container inner">
        <p class="text-center"><?php echo _('© 2011-2017 Salvador Hairdressing. Todos los derechos reservados.'); ?></p>
      </div>
      <!-- .container --> 
    </div>
    <!-- .sub-footer --> 
  </footer>
  <!-- /footer --> 
  
</main>
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

<script>
  $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
  });
</script>

<script type="text/javascript">
  $(function(){
    $('.selectpicker').selectpicker();
});
</script>