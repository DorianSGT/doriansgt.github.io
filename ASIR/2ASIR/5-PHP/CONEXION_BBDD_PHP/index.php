<?php
include 'db.php';
$conexion = conectarDB();

$sql_games = "SELECT COUNT(*) as total FROM GAMES";
$resul_games = mysqli_query($conexion, $sql_games);
$fila_games = mysqli_fetch_assoc($resul_games);

$sql_players = "SELECT COUNT(*) as total FROM PLAYERS";
$resul_players = mysqli_query($conexion, $sql_players);
$fila_players = mysqli_fetch_assoc($resul_players);

$sql_partidas = "SELECT COUNT(*) as total FROM PARTIDAS";
$resul_partidas = mysqli_query($conexion, $sql_partidas);
$fila_partidas = mysqli_fetch_assoc($resul_partidas);

// Jugadores con 2 partidas, con 3 partidas, con más de 3 partidas
$jugadores_con_2 = 0;
$jugadores_con_3 = 0;
$jugadores_mas_3 = 0;

$sql_todos_jugadores = "SELECT ID FROM PLAYERS";
$resultado_todos = mysqli_query($conexion, $sql_todos_jugadores);

while ($jugador = mysqli_fetch_assoc($resultado_todos)) {
    $id_actual = $jugador['ID'];

    $sql_conteo = "SELECT COUNT(*) as cantidad FROM PARTIDAS 
                   WHERE ID_PLAYER1 = $id_actual OR ID_PLAYER2 = $id_actual";
    
    $resul_conteo = mysqli_query($conexion, $sql_conteo);
    $fila_conteo = mysqli_fetch_assoc($resul_conteo);

    $numero_partidas = $fila_conteo['cantidad'];

    if ($numero_partidas == 2) {
        $jugadores_con_2++;
    } elseif ($numero_partidas == 3) {
        $jugadores_con_3++;
    } elseif ($numero_partidas > 3) {
        $jugadores_mas_3++;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Arcade Panel - BD_GAMES</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'VT323', monospace; 
        }
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            pointer-events: none;
            background: 
                repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,0.3) 4px),
                linear-gradient(to bottom, #00111a, #000000); 
        }
        
        .texto-neon-cian {
            color: #00ffff;
            text-shadow: 0 0 5px #00dddd, 0 0 15px #00aaaa;
        }

        .texto-neon-blanco {
            color: #ffffff;
            text-shadow: 0 0 5px #dddddd, 0 0 15px #aaaaaa;
        }

        .texto-neon-ambar {
            color: #ffae00;
            text-shadow: 0 0 5px #ffae00, 0 0 15px #cc8800;
        }

        .texto-neon-verde {
            text-shadow: 0 0 5px green, 0 0 15px darkgreen;
        }

        .caja-neon-cian {
            border: 2px solid #00ffff;
            box-shadow: 0 0 10px #00ffff, inset 0 0 5px #00ffff;
            background-color: rgba(0, 10, 20, 0.85);
        }

        .caja-neon-ambar {
            border: 2px solid #ffae00;
            box-shadow: 0 0 10px #ffae00, inset 0 0 5px #ffae00;
            background-color: rgba(20, 10, 0, 0.85);
        }

        .boton-arcade:hover {
            background-color: #00ffff;
            color: #000;
            box-shadow: 0 0 20px #00ffff;
            transform: scale(1.05); 
        }

        .parpadeo { 
            animation: animacionParpadeo 3s infinite; 
        }

        @keyframes animacionParpadeo {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.9; }
        }

        .letra-rota {
            animation: animacionNeonRoto 4s infinite;
            display: inline-block;
        }

        @keyframes animacionNeonRoto {
            0%, 19%, 21%, 23%, 25%, 54%, 56%, 100% {
                opacity: 1;
                text-shadow: 0 0 5px #00dddd, 0 0 15px #00aaaa;
            }
            20%, 24%, 55% {
                opacity: 0.1; text-shadow: none; 
            }
            22% { opacity: 0.4; }
            70% { opacity: 0; }
            71% { opacity: 1; }
        }
    </style>
</head>

