
    <script src="/intranet/componentes/js/jquery.js"></script>
    <script src="/intranet/componentes/js/salvador-app.js"></script>
    <span id='asoc'></span>
    
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["r"])){
        if($_GET["r"] == '1'){ ?>
            <script>
                window.addEventListener('load', exam('4'), false);
            </script>
        <?php } else if($_GET["r"] == '2'){ ?>
            <script>
                window.addEventListener('load', exam('1'), false);
            </script>
        <?php } else if($_GET["r"] == '3'){ ?>
            <script>
                window.addEventListener('load', exam('2'), false);
            </script>
        <?php } else if($_GET["r"] == '3'){ ?>
            <script>
                window.addEventListener('load', exam('4'), false);
            </script>
        <?php } 
        else { echo "error 1"; }
    } else { echo "error 2";}
} else{
    echo "acceso denegado";
}


?>
