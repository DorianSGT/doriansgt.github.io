<?php
include 'db.php';
$conexion = conectarDB();

if (isset($_POST['btn_actualizar'])) {
    $id      = $_POST['campo_id'];
    $id_game = $_POST['id_game'];
    $id_p1   = $_POST['id_p1'];
    $id_p2   = $_POST['id_p2'];
    $nombre  = $_POST['nombre'];
    $tiempo  = $_POST['tiempo'];

    $sql_update = "UPDATE PARTIDAS SET ID_GAME='$id_game', ID_PLAYER1='$id_p1', ID_PLAYER2='$id_p2', NOMBRE='$nombre', TIEMPO='$tiempo' WHERE ID=$id";

    if (mysqli_query($conexion, $sql_update)) {
        echo "<p style='color: green; font-weight: bold;'>¡EDLB Partida editada!</p>";
        
        $fila['ID_GAME']    = $id_game;
        $fila['ID_PLAYER1'] = $id_p1;
        $fila['ID_PLAYER2'] = $id_p2;
        $fila['NOMBRE']     = $nombre;
        $fila['TIEMPO']     = $tiempo;
    } else {
        echo "<p style='color: red;'>Error al editar: " . mysqli_error($conexion) . "</p>";
    }
}

if (isset($_GET['id'])) {
    $id_editar = $_GET['id'];
    $sql = "SELECT * FROM PARTIDAS WHERE ID = $id_editar";
    $resul = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_assoc($resul);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Partida</title>
    
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
        .texto-neon-azul { 
            color: #00ffff; 
            text-shadow: 0 0 5px #00dddd, 0 0 15px #00aaaa; 
        }
        .caja-neon-azul { 
            border: 2px solid #00ffff; 
            box-shadow: 0 0 10px #00ffff, inset 0 0 5px #00ffff; 
            background-color: rgba(0, 10, 20, 0.9); 
        }
        .input-base {
            background-color: rgba(0, 0, 0, 0.7);
            font-size: 1.5rem;
            transition: all 0.3s;
            padding: 0.5rem;
            width: 100%;
            border-radius: 0.125rem; 
        }
        .input-base:focus { outline: none; }
        .input-juego { border: 2px solid #06b6d4; color: #67e8f9; }
        .input-juego:focus { border-color: #22d3ee; box-shadow: 0 0 10px #22d3ee; }
        .input-p1 { border: 2px solid #22c55e; color: #4ade80; }
        .input-p1:focus { border-color: #4ade80; box-shadow: 0 0 10px #4ade80; }
        .input-p2 { border: 2px solid #e879f9; color: #f0abfc; }
        .input-p2:focus { border-color: #f0abfc; box-shadow: 0 0 10px #f0abfc; }
        .input-info { border: 2px solid #38bdf8; color: #bae6fd; }
        .input-info:focus { border-color: #38bdf8; box-shadow: 0 0 10px #38bdf8; }

        .parpadeo { animation: animacionParpadeo 3s infinite; }
        @keyframes animacionParpadeo { 
            0%, 100% { opacity: 1; } 50% { opacity: 0.9; } 
        }
    </style>
</head>

<body class="bg-black text-gray-200 pb-6 pt-1 min-h-screen flex flex-col justify-center items-center">

    <div class="container max-w-3xl mx-auto">
        
        <h1 class="text-5xl text-center mb-4 uppercase texto-neon-azul font-bold tracking-widest parpadeo">
            EDITAR PARTIDA 
        </h1>

        <div class="caja-neon-azul px-8 pb-6 pt-1 rounded-sm">
            
            <form action="" method="POST" class="space-y-1">
                
                <input type="hidden" name="campo_id" value="<?php echo $fila['ID']; ?>">

                <div>
                    <label class="block text-2xl font-bold text-cyan-400 mb-1 uppercase tracking-widest">
                        ID JUEGO:
                    </label>
                    <input type="number" name="id_game" required 
                           value="<?php echo $fila['ID_GAME']; ?>"
                           class="input-base input-juego">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                    <div>
                        <label class="block text-2xl font-bold text-green-400 mb-1 uppercase tracking-widest">
                          ID PLAYER 1:
                        </label>
                        <input type="number" name="id_p1" required 
                               value="<?php echo $fila['ID_PLAYER1']; ?>"
                               class="input-base input-p1">
                    </div>

                    <div>
                        <label class="block text-2xl font-bold text-fuchsia-400 mb-1 uppercase tracking-widest md:text-right">
                            ID PLAYER 2:
                        </label>
                        <input type="number" name="id_p2" required 
                               value="<?php echo $fila['ID_PLAYER2']; ?>"
                               class="input-base input-p2 md:text-right">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                    <div>
                        <label class="block font-bold text-2xl text-cyan-200 mb-1 uppercase tracking-widest">
                            NOMBRE PARTIDA:
                        </label>
                        <input type="text" name="nombre" 
                               value="<?php echo $fila['NOMBRE']; ?>"
                               class="input-base input-info">
                    </div>
                    <div>
                        <label class="block font-bold text-2xl text-cyan-200 mb-1 uppercase tracking-widest">
                            TIEMPO (MIN):
                        </label>
                        <input type="number" name="tiempo" 
                               value="<?php echo $fila['TIEMPO']; ?>"
                               class="input-base input-info">
                    </div>
                </div>

                <div class="pt-6">
                    <input type="submit" name="btn_actualizar" value="[ ACTUALIZAR DATOS ]"
                           class="w-full cursor-pointer bg-cyan-900/40 border-2 border-cyan-500 text-cyan-400 hover:bg-cyan-500 hover:text-black font-bold text-3xl py-2 uppercase tracking-widest transition shadow-[0_0_10px_rgba(6,182,212,0.3)] hover:shadow-[0_0_20px_rgba(6,182,212,1)]">
                </div>
            
            </form>
        </div>

        <div class="mt-3 text-center">
            <a href="partidas_list_and_delete.php" 
               class="inline-block text-amber-500 border-2 border-amber-500 px-6 py-2 text-xl hover:bg-amber-500 hover:text-black transition font-bold uppercase tracking-widest shadow-[0_0_5px_rgba(245,158,11,0.3)] hover:shadow-[0_0_15px_rgba(245,158,11,1)]">
               ⬅ CANCELAR EDICIÓN
            </a>
        </div>

    </div>

</body>
</html>