<?php
include 'db.php';
$conexion = conectarDB();

// Si le dieron al botón...
if (isset($_POST['btn_guardar'])) {
    
    $alias  = $_POST['campo_alias'];
    $nombre = $_POST['campo_nombre'];
    $nivel  = $_POST['campo_nivel'];

    $sql = "INSERT INTO PLAYERS (ALIAS, NOMBRE, NIVEL) VALUES ('$alias', '$nombre', '$nivel')";

    if (mysqli_query($conexion, $sql)) {
        echo "<p style='color: green; font-weight: bold;'>¡Jugador creado correctamente!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . mysqli_error($conexion) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Jugador</title>
    
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
                linear-gradient(to bottom, #1a001a, #000000);
        }
        .sombra-morado { 
            text-shadow: 0 0 5px #b146efda, 0 0 20px #b146efbd; 
        }
        .caja-neon-morado { 
            border: 2px solid #b146efff; 
            box-shadow: 0 0 10px #b146efff, inset 0 0 5px #b146efff; 
            background-color: rgba(20, 0, 20, 0.9);
        }
        .input-retro { 
            background-color: rgba(0, 0, 0, 0.7); 
            border: 2px solid #701a75; 
            color: #b146efff; 
            font-size: 1.5rem; 
            transition: all 0.3s; 
        }

        .input-retro:focus { 
            outline: none; 
            border-color: #b146efff; 
            box-shadow: 0 0 10px #b146efff; 
            color: white;
        }

        .parpadeo { animation: animacionParpadeo 3s infinite; }
        @keyframes animacionParpadeo { 
            0%, 100% { opacity: 1; } 50% { opacity: 0.9; } 
        }
    </style>
</head>

<body class="bg-black text-gray-200 p-6 min-h-screen flex flex-col justify-center items-center">

    <div class="container max-w-xl mx-auto">
        <h1 class="text-6xl text-center text-fuchsia-400 mb-2 uppercase sombra-morado font-bold tracking-widest parpadeo">
            NUEVO JUGADOR
        </h1>

        <div class="caja-neon-morado px-8 pt-2 pb-6 rounded-sm">

            <form action="" method="POST" class="space-y-4">
                
                <div>
                    <label class="block text-2xl text-fuchsia-400 mb-1 uppercase tracking-widest font-bold">
                        ALIAS:
                    </label>
                    <input type="text" name="campo_alias" required 
                           class="input-retro w-full p-2 rounded-sm" 
                           placeholder="Ej: Joseador">
                </div>

                <div>
                    <label class="block text-2xl text-fuchsia-400 mb-1 uppercase tracking-widest font-bold">
                        NOMBRE REAL:
                    </label>
                    <input type="text" name="campo_nombre" required 
                           class="input-retro w-full p-2 rounded-sm" 
                           placeholder="Ej: Raúl">
                </div>

                <div>
                    <label class="block text-2xl text-fuchsia-400 mb-1 uppercase tracking-widest font-bold">
                        NIVEL:
                    </label>
                    <input type="number" name="campo_nivel" required 
                           class="input-retro w-full p-2 rounded-sm" 
                           placeholder="0 - 100 ">
                </div>

                <div >
                    <input type="submit" name="btn_guardar" value="[ GUARDAR ]"
                           class="w-full cursor-pointer bg-green-900/40 border-2 border-green-500 text-green-400 hover:bg-green-500 hover:text-black font-bold text-3xl py-2 uppercase tracking-widest transition shadow-[0_0_10px_rgba(34,197,94,0.3)] hover:shadow-[0_0_20px_rgba(34,197,94,1)]">
                </div>
            
            </form>
        </div>

        <div class="mt-5 text-center">
            <a href="players_list_and_delete.php" 
               class="inline-block text-yellow-500 border-2 border-yellow-500 px-5 py-1 text-xl hover:bg-yellow-500 hover:text-black transition font-bold uppercase tracking-widest">
               ⬅ CANCELAR / VOLVER
            </a>
        </div>

    </div>

</body>
</html>