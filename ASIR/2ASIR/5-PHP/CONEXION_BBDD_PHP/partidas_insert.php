<?php
include 'db.php';
$conexion = conectarDB();

if (isset($_POST['btn_guardar'])) {

    $id_game = $_POST['id_game'];
    $id_p1   = $_POST['id_p1'];
    $id_p2   = $_POST['id_p2'];
    $nombre  = $_POST['nombre'];
    $tiempo  = $_POST['tiempo'];

    // Para que no repita el jugador 2 veces o juegue contra sí mismo
    if ($id_p1 == $id_p2) {
        echo "<p style='color: orange;'>El jugador 1 y 2 no pueden ser la misma persona.</p>";
    } else {
        $sql = "INSERT INTO PARTIDAS (ID_GAME, ID_PLAYER1, ID_PLAYER2, NOMBRE, TIEMPO) VALUES ('$id_game', '$id_p1', '$id_p2', '$nombre', '$tiempo')";

        if (mysqli_query($conexion, $sql)) {
            echo "<p style='color: green; font-weight: bold;'>¡Partida registrada!</p>";
        } else {
            echo "<p style='color: red;'>Error: " . mysqli_error($conexion) . "</p>";
        }
    }
}

// Lista games
$sql_lista_games = "SELECT ID, NOMBRE FROM GAMES";
$resul_games = mysqli_query($conexion, $sql_lista_games);

// Lista jugadores
$sql_lista_players = "SELECT ID, ALIAS FROM PLAYERS";
$resul_players = mysqli_query($conexion, $sql_lista_players);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Partida</title>
    
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
                linear-gradient(to bottom, #1e002e, #000000); 
        }
        .texto-neon-violeta { 
            color: #d8b4fe; 
            text-shadow: 0 0 5px #a855f7, 0 0 15px #7e22ce; 
        }
        .caja-neon-violeta { 
            border: 2px solid #a855f7; 
            box-shadow: 0 0 10px #a855f7, inset 0 0 5px #a855f7; 
            background-color: rgba(20, 0, 30, 0.9); 
        }
        .input-base {
            background-color: rgba(0, 0, 0, 0.7);
            font-size: 1.5rem;
            transition: all 0.3s;
            appearance: none;
        }
        .input-base:focus { outline: none; box-shadow: 0 0 15px currentColor; }
        .select-juego {
            border: 2px solid #06b6d4; color: #67e8f9;
        }
        .select-juego:focus { border-color: #22d3ee; }
        .select-p1 {
            border: 2px solid #22c55e; color: #4ade80;
        }
        .select-p1:focus { border-color: #4ade80; }
        .select-p2 {
            border: 2px solid #e879f9; color: #f0abfc;
        }
        .select-p2:focus { border-color: #f0abfc; }
        .input-info {
            border: 2px solid #eab308; color: #fde047;
        }
        .parpadeo { animation: animacionParpadeo 3s infinite; }
        @keyframes animacionParpadeo { 0%, 100% { opacity: 1; } 50% { opacity: 0.9; } }

    </style>
</head>

<body class="bg-black text-gray-200 pt-1 min-h-screen flex flex-col justify-center items-center">

    <div class="container max-w-3xl mx-auto">
        
        <h1 class="text-5xl text-center mb-4 uppercase texto-neon-violeta font-bold tracking-widest parpadeo">
            NUEVA PARTIDA
        </h1>

        <div class="caja-neon-violeta px-8 pb-5 pt-2 rounded-sm">
            
            <form action="" method="POST" class="space-y-1">
                
                <div>
                    <label class="block text-3xl text-cyan-400 mb-1 uppercase tracking-widest font-bold">
                        SELECCIONAR JUEGO:
                    </label>
                    <select name="id_game" required class="input-base select-juego w-full p-2 rounded-sm cursor-pointer">
                        <?php
                        foreach($resul_games as $juego) {
                            echo "<option value='" . $juego['ID'] . "' class='bg-gray-900 text-cyan-300'>" . $juego['NOMBRE'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 pt-4 relative">
                    
                    <div class="hidden md:flex absolute inset-0 justify-center items-center pointer-events-none mt-12">
                        <span class="text-5xl font-bold text-red-600  opacity-80" style="text-shadow: 0 0 10px red;">VS</span>
                    </div>

                    <div>
                        <label class="block text-3xl text-green-400 mb-1 uppercase tracking-widest font-bold">
                            JUGADOR 1 :
                        </label>
                        <select name="id_p1" required class="input-base select-p1 w-full p-2 rounded-sm cursor-pointer">
                            <option value="" class="bg-black text-gray-500">Seleccionar P1</option>
                            <?php
                            foreach($resul_players as $p1) {
                                echo "<option value='" . $p1['ID'] . "' class='bg-gray-900 text-green-400'>" . $p1['ALIAS'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-3xl text-fuchsia-400 mb-1 uppercase tracking-widest md:text-right font-bold">
                            JUGADOR 2:
                        </label>
                        <select name="id_p2" required class="input-base select-p2 w-full p-2 rounded-sm cursor-pointer md:text-left">
                            <option value="" class="bg-black text-gray-500">Seleccionar P2</option>
                            <?php
                            // REBOBINAR LISTA AL PRIMER ELEMENTO PARA MOSTRARLA DE NUEVO ACTUALIZADA
                            mysqli_data_seek($resul_players, 0); 
                            
                            foreach($resul_players as $p2) {
                                echo "<option value='" . $p2['ID'] . "' class='bg-gray-900 text-fuchsia-400'>" . $p2['ALIAS'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                    <div>
                        <label class="block text-3xl text-yellow-400 mb-1 uppercase tracking-widest font-bold">
                            NOMBRE PARTIDA:
                        </label>
                        <input type="text" name="nombre" placeholder="Ej: Gran Final" 
                               class="input-base input-info w-full p-2 rounded-sm">
                    </div>
                    <div>
                        <label class="block text-3xl text-yellow-400 mb-1 uppercase tracking-widest font-bold">
                            TIEMPO (MIN):
                        </label>
                        <input type="number" name="tiempo" placeholder="00" 
                               class="input-base input-info w-full p-2 rounded-sm">
                    </div>
                </div>

                <div class="pt-3">
                    <input type="submit" name="btn_guardar" value="[ GUARDAR ]"
                           class="w-full cursor-pointer bg-green-900/40 border-2 border-green-500 text-green-400 hover:bg-green-500 hover:text-black font-bold text-3xl py-2 uppercase tracking-widest transition shadow-[0_0_10px_rgba(34,197,94,0.3)] hover:shadow-[0_0_20px_rgba(34,197,94,1)]">
                </div>
            
            </form>
        </div>

        <div class="text-center">
            <a href="partidas_list_and_delete.php" 
               class="inline-block text-red-500 border-2 border-red-500 px-6 py-2 mt-4 text-md hover:bg-red-500 hover:text-black transition font-bold uppercase tracking-widest">
               ⬅ CANCELAR / VOLVER
            </a>
        </div>

    </div>

</body>
</html>