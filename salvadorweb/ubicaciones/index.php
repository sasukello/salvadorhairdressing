<!DOCTYPE html>
<html lang="es_VE">

    <?php 
      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "../locale");
      textdomain("salvador_web");
     ?>

<head>
  <?php include '../c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<title><?php echo _('Ubicaciones'); ?> - Salvador Hairdressing</title>

    <?php include '../c/header.php'; ?>
<link href="/c/css/ubicaciones.css" rel="stylesheet">
<style>
  .lista-salon h3{cursor:pointer;}
</style>
</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include '../c/navbar.php'; ?>
  
  <div class="offset"></div> 
  <div class="light-wrapper">
    <div class="container inner">
      <div class="row col-md-8">
        <div class="title-ubicacion text-center">
          <h1><?php echo _('Ubica un Salón Salvador'); ?></h1>
        </div>
        <div class="row">
          <div class="paises-section">
            <div class="buscar-salon">
              <h2 class="fondobuscar"><?php echo _('Encuentra un salón.'); ?></h2>
                <div class="widget">
                <form class="searchform searchbarp" action="<?php echo $_SERVER['PHP_SELF'].'?lang='.$language; ?>" method="POST">
                  <input class="buscadorsl" type="text" id="autocomplete" name="s" placeholder="<?php echo _('Buscar un salón Salvador'); ?>">
                  <button type="button" class="botonbuscador btn btn-default" style="height: 60px!important; padding-left: 30px!important; padding-right: 30px!important;"><?php echo _('Buscar'); ?></button>
                  <span id="selection"></span>
                  <input type="hidden" name="salonbuscar">
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div id="ubi1">
            <h2 class="fondobuscar"><?php echo _('Estamos en...'); ?></h2> <!-- <i class="budicon-search-3"></i>-->
            <div class="col-md-12 lista-salon">
              <div class="col-md-6">
                  <h3 onclick="showRegionList(1);"><i class="budicon-pin"></i> Venezuela <img src="/c/img/lang/ve1.png"></h3>
                  <h3 onclick="showRegionList(2);"><i class="budicon-pin"></i> Panamá <img src="/c/img/lang/pty1.png"></h3>
                  <h3 onclick="showRegionList(72);"><i class="budicon-pin"></i> <?php echo _('Republica Dominicana'); ?> <img src="/c/img/lang/domrep1.png"></h3>
              </div>
              <!--/column -->

              <div class="col-md-6">
                  <h3 onclick="showRegionList(304);"><i class="budicon-pin"></i> Curazao <img src="/c/img/lang/cu1.png"></h3>
                  <h3 onclick="showRegionList(3);"><i class="budicon-pin"></i> <?php echo _('Estados Unidos'); ?> <img src="/c/img/lang/usa1.png"></h3>
                  <h3 onclick="showRegionList(430);"><i class="budicon-pin"></i> <?php echo _('Italia'); ?> <img src="/c/img/lang/langit.png" style="width: 6%;margin: 0 0 0 5px;"></h3>
              </div>
              <!--/column -->
            </div>
          </div>
        </div>

        <div class="row">
          <span id="ubi2"></span>
        </div>

          <div class="col-sm-12">
          <h3>Google Map</h3>
          <div id="map" style="height: 360px;"></div>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2IJ4em1U2JXd2FS3nXS_PTv1Jre9UmJ8&amp;sensor=false&amp;extension=.js"></script> 
          <script> 
           google.maps.event.addDomListener(window, 'load', init);
           var map;
           function init() {

              var mapOptions = {
                  center: new google.maps.LatLng(10.644708, -71.617942),
                  zoom: 2,
                  mapTypeId: google.maps.MapTypeId.ROADMAP,
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
                    ['', 10.644708, -71.617942], 
                    ['', 10.69191, -71.625538], 
                    ['', 10.671278, -71.653841], 
                    ['', 10.686312, -71.676264], 
                    ['', 10.683023, -71.595283], 
                    ['', 10.683276, -71.595079], 
                    ['', 10.599491, -71.651909],
                    ['', 10.599491, -71.651909],
                    ['', 10.72243, -71.631825], 
                    ['', 10.677646, -71.610432], 
                    ['', 10.67773, -71.606741], 
                    ['', 10.677646, -71.610432], 
                    ['', 10.197774, -71.311827], 
                    ['', 9.572356, -69.198546], 
                    ['', 10.67714, -71.61056],
                    ['', 10.674772, -71.6658582],
                    ['', 8.998310, -71.919407], 
                    ['', 8.985123, -79.51046], 
                    ['', 8.974441, -79.551916], 
                    ['', 9.053828, -79.451323], 
                    ['', 10.683634, -71.622405], 
                    ['', 8.975119, -79.507971],
                    ['', 10.67714, -71.61056],
                    ['', 10.602417, -71.654967], 
                    ['', 10.682285, -71.59584], 
                    ['', 25.825229, -80.372001], 
                    ['', 10.67073, -71.605797], 
                    ['', 10.72243, -71.631825], 
                    ['', 11.685523, -70.173454], 
                    ['', 18.483272, -69.912014],
                    ['', 8.985123, -79.51046],
                    ['', 18.483272, -69.912014], 
                    ['', 10.682032, -71.596527], 
                    ['', 10.557785, -71.6462639], 
                    ['', 10.683023, -71.595283], 
                    ['', 25.825229, -80.372001], 
                    ['', 10.5577029, -71.646312],
                    ['', 9.010006, -79.474765],
                    ['', 9.010006, -79.474765], 
                    ['', 10.682680, -71.606689], 
                    ['', 10.540079, -71.693672], 
                    ['', 10.699488, -71.620029], 
                    ['', 10.348188, -71.418686], 
                    ['', 10.348188, -71.418686],
                    ['', 10.668832, -71.605883],
                    ['', 8.985123, -79.51046],
                    ['', 8.975962, -79.520130],
                    ['', 8.975962, -79.520130], 
                    ['', 8.987183, -79.520249], 
                    ['', 9.053828, -79.451323], 
                    ['', 10.679074, -71.604191], 
                    ['', 12.135799, -68.958284],
                    ['', 10.6690453, -71.607989], 
                    ['', 10.641283, -71.618379], 
                    ['', 10.676095, -71.603723], 
                    ['', 9.0292993, -79.534041], 
                    ['', 9.0292993, -79.534041],
                    ['', 8.9823044, -79.5252941],
                    ['', 9.0690751, -79.4554465],
                    ['Barber Shop Modica', 36.836046, 14.760930],
                    ['Kids Modica', 36.836462, 14.761145]
                ];
                for (i = 0; i < locations.length; i++) {
                    marker = new google.maps.Marker({
                        icon: '/c/img/salvamarker2.png',
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
                        title: "Latitude:"+locations[i][1]+" | Longitude:"+locations[i][2],
                        animation: google.maps.Animation.DROP
                    });
                }  
        }
        
        </script> 
        </div>
        </div>

      <!-- Publicidad -->
      <div class="col-md-3 col-md-offset-1 text-center publicidad">
        <div class="item caption-overlay"><img src="/c/img/fs/fs-ad-1.jpg" alt="" />
          <div class="caption bottom-left box-center">
            <div class="text-center pubcaption">
              <a target="_blank" href="/fsmag.php">
                <span class="text-center">
                  <h2 class="no-margin pubinfo">
                    <span class="subtitle-pub" style="text-transform: none;">FS magazine</span>
                    <br><?php echo _('Edición 37'); ?>
                  </h2>
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-md-offset-1 text-center publicidad">
        <div class="item caption-overlay"><img class="imagen-pub" src="/c/img/maquina.jpg" alt="" />
          <div class="caption bottom-left box-center">
            <div class="text-center pubcaption">
              <a target="_blank" href="http://www.salvadorstore.com/">
                <span class="text-center">
                  <h2 class="no-margin pubinfo">
                    <span class="subtitle-pub"><?php echo _('Maquina Salvador'); ?></span>
                    <br><?php echo _('Tienda On Line'); ?>
                  </h2>
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php include '../c/footer.php'; ?>

</body>
</html>