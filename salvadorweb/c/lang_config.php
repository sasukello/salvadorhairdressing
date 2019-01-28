<?php

$language = (isset($_REQUEST["language"])) ? trim(strip_tags($_REQUEST["language"])) : "es_VE";
putenv("LC_ALL=$language");
setlocale(LC_ALL, $language);
bindtextdomain("salvador_web", "../locale");
textdomain("salvador_web");

// Idioma
/*$lang = 'en_US';

// Dominio
$text_domain = 'salvador_web';

// Dependiendo de tu OS putenv/setlocale configurarán tu idioma.
putenv('LC_ALL='.$lang);
setlocale(LC_ALL, $lang);

// La ruta a los archivos de traducción
bindtextdomain($text_domain, './locale' );

// El codeset del textdomain
bind_textdomain_codeset($text_domain, 'UTF-8');

// El Textdomain
textdomain($text_domain);*/



/*$language = "en_US";
putenv("LC_ALL=$language");
setlocale(LC_ALL, $language);
bindtextdomain("salvador_web", "../locale");
textdomain("salvador_web");*/


// Cadena de texto de prueba

/*
print "<p><a href=\"" . $_SERVER["PHP_SELF"] . "?language=en_US\">English</a> -
  <a href=\""
    . $_SERVER["PHP_SELF"] . "?language=es_VE\">Español</a></p>\n";

print "<p>" . _("Esta página está en castellano") . "</p>\n";*/


//echo _('Hello World2');
?>