<?php
// CONEXION CON MySQL
function conectarDB()
{
    $db = new PDO("mysql:host=localhost;dbname=APP_ACEITUNAS_BBDD;charset=utf8mb4", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}
function realizarQuery($conexion, $texto, $argumentos = null, $isfetch = false)
{
    $comando = $conexion->prepare($texto);
    $comando->execute($argumentos);
    if ($isfetch) return $comando->fetchAll(); 
}
// Inicio conexion a MySQL y Redis
$db = conectarDB();
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// Inserción Y Borrado 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // GESTION INSERT Y DELETE DE VAREADORES
    if (isset($_POST['add_vareador'])) {
        realizarQuery($db, "INSERT INTO vareadores (nombre, edad) VALUES (?, ?)", [$_POST['nombre'], $_POST['edad']]);
        $redis->del("lista_vareadores"); 
        $redis->del("lista_edades");
    }
    if (isset($_POST['del_vareador'])) {
        realizarQuery($db, "DELETE FROM vareadores WHERE id = ?", [$_POST['id']]);
        $redis->del("lista_vareadores");
        $redis->del("lista_edades");
    }

    // GESTION INSERT Y DELETE DE OLIVOS
    if (isset($_POST['add_olivo'])) {
        realizarQuery($db, "INSERT INTO olivos (ubicacion, produccion_kg, finalidad) VALUES (?, ?, ?)", [$_POST['ubicacion'], $_POST['produccion'], $_POST['finalidad']]);
        $redis->del("lista_olivos");
        $redis->del("lista_producciones"); 
    }
    if (isset($_POST['del_olivo'])) {
        realizarQuery($db, "DELETE FROM olivos WHERE id = ?", [$_POST['id']]);
        $redis->del("lista_olivos");
        $redis->del("lista_producciones");
    }

    header("Location: index.php");
    exit;
}

//OBTENER DATOS GENERAL
function obtenerDatosConCache($clave, $sql, $argumentos, $es_numero, $conexion, $redis) {
    if ($redis->exists($clave)) {
        
        $ttl = $redis->ttl($clave);
        return [
            'origen'   => 'REDIS',
            'bg_class' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
            'ttl'      => $ttl,
            'datos'    => json_decode($redis->get($clave), true)
        ];
    } else {

        $datos = realizarQuery($conexion, $sql, $argumentos, true);
        $ttl = $es_numero ? 10 : 60; 
        $redis->setex($clave, $ttl, json_encode($datos));
        
        return [
            'origen'   => 'MySQL',
            'bg_class' => 'bg-amber-100 text-amber-800 border-amber-200',
            'ttl'      => $ttl,
            'datos'    => $datos
        ];
    }
}

// OBTENER DATOS TEXTO
$cacheVareadores = obtenerDatosConCache("lista_vareadores", "SELECT * FROM vareadores ORDER BY id DESC", null, false, $db, $redis);
$cacheOlivos     = obtenerDatosConCache("lista_olivos", "SELECT * FROM olivos ORDER BY id DESC", null, false, $db, $redis);

