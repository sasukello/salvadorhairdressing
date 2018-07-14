<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function menuheader($ubicacion){
    switch($ubicacion){
        case 'cp':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="/intranet">Intranet</a></li>
                <li><a href="#main">Menú</a></li>
                <li><a href="/intranet/cp">Panel de Control</a></li>
                <li><a href="/intranet/logout.php">Salir</a></li>
            </ul>
        </div>
        <?php break;
        case 'desc':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
            <li><a href="./">Sección de Descargas (Administrador)</a></li>
            <li><a href="/intranet/">Volver: Intranet</a></li>
            <li><a href="/intranet/logout.php">Salir</a></li>
            </ul>
        </div>
        <?php break;
        case 'aud':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
            <li><a href="./">Auditorias</a></li>
            <li><a href="/intranet/">Volver: Intranet</a></li>
            <li><a href="/intranet/logout.php">Salir</a></li>
            </ul>
        </div>
        <?php break;
        case 'live':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="./">SalvadorPlus Live</a></li>
                <li><a href="/intranet">Volver: Intranet</a></li>
                <li><a href="/intranet/cp">Panel de Control</a></li>
                <li><a href="/intranet/live/ajustes.php"><i class='pe-7s-tools pe-5x pe-va wow'></i></a></li>
                <li><a href="/intranet/logout.php">Salir</a></li>
            </ul>
        </div>
        <?php break;
        case 'minutas':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="./">Minutas</a></li>
                <li><a href="/intranet/">Volver: Intranet</a></li>
                <li><a href="/intranet/logout.php">Salir</a></li>
            </ul>
        </div>
        <?php break;
        case 'descmin':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="./">Sección de Descargas</a></li>
                <li><a href="/intranet/">Volver: Intranet</a></li>
                <li><a href="/intranet/logout.php">Salir</a></li>
            </ul>
        </div>
       <?php break;
        case 'default':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="/intranet">Intranet</a></li>
                <li><a href="#main">Menú</a></li>
                <li><a href="/intranet/cp">Panel de Control</a></li>
                <li><a href="/intranet/logout.php">Salir</a></li>
            </ul>
        </div>
        <?php break;
    }
}

?>
