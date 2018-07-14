<?php
    function prueba(){
        
        $serverName = "188.165.215.109";
        $connectionOptions = array(
        "Database" => "salvado2_DB",
        "Uid" => "AppSalvador",
        "PWD" => "SvdApp2016"
        );
        //Establishes the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if( $conn ) {
         echo "Conexion establecida.<br />";
    }else{
         echo "Conexion no se pudo establecer.<br />";
         die( print_r( sqlsrv_errors(), true));
    }
        
        
    }
    
function prueba2(){
    $serverName = "localhost\MSSQLSERVER01"; //serverName\instanceName

    // Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
    // La conexión se intentará utilizando la autenticación Windows.
    $connectionInfo = array( "Database"=>"prueba");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
         echo "Conexión establecida.<br />";
    }else{
         echo "Conexión no se pudo establecer.<br />";
         die( print_r( sqlsrv_errors(), true));
    }
}

function prueba3(){
    $serverName = "SISTEMASWEB\MSSQLSERVER01";
    $connectionOptions = array(
        "Database" => "prueba",
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( $conn ) {
         echo "Conexion establecida.<br />";
    }else{
         echo "Conexion no se pudo establecer.<br />";
         die( print_r( sqlsrv_errors(), true));
    }
}

function prueba4(){
    $serverName = "SISTEMASWEB\MSSQLSERVER01";
    $connectionOptions = array(
        "Database" => "prueba",
        //"Uid" => "sa",
        //"PWD" => "your_password"
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    //Insert Query
    echo ("Inserting a new row into table" . PHP_EOL);
    $tsql= "INSERT INTO probando.Employees (Name, Location) VALUES (?,?);";
    $params = array('Jake','United States');
    $getResults= sqlsrv_query($conn, $tsql, $params);
    $rowsAffected = sqlsrv_rows_affected($getResults);
    if ($getResults == FALSE or $rowsAffected == FALSE)
        die(FormatErrors(sqlsrv_errors()));
    echo ($rowsAffected. " row(s) inserted: " . PHP_EOL);

    sqlsrv_free_stmt($getResults);

    //Update Query

    $userToUpdate = 'Nikita';
    $tsql= "UPDATE probando.Employees SET Location = ? WHERE Name = ?";
    $params = array('Sweden', $userToUpdate);
    echo("Updating Location for user " . $userToUpdate . PHP_EOL);

    $getResults= sqlsrv_query($conn, $tsql, $params);
    $rowsAffected = sqlsrv_rows_affected($getResults);
    if ($getResults == FALSE or $rowsAffected == FALSE)
        die(FormatErrors(sqlsrv_errors()));
    echo ($rowsAffected. " row(s) updated: " . PHP_EOL);
    sqlsrv_free_stmt($getResults);

    //Delete Query
    $userToDelete = 'Jared';
    $tsql= "DELETE FROM probando.Employees WHERE Name = ?";
    $params = array($userToDelete);
    $getResults= sqlsrv_query($conn, $tsql, $params);
    echo("Deleting user " . $userToDelete . PHP_EOL);
    $rowsAffected = sqlsrv_rows_affected($getResults);
    if ($getResults == FALSE or $rowsAffected == FALSE)
        die(FormatErrors(sqlsrv_errors()));
    echo ($rowsAffected. " row(s) deleted: " . PHP_EOL);
    sqlsrv_free_stmt($getResults);


    //Read Query
    $tsql= "SELECT Id, Name, Location FROM probando.Employees;";
    $getResults= sqlsrv_query($conn, $tsql);
    echo ("Reading data from table" . PHP_EOL);
    if ($getResults == FALSE)
        die(FormatErrors(sqlsrv_errors()));
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        echo ($row['Id'] . " " . $row['Name'] . " " . $row['Location'] . PHP_EOL);

    }
    sqlsrv_free_stmt($getResults);

    function FormatErrors( $errors )
    {
        /* Display errors. */
        echo "Error information: ";

        foreach ( $errors as $error )
        {
            echo "SQLSTATE: ".$error['SQLSTATE']."";
            echo "Code: ".$error['code']."";
            echo "Message: ".$error['message']."";
        }
    }

}

    function prueba5(){
        
        $serverName = "188.165.215.109";
        $connectionOptions = array(
        "Database" => "salvado2_DB",
        "Uid" => "AppSalvador",
        "PWD" => "SvdApp2016"
        );
        //Establishes the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if( $conn ) {
         //Read Query
        $tsql= "SELECT TOP (10) Email, Usuario, Pais FROM dbo.UsuariosApp;";
        $getResults= sqlsrv_query($conn, $tsql);
        //echo ("Reading data from table" . PHP_EOL);
        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));
        while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
            echo ($row['Email'] . " - " . $row['Usuario'] . " - " . $row['Pais'] . "<br>" . PHP_EOL);
        }
        sqlsrv_free_stmt($getResults);
    }else{
         echo "Conexión no se pudo establecer.<br />";
         die( print_r( sqlsrv_errors(), true));
    }
        
        
    }


prueba();
?>