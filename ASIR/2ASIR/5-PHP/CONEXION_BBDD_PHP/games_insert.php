<?php
include 'db.php';
$conexion = conectarDB();

if (isset($_POST['btn_guardar'])) {
    
    $nombre = $_POST['campo_nombre'];
    $plataforma = $_POST['campo_plataforma'];

    $sql = "INSERT INTO GAMES (NOMBRE, PLATAFORMA) VALUES ('$nombre', '$plataforma')";

    if (mysqli_query($conexion, $sql)) {
        echo "<p style='color: green; font-weight: bold;'>¡Juego guardado correctamente!</p>";
    } else {
        echo "<p style='color: red;'>Error al guardar: " . mysqli_error($conexion) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar Juego</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    
    <style>

        body { 
            font-family: 'VT323', monospace; 
        }

        body::before { 
            content: ""; 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            z-index: -1; 
            pointer-events: none;
            background: 
                repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,0.3) 4px), 
                linear-gradient(to bottom, #00111a, #000000); 
        }
        .texto-neon { 
            color: #00ffff; 
            text-shadow: 0 0 5px #00ddddd8, 0 0 20px #00aaaae1; 
        }


        .caja-neon { 
            border: 2px solid #00ffff; 
            box-shadow: 0 0 10px #00ffff, inset 0 0 5px #00ffff; 
            background-color: rgba(0, 10, 20, 0.9); 
        }
        .input-retro { 
            background-color: rgba(0, 0, 0, 0.7); 
            border: 2px solid #334155; 
            color: #00ffff; 
            font-size: 1.5rem; 
            transition: all 0.3s; 
        }
        .input-retro:focus { 
            outline: none; 
            border-color: #00ffff; 
            box-shadow: 0 0 10px #00ffff; 
        }

        .parpadeo { 
            animation: animacionParpadeo 3s infinite; 
        }

        @keyframes animacionParpadeo { 
            0%, 100% { opacity: 1; } 
            50% { opacity: 0.9; } 
        }
    </style>
</head>

<body class="bg-black text-gray-200 p-6 min-h-screen flex flex-col justify-center items-center">

    <div class="container max-w-2xl mx-auto">
        
        <h1 class="text-6xl text-center mb-6 uppercase texto-neon uppercase font-bold tracking-widest parpadeo">
            JUEGO NUEVO
        </h1>

        <div class="caja-neon p-10 rounded-sm">
            
            <form action="" method="POST" class="space-y-6">
                
                <div>
                    <label class="block font-bold text-3xl text-gray-200 mb-1 uppercase tracking-widest">
                        Nombre del Juego:
                    </label>
                    <input type="text" name="campo_nombre" required 
                           class="input-retro w-full p-2 rounded-sm" 
                           placeholder="Ej: GTA V">
                </div>

                <div>
                    <label class="block font-bold text-3xl text-gray-200 mb-1 uppercase tracking-widest">
                        Plataforma:
                    </label>
                    <input type="text" name="campo_plataforma" required 
                           class="input-retro w-full p-2 rounded-sm" 
                           placeholder="Ej: PS5">
                </div>

                <div class="pt-2">
                    <input type="submit" name="btn_guardar" value="[ GUARDAR ]"
                           class="w-full cursor-pointer bg-green-900/40 border-2 border-green-500 text-green-400 hover:bg-green-500 hover:text-black font-bold text-3xl py-2 uppercase tracking-widest transition shadow-[0_0_10px_rgba(34,197,94,0.3)] hover:shadow-[0_0_20px_rgba(34,197,94,1)]">
                </div>
            
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="games_list_and_delete.php" 
               class="inline-block text-yellow-500 border-2 border-yellow-500 px-6 py-1 text-xl hover:bg-yellow-500 hover:text-black transition font-bold uppercase tracking-widest">
               ⬅ CANCELAR / VOLVER
            </a>
        </div>

    </div>

</body>
</html>