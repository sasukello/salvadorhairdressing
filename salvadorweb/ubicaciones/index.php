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
                  <h3 id="Panamab" onclick="showRegionList(2);"><i class="budicon-pin"></i> Panamá <img src="/c/img/lang/pty1.png"></h3>
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
           // google.maps.event.addDomListener(window, 'load', init);
           // var map;
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
                    ['Ciudad Chinita - Dirección:C.C Ciudad Chinita Local PA 27', 10.644708, -71.617942], 
                    ['Delicias Norte - Dirección:C.C. Delicias Norte 2da. Etapa Local PA 177', 10.69191, -71.625538], 
                    ['Galerias - Dirección:C.C Galerias Mall 1er Nivel Local P43B', 10.671278, -71.653841], 
                    ['La Limpia - Dirección:C.C Limpia Plaza (De Candido La Limpia) Local PB.L-3', 10.686312, -71.676264], 
                    ['Lago Mall Nivel Feria - Dirección:C.C. Lago Mall, local FC-5, Nivel Feria.', 10.683023, -71.595283], 
                    ['Lago Mall - Nivel 1 - Dirección:C.C. Lago Mall, Nivel 1 Local PNC 26-A', 10.683276, -71.595079], 
                    ['Centro Sur 2 - Dirección:C.C Babilon Centro Sur  Local A-01-E', 10.599491, -71.651909],
                    ['Centro Sur 1 - Dirección:C.C Babilon Centro Sur Local A-01-E', 10.599491, -71.651909],
                    ['Sambil Maracaibo - Dirección:C.C Sambil Local L-36', 10.72243, -71.631825], 
                    ['Kids Cecilio Acosta - Dirección:Edif. Egeon Calle 67 Cecilio Acosta con Av. 8A', 10.6770862, -71.61020],
                    ['Cecilio Acosta - Dirección:Edif. Egeon Cecilio Acosta con 8A', 10.6770862, -71.61020], 
                    // ['', 10.677646, -71.610432], 
                    ['Express 5 de Julio - Dirección:Calle 77. CC. San Luis Nivel PB Local 9. Sector El Paraíso, Maracaibo',10.6629807,-71.6242417],
                    ['Uomo Albrook - Dirección:Centro Comercial Albrook Mall pasillo Leon',8.9745186,-79.5539113],

                    ['Costa Verde - Dirección:C.C. Costa Verde Local PA. 21', 10.67773, -71.606741], 
                    // ['', 10.677646, -71.610432], 
                    ['Ciudad Ojeda - Dirección:Apart Hotel Ojeda Suite. CC Plaza Zulia Nivel PB', 10.197774, -71.311827], 
                    ['Acarigua: Dirección:CC Llano Mall Nivel 1 Local PA-113', 9.572356, -69.198546], 
                    // ['', 10.67714, -71.61056],
                    ['Las Tunas - Dirección:Av. 74. C.C. Las Tunas, Nivel PB, Local 11', 10.674772, -71.6658582],
                    ['Santa Barbara - Dirección:Av 6-A2 # 2 Sector Centro Santa Barbara. Boulevard', 8.998310, -71.919407], 
                    ['Multiplaza UOMO - Dirección:C.C. Multiplaza Pacific. Planta baja local A-285 AL LADO DE MULTIMAX PANAMÁ', 8.985123, -79.51046], 
                    ['Albrook - Dirección:C.C Albrook mall corregimiento Ancon PANAMÁ', 8.974441, -79.551916], 
                    ['Metro Mall Kids - Dirección:Nivel 200 local C174 Detrás del Food Court PANAMÁ', 9.053828, -79.451323], 
                    ['El Pilar - Dirección:Av 14B #60-44. Sector Las Tarabas', 10.683634, -71.622405], 
                    ['Trump Ocean Club Panama - Dirección:Local S-06,Punta Pacífica. Trump Ocean Club Inter PANAMÁ', 8.975119, -79.507971],
                    ['Maruma - Dirección:C.C Crowne Plaza Maruma PB.', 10.602417, -71.654967],
                    // ['', 10.67714, -71.61056],
                    // ['', 10.602417, -71.654967],//Maruma 
                    ['Lago Mall Kids - Dirección:CC Lago Mall Nivel Feria local FC01E', 10.682285, -71.59584], 
                    ['Doral Miami Express - Dirección:10812 NW 58th St. Doral, Fl 33178', 25.825229, -80.372001], 
                    ['SALVADOR72 - Dirección:Calle 72 con Ave 3H Centro Comercial Las Tinajitas', 10.67073, -71.605797], 
                    ['Sambil Maracaibo - Dirección:C.C Sambil, local L3B (Al lado de World Music)', 10.72243, -71.631825], 
                    ['Sambil Paraguana - Dirección:Sambil Paraguana. Local L220, Diagonal a CINEX', 11.685523, -70.173454], 
                    ['Sambil Sto. Domingo Express - Dirección:Av. John F. Kennedy con Maximo Gomez. SAMBIL Santo Domingo, Nivel Acuario Local AC-5284', 18.483272, -69.912014],
                    ['Multiplaza - Dirección:C.C. Multiplaza Pacific. Ciudad de Panamá', 8.985123, -79.51046],//Multiplaza UOMO
                    ['Sambil Sto. Domingo UOMO - Dirección:AV. John F. Kennedy con Maximo Gomez. SAMBIL Santo', 18.483272, -69.912014], 
                    ['Intercontinental Maracaibo - Dirección:Hotel Intercontinental Maracaibo, Av. 2 El Milagro', 10.682032, -71.596527], 
                    ['La Coromoto - Dirección:Calle 171 C.C. Luciana Country Nivel PB Local 45-82D. Urb. La Coromoto, Municipio San Francisco', 10.557785, -71.6462639], 
                    ['Lago Mall - Dirección:Av 2 C.C. Lago Mall Nivel 1 Local PNC 26. Maracaibo. Edo. Zulia', 10.683023, -71.595283], 
                    ['Doral Miami Kids - Dirección:C.C. Delia Plaza local #10812 NW 58th St. Doral', 25.825229, -80.372001], 
                    // ['', 10.5577029, -71.646312],
                    ['Barber Shop Pacific Center - Dirección:Pacific Center. Ciudad de Panamá',8.9783916,-79.5127475],
                    ['Costa del Este - Dirección:Costa del Este Avenida La Rotonda, Local #5 al lado del Hotel Westin', 9.010006, -79.474765],
                    ['Costa del Este - Dirección:Costa del Este Avenida La Rotonda, Local #108 1er Piso al lado del Hotel Westin', 9.010006, -79.474765], 
                    ['Las Mercedes - Dirección:AV. UNIVERSIDAD CON AV. 4, LOCAL S/N SECTOR BELLA VISTA, MARACAIBO', 10.682680, -71.606689], 
                    ['Los Samanes - Dirección:Av.50, Calle 200. C.C. El Saman, 1er Nivel', 10.540079, -71.693672], 
                    ['Canta Claro - Dirección:C.C. Paseo Canta Claro Calle 45 con Av. 12 Sector Urb. Rosal Sur, Local P1- 6', 10.699488, -71.620029], 
                    ['Costa Mall - Dirección:C.C Costa Mall Av. Intercomunal sector Punta Gorda', 10.348188, -71.418686], 
                    ['Costa Mall Kids - Dirección:C.C. Costa Mall Av. Intercomunal sector Punta Gorda, Cabimas', 10.348188, -71.418686],
                    ['Plaza 75 Instituto - Dirección:C.C. Plaza 75, P1, Local 21. AV. 3H con Calle 75', 10.668832, -71.605883],
                    ['Multiplaza Kids - Dirección:C.C Multiplaza Vi­a Israel por la entrada de vivas Smith, Diagonal a Lego, Local B-192 PANAMÁ', 8.985123, -79.51046],//Multiplaza UOMO
                    ['Balboa Boutique UOMO- Dirección:C.C. Balboa Boutiques planta baja, Local B-003 PANAMÁ', 8.975962, -79.520130],
                    ['Balboa Boutique Instituto - Dirección:C.C. Balboa Boutiques  planta alta, Local B-106 A PANAMÁ', 8.975962, -79.520130], 
                    // ['', 8.987183, -79.520249], 
                    ['Metro Mall Instituto - Dirección:Nivel 100 local B101 (Entrada Lateral del Machetazo) PANAMÁ', 9.053828, -79.451323],//Metro Mall - Kids 
                    ['Nailsbar Don Bosco - Dirección:Av 3F con Calle 65 C.C. Bianco Niel PB Local 1-1Sector Don Bosco', 10.679074, -71.604191], 
                    ['Sambil Curazao - Express/ Kids - Dirección:Veeris #27 C.C. Sambil Curacao, Local #101. Willem', 12.135799, -68.958284],
                    ['Plaza 75 - Kids - Dirección:C.C. Plaza 75, PB. Av. 3H con Calle 75.', 10.6690453, -71.607989], 
                    ['Cima - Dirección:C.C. Cima Local 48 y 54 Av. Libertador  con  Av. Delicias', 10.641283, -71.618379], 
                    ['Camoruco - Dirección:Avenida Cecilio Acosta Calle 67 Entre Avs. 3D Y 3E (Diagonal al colegio Bella Vista)', 10.676095, -71.603723], 
                    ['Alta Plaza Instituto - Dirección:Av. Centenario, Alta Plaza Mall, Nivel 200 local 2-211 PANAMÁ', 9.0292993, -79.534041], 
                    ['Alta Plaza - Dirección:Av. Centenario, Alta Plaza Mall, Nivel 200 local 2-211 Nivel 200 Local #2-415 PANAMÁ', 9.0292993, -79.534041],
                    ['Obarrio - Dirección:C.C Plaza Penta, Nivel 100 PANAMÁ', 8.9823044, -79.5252941],
                    ['Brisas Mall Uomo - Dirección:Centro Comercial Brisas Mall, Local #8. San Miguel Sector Brisas del Golf PANAMÁ', 9.0690751, -79.4554465],
                    ['Eyebrows & Makeup Concordia - Dirección:Plaza Concordia, Vía España, Corregimiento de Bella Vista, Distrito de Panamá. Local  12-A',8.9848035,-79.526127],
                    ['Town Center Instituto - Dirección:Centro Comercial Town Center local R3-304 PANAMÁ',9.0140995,-79.4658862],
                    ['Barber Shop Modica - Dirección: VIA SACRO CUORE, 114-118. 97015 MODICA RG-ITALIA', 36.836046, 14.760930],
                    ['Kids Modica - Dirección: VIA SACRO CUORE, 114-118. 97015 MODICA RG, ITALIA', 36.836462, 14.761145]
                ];
                var infowindow = new google.maps.InfoWindow();
                var marker, i;
                for (i = 0; i < locations.length; i++) {
                    marker = new google.maps.Marker({
                        icon: '/c/img/salvamarker2.png',
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
                        title: "Latitude:"+locations[i][1]+" | Longitude:"+locations[i][2],
                        animation: google.maps.Animation.DROP
                    });
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        map.setZoom(12);
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                    })(marker, i));
                }  
        }
        google.maps.event.addDomListener(window, 'load', init);
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