<body class="bg-black text-gray-200 p-6 min-h-screen flex flex-col justify-center items-center">

    <div class="container max-w-3xl mx-auto">
        
        <h1 class="text-6xl text-center mb-4 uppercase texto-neon-cian font-bold" style="letter-spacing: 4px;">
             DB_GAME<span class="letra-rota">S</span>
        </h1>

        <div class="caja-neon-cian pb-6 px-6 pt-1 mb-10 text-center rounded-sm mb-8">
            <h2 class="flex justify-center items-center gap-4 text-4xl mb-6 uppercase texto-neon-blanco border-b border-cyan-500/30  font-bold tracking-widest">
                GESTIONAR
                <img src="img/servidor .png" alt="servidor" class="h-15 w-auto">
            </h2>
            
            <ul class="grid grid-cols-1 md:grid-cols-3 gap-6 uppercase text-2xl">
                <li>
                    <a href="games_list_and_delete.php" class="boton-arcade block border-2 border-cyan-400 text-cyan-300 py-3 px-2 transition-all duration-200 font-bold tracking-widest">
                        [ GAMES ]
                    </a>
                </li>
                <li>
                    <a href="players_list_and_delete.php" class="boton-arcade block border-2 border-cyan-400 text-cyan-300 py-3 px-2 transition-all duration-200 font-bold tracking-widest">
                        [ PLAYERS ]
                    </a>
                </li>
                <li>
                    <a href="partidas_list_and_delete.php" class="boton-arcade block border-2 border-cyan-400 text-cyan-300 py-3 px-2 transition-all duration-200 font-bold tracking-widest">
                        [ PARTIDAS ]
                    </a>
                </li>
            </ul>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="caja-neon-ambar pt-6 rounded-sm relative">
    
                <h3 class="text-4xl pb-4 uppercase text-amber-400 [text-shadow:_0_0_10px_#ffae004d] text-center border-b border-amber-500/30 font-bold">
                    ESTADISTICAS GENERALES 
                </h3>

                <div class="flex justify-between items-center border-b border-amber-500/30 py-2 hover:bg-amber-500/10 transition duration-300 px-4 rounded">
                    <p class="text-amber-200 uppercase text-xl tracking-widest font-bold">TOTAL GAMES</p>
                    <span class="text-4xl text-white font-bold parpadeo texto-neon-ambar"><?php echo $fila_games['total']; ?></span>
                </div>

                <div class="flex justify-between items-center border-b border-amber-500/30 py-2 hover:bg-amber-500/10 transition duration-300 px-4 rounded">
                    <p class="text-amber-200 uppercase text-xl tracking-widest font-bold">TOTAL JUGADORES</p>
                    <span class="text-4xl text-white font-bold parpadeo texto-neon-ambar"><?php echo $fila_players['total']; ?></span>
                </div>

                <div class="flex justify-between items-center hover:bg-amber-500/10 transition duration-300 px-4 rounded py-2">
                    <p class="text-amber-200 uppercase text-xl tracking-widest font-bold">TOTAL PARTIDAS</p>
                    <span class="text-4xl text-white font-bold parpadeo texto-neon-ambar"><?php echo $fila_partidas['total']; ?></span>
                </div>

            </div>

            <div class="caja-neon-ambar pt-6 rounded-sm relative">

                <h3 class="text-4xl uppercase text-amber-400 [text-shadow:_0_0_10px_#ffae004d] text-center border-b border-amber-500/30 pb-4 font-bold">
                     ESTADISTICAS JUGADORES 
                </h3>
                
                <div class="text-xl flex justify-between items-center border-b border-amber-500/30 py-2 px-2 hover:bg-amber-500/10 transition duration-300">
                    <p class="text-amber-200 uppercase text-xl tracking-widest font-bold">En 2 Partidas</p>
                    <div> 
                        <span class="text-4xl text-green-400 font-bold texto-neon-verde"><?php echo $jugadores_con_2; ?></span>
                        <span class="text-xs text-green-200 ml-1">JUGADOR(ES)</span>
                    </div>
                </div>

                <div class="flex justify-between items-center border-b border-amber-500/30 py-2 px-2 hover:bg-amber-500/10 transition duration-300">
                    <p class="text-amber-200 uppercase text-xl tracking-widest font-bold">En 3 Partidas </p>
                    <div>
                        <span class="text-4xl text-green-400 font-bold texto-neon-verde"><?php echo $jugadores_con_3; ?></span>
                        <span class="text-xs text-green-200 ml-1">JUGADOR(ES)</span>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-2 px-2 hover:bg-amber-500/10 transition duration-300">
                    <p class="text-amber-200 uppercase text-xl tracking-widest font-bold">En +3 Partidas </p>
                    <div>
                        <span class="text-4xl text-green-400 font-bold texto-neon-verde"><?php echo $jugadores_mas_3; ?></span>
                        <span class="text-xs text-green-200 ml-1">JUGADOR(ES)</span>
                    </div>
                </div>

            </div>

        </div> 

    </div>

</body>
</html>