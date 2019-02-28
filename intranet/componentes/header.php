    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- CSS Files -->
    <link href="/intranet/componentes/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/intranet/componentes/css/font-awesome.min.css" rel="stylesheet">
    <link href="/intranet/componentes/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
    <link href="/intranet/componentes/css/animate.css" rel="stylesheet" media="screen">
    <!--<link href="/intranet/componentes/css/owl.theme.css" rel="stylesheet">
    <link href="/intranet/componentes/css/owl.carousel.css" rel="stylesheet">
    <link href="/intranet/componentes/css/css-index.css" rel="stylesheet" media="screen"> -->
    <link href="/intranet/componentes/css/css-index-red.css" rel="stylesheet" media="screen">
    <link href="/intranet/componentes/css/est-plugins.css" rel="stylesheet" media="screen">
    <link href="/intranet/componentes/css/estilos.css" rel="stylesheet" media="screen">
    <!-- Google Fonts -->
    <link href="//fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <?php if(isset($_SESSION["tabla_basica"])){ ?>
    <link href="/intranet/componentes/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <?php if(isset($_SESSION["tabla_completa"]) && $_SESSION["tabla_completa"] === "1"){?>
    <link href="/intranet/componentes/datatables/btn/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/intranet/componentes/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/intranet/componentes/datatables/select.dataTables.min.css" rel="stylesheet">
    <?php } if(isset($_SESSION["tabla_responsive"]) && $_SESSION["tabla_responsive"] == 1){?>
    <link href="/intranet/componentes/datatables/rspnsv/responsive.dataTables.min.css" rel="stylesheet">
    <?php }
    } if($_SESSION["ubicacion"] == "ayuda" || $_SESSION["ubicacion"] == "cms"){
        echo '<link href="/intranet/componentes/css/ayuda.css" rel="stylesheet">';
    } else if($_SESSION['ubicacion'] == "live" || $_SESSION['ubicacion'] == "apps"){
        echo '<link href="/intranet/componentes/select/multi-select.css" rel="stylesheet">';
    } ?>