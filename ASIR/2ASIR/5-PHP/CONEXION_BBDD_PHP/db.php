<?php
function conectarDB() {
    
    $host = "localhost";
    $user = "root";
    $pass = ""; 
    $db_name = "BD_GAMES_PHP"; 

    $conexion = mysqli_connect($host, $user, $pass, $db_name);

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    } else {
        // echo "Conexión exitosa a la base de datos de GAMES.";
    }

    return $conexion; 
}
// conectarDB();
?>