// OBTENER DATOS NUMERICOS
$cacheEdades = obtenerDatosConCache("lista_edades", "SELECT nombre, edad FROM vareadores ORDER BY id DESC", null, true, $db, $redis);
$cacheProducciones = obtenerDatosConCache("lista_producciones", "SELECT ubicacion, produccion_kg FROM olivos ORDER BY id DESC", null, true, $db, $redis);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Aceitunas</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    .poppins-semibold {
        font-family: "Poppins", sans-serif;
        font-weight: 600;
        font-style: normal;
    }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-dark poppins-semibold p-4 md:p-8">

    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold text-center text-white mb-8 tracking-tight [text-shadow:_0_0_7px_rgb(255_255_255_/_0.5)]">APP Aceitunas BBDD</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">VAREADORES NOMBRE</h2>
                    <span class="<?= $cacheVareadores['bg_class'] ?> text-sm font-bold px-3 py-1 rounded-full border">
                        <?= $cacheVareadores['origen'] ?> | TTL: <span class="ttl-timer"><?= $cacheVareadores['ttl'] ?></span>s
                    </span>
                </div>

                <ul class="divide-y divide-slate-100">
                    <?php foreach ($cacheVareadores['datos'] as $v): ?>
                    <li class="py-3 flex justify-between items-center">
                        <span class="text-md font-medium text-slate-700"><?= htmlspecialchars($v['nombre']) ?></span>
                        <form method="POST" class="m-0">
                            <input type="hidden" name="id" value="<?= $v['id'] ?>">
                            <button type="submit" name="del_vareador" class="text-red-500 hover:text-red-700 hover:bg-red-100 px-2 py-1 rounded text-sm transition-colors">Borrar</button>
                        </form>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">OLIVOS UBICACIÓN</h2>
                    <span class="<?= $cacheOlivos['bg_class'] ?> text-sm font-bold px-3 py-1 rounded-full border">
                        <?= $cacheOlivos['origen'] ?> | TTL: <span class="ttl-timer"><?= $cacheOlivos['ttl'] ?></span>s
                    </span>
                </div>
                
                <ul class="divide-y divide-slate-100">
                    <?php foreach ($cacheOlivos['datos'] as $o): ?>
                    <li class="py-3 flex justify-between items-center">
                        <span class="text-md font-medium text-slate-700"><?= htmlspecialchars($o['ubicacion']) ?></span>
                        <form method="POST" class="m-0">
                            <input type="hidden" name="id" value="<?= $o['id'] ?>">
                            <button type="submit" name="del_olivo" class="text-red-500 hover:text-red-700 hover:bg-red-100 px-2 py-1 rounded text-sm transition-colors">Borrar</button>
                        </form>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">VAREADORES EDAD</h2>
                    <span class="<?= $cacheEdades['bg_class'] ?> text-sm font-bold px-3 py-1 rounded-full border">
                        <?= $cacheEdades['origen'] ?> | TTL: <span class="ttl-timer"><?= $cacheEdades['ttl'] ?></span>s
                    </span>
                </div>

                <ul class="divide-y divide-slate-100">
                    <?php foreach ($cacheEdades['datos'] as $v): ?>
                    <li class="py-3 flex justify-between items-center">
                        <span class="text-md font-medium text-slate-700"><?= $v['edad'] ?> años <span class="text-slate-500 font-normal">- <?= htmlspecialchars($v['nombre']) ?></span></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">OLIVOS PRODUCCIÓN KG</h2>
                    <span class="<?= $cacheProducciones['bg_class'] ?> text-sm font-bold px-3 py-1 rounded-full border">
                        <?= $cacheProducciones['origen'] ?> | TTL: <span class="ttl-timer"><?= $cacheProducciones['ttl'] ?></span>s
                    </span>
                </div>
                
                <ul class="divide-y divide-slate-100">
                    <?php foreach ($cacheProducciones['datos'] as $o): ?>
                    <li class="py-3 flex justify-between items-center">
                        <span class="text-md font-medium text-slate-700"> <?= $o['produccion_kg'] ?> Kg <span class="text-slate-500 font-normal">- <?= htmlspecialchars($o['ubicacion']) ?></span></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <form method="POST" class="m-0">
                    <p class="font-bold text-lg mb-4 text-slate-800">Insertar Vareador</p>
                    <div class="flex gap-2">
                        <input type="text" name="nombre" placeholder="Nombre" required class="w-full border border-slate-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="number" name="edad" placeholder="Edad" required class="w-24 border border-slate-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" name="add_vareador" class="bg-blue-900 hover:bg-blue-800 text-white font-medium px-4 py-2 rounded-md transition-colors">Insertar</button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <form method="POST" class="m-0">
                    <p class="font-bold text-lg mb-4 text-slate-800">Insertar Olivo</p>
                    <div class="flex gap-2">
                        <input type="text" name="ubicacion" placeholder="Ubicación" required class="w-full border border-slate-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="number" name="produccion" placeholder="Produción(Kg)" required class="w-full border border-slate-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <select name="finalidad" class="w-24 border border-slate-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                            <option value="Aceite">Aceite</option>
                            <option value="Aceituna">Aceituna</option>
                        </select>
                        <button type="submit" name="add_olivo" class="bg-blue-900 hover:bg-blue-800 text-white font-medium px-4 py-2 rounded-md transition-colors">Insertar</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <!--Script conteo TTL-->
    <script>
    setInterval(function() {
        var timers = document.getElementsByClassName('ttl-timer');        
        for (var i = 0; i < timers.length; i++) {
            var currentVal = parseInt(timers[i].innerText);
            
            if (currentVal > 0) {
                timers[i].innerText = currentVal - 1;
            } else if (currentVal === 0) {
                window.location.reload(); 
            }
        }
    }, 1000);
    </script>
</body>
</html>