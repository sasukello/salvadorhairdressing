<?php
    function dbconn() {
  	// Create connection
    $link = mysqli_connect('www.salvadorpeluquerias.com', 'sopor907_cc', 'salvasis1', 'sopor907_salvador');
    // Check connection
    return $link;
    }
?>