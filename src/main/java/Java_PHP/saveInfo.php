<?php
//Credenciales de la base de datos
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "example_database";
//Se crea la conexión con la base d datos
$db_connection = mysql_connect($db_host, $db_user, $db_password);
if (!$db_connection) {
    die('No se ha podido conectar a la base de datos');
}
//Se empieza a construir el query para insertar los datos
$query = "INSERT INTO " . $db_name . ".";
foreach ($_POST as $key => $value) {
    if (($key) == "table_name") {
        $query = $query . $value . " (";
    } else {
        $query = $query . $key . ", ";
    }
}
$query = $query . "_";
$query = str_replace(", _", ") VALUES (", $query);
foreach ($_POST as $key => $value) {
    if ($key != "table_name") {
        $query = $query . "\"" . $value . "\", ";
    }
}
//Se corrige el query
$query = $query . "_";
$query = str_replace(", _", ")", $query);
//Se insertan los datos en la base de datos
mysql_select_db($db_name, $db_connection);
$retry_value = mysql_query($query, $db_connection);
if (!$retry_value) {
    die('Error: ' . mysql_error());
}
mysql_close($db_connection);
?>
