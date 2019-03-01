<?php
function dbconnlocal2()
{
    // Create connection
    $link = mysqli_connect('www.salvadorhairdressing.com', 'sopor907', 'H@Th9r9R5VH9', 'sopor907_academiadata');
    // Check connection
    if (!$link) {
        //header('location: /mysteryshopper/index.php');
        // alert("ERROR");
        return $link;
    }
    return $link;
}

// function dbconnlocal2()
// {
//     // Create connection
//     $link = mysqli_connect('localhost', 'root', '', 'sopor907_academiadata');
//     // Check connection
//     if (!$link) {
//         //header('location: /mysteryshopper/index.php');
//         // alert("ERROR");
//         return $link;
//     }
//     return $link;
// }
 