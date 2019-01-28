  <?php
  $option0 = $option1 = $option2 = $option3 = "";
  switch ($language) {
    case 'es_VE':
    $option1 = "selected";
    break;
    
    case 'en_US':
    $option2 = "selected";
    break;

    case 'it_IT':
    $option3 = "selected";
    break;

    default:
    $option0="";
    break;
  }

  ?>

  <div class="fixedlang">
    <select class="dropup" onchange="switchlang(this.value);" data-dropupAuto="false" id="Select2" data-width="fit" data-size="3"> 
      <option value='' <?php echo $option0;?> >Idiomas:</option>
      <option value='es_VE' <?php echo $option1;?> >Español</option>
      <option value='en_US' <?php echo $option2;?> >English</option>
      <option value='it_IT' <?php echo $option3;?> >Italiano</option>
     <!--  <option data-content='<span class="flag-icon flag-icon-us"></span> FR'>Frances</option>
      
      <option data-content='<span class="flag-icon flag-icon-us"></span> ZH'>Mandarín</option>-->
    </select>
  </div>

  <div class="dark-wrapper">
    <div class="container">
 
    </div>
  </div>

  <footer class="footer" id="footer">
    <div class="padding-20">
    <div class="row text-center">
        <div class="thin text-center">
          <h3 class="section-title"><?php echo _('Síguenos'); ?></h3>
          <div class="redes-settings"></div>
        </div>

        <div class="iconos-principal">
            <a target="_blank" href="https://es-la.facebook.com/SalvadorWorld/"><i class="size-iconp fab fa-facebook-f"></i></a>
            <a target="_blank" href="https://www.instagram.com/mundosalvador"><i class="size-iconp fab fa-instagram"></i></a>
            <a target="_blank" href="https://twitter.com/mundosalvador"><i class="size-iconp fab fa-twitter"></i></a>
            <a target="_blank" href="https://www.pinterest.com/mundosalvador/"><i class="size-iconp fab fa-pinterest-p"></i></a>
            <a class="pr-0" target="_blank" href="https://www.youtube.com/user/salvadorpeluqueria"><i class="size-iconp fab fa-youtube"></i></a>
        </div>

      </div>
    </div>
    
    <div class="sub-footer">
      <div class="container">
          <div class="col-sm-12">
            <div class="row">
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
          </div>           
      </div>

      
      <!--<div class="container inner">
        <p class="text-center"><?php echo _('© 2011-2017 Salvador Hairdressing. Todos los derechos reservados.'); ?></p>
      </div>-->
      <!-- /c/img/60-bs.png.container --> 
    </div>
  </footer>

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

<script class="javascript">
  var typed3 = new Typed('#typed3', {
    strings: ['2018', 'Pronto...', 'Un Nuevo Concepto'],
    typeSpeed: 50,
    backSpeed: 30,
    smartBackspace: true, // this is a default
    loop: true
  });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1xdEVYy8IZdBKJGQp_QpDWaNQT7ZHGhY&amp;sensor=false&amp;extension=.js"></script>
<script> google.maps.event.addDomListener(window, 'load', init);
  var map;
  function init() {
    var mapOptions = {
        center: new google.maps.LatLng(51.211215, 3.226287),
        zoom: 15,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.DEFAULT,
        },
        disableDoubleClickZoom: false,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
        },
        scaleControl: true,
        scrollwheel: false,
        streetViewControl: true,
        draggable : true,
        overviewMapControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    styles: [{stylers:[{saturation:-100},{gamma:1}]},{elementType:"labels.text.stroke",stylers:[{visibility:"off"}]},{featureType:"poi.business",elementType:"labels.text",stylers:[{visibility:"off"}]},{featureType:"poi.business",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"poi.place_of_worship",elementType:"labels.text",stylers:[{visibility:"off"}]},{featureType:"poi.place_of_worship",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"road",elementType:"geometry",stylers:[{visibility:"simplified"}]},{featureType:"water",stylers:[{visibility:"on"},{saturation:50},{gamma:0},{hue:"#50a5d1"}]},{featureType:"administrative.neighborhood",elementType:"labels.text.fill",stylers:[{color:"#333333"}]},{featureType:"road.local",elementType:"labels.text",stylers:[{weight:0.5},{color:"#333333"}]},{featureType:"transit.station",elementType:"labels.icon",stylers:[{gamma:1},{saturation:50}]}]
    }

    var mapElement = document.getElementById('map');
    var map = new google.maps.Map(mapElement, mapOptions);
    var locations = [
        ['Boudewijn Ostenstraat 2', 51.211215, 3.226287]
    ];
    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            icon: 'style/images/map-pin.png',
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });
    }
}
</script>