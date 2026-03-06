<?php
// Conectar a Redis
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// Probar conexión
if ($redis->ping()) {
    echo "Conexión exitosa a Redis: " . $redis->ping() . "<br>"; // Debería devolver "PONG"
}

// Establecer y obtener una clave
$redis->set("curso", "ASIR Redis en PHP");
echo "Valor de 'curso': " . $redis->get("curso") . "<br>";

// Cerrar conexión
$redis->close();
?>