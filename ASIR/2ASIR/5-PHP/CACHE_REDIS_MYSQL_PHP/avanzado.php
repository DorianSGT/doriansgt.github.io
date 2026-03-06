<?php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// HASHES
echo "<h3>Trabajar con hashes</h3>";

$redis->hSet("usuario:1", "nombre", "Dorian");
$redis->hSet("usuario:1", "edad", "19");

$edad = $redis->hGet("usuario:1", "edad");
echo "La edad del usuario es: " . $edad . "<br>";

$usuario = $redis->hGetAll("usuario:1");
echo "Datos completos del usuario:<br>";
print_r($usuario);

// LISTAS
echo "<h3>Trabajar con listas</h3>";
$redis->lPush("mis_tareas", "hacer PHP redis", "hacer Flask Gordon");
$tareas = $redis->lRange("mis_tareas", 0, -1);

echo "<br>Lista de tareas:<br>";

print_r($tareas);

$ultimaTarea = $redis->rPop("mis_tareas");
echo "<br>Tarea con menos prioridad ahora mismo: " . $ultimaTarea . "<br>";

$redis->close();
?>