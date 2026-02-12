<?php
include 'db.php';
$conexion = conectarDB();

if (isset($_POST['btn_actualizar'])) {

    $id = $_POST['campo_id']; // id oculto para saber qué registro modificar
    $nombre = $_POST['campo_nombre'];
    $plataforma = $_POST['campo_plataforma'];

    $sql_update = "UPDATE GAMES SET NOMBRE='$nombre', PLATAFORMA='$plataforma' WHERE ID=$id";

    if (mysqli_query($conexion, $sql_update)) {
        echo "<p style='color: green; font-weight: bold;'>¡Cambios guardados exitosamente!</p>";
        
    } else {
        echo "<p style='color: red;'>Error al actualizar: " . mysqli_error($conexion) . "</p>";
    }
}

if (isset($_GET['id'])) {
    $id_editar = $_GET['id']; // ID del juego a editar

    $sql_buscar = "SELECT * FROM GAMES WHERE ID = $id_editar";

    $resultado = mysqli_query($conexion, $sql_buscar);

    $fila = mysqli_fetch_assoc($resultado);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Datos del Juego</title>
    
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

        .texto-neon { 
            color: #ffffffff; 
            text-shadow: 0 0 5px #ffffff91, 0 0 10px #ffffff96; 
        }
        .texto-ambar {
            color: #ffae00;
            text-shadow: 0 0 15px #ffae00a1;
        }
        .caja-neon { 
            border: 2px solid #ffae00; 
            box-shadow: 0 0 10px #ffae00, inset 0 0 5px #ffae00; 
            background-color: rgba(20, 10, 0, 0.9); 
        }
        .input-retro { 
            background-color: rgba(0, 0, 0, 0.8); 
            border: 2px solid #4b5563; 
            color: #ffae00; 
            font-size: 1.5rem; 
            transition: all 0.3s; 
        }

        .input-retro:focus { 
            outline: none; 
            border-color: #ffae00; 
            box-shadow: 0 0 10px #ffae00; 
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
        
        <h1 class="text-6xl text-center mb-4 uppercase texto-ambar font-bold tracking-widest parpadeo">
            EDITAR JUEGO
        </h1>

        <div class="caja-neon pb-8 px-8 rounded-sm">
            
            <form action="" method="POST" class="space-y-6">
                
                <input type="hidden" name="campo_id" value="<?php echo $fila['ID']; ?>">

                <div>
                    <label class="block text-3xl texto-neon mb-1 uppercase tracking-widest mb-3 font-bold">
                        Nombre del Juego:
                    </label>
                    <input type="text" name="campo_nombre" required 
                           value="<?php echo $fila['NOMBRE']; ?>"
                           class="input-retro w-full p-2 rounded-sm">
                </div>

                <div>
                    <label class="block text-3xl texto-neon mb-1 uppercase tracking-widest mb-3 font-bold">
                        Plataforma:
                    </label>
                    <input type="text" name="campo_plataforma" required 
                           value="<?php echo $fila['PLATAFORMA']; ?>"
                           class="input-retro w-full p-2 rounded-sm">
                </div>

                <div class="pt-4">
                    <input type="submit" name="btn_actualizar" value="[ ACTUALIZAR DATOS ]"
                           class="w-full cursor-pointer bg-amber-900/40 border-2 border-amber-500 text-amber-500 hover:bg-amber-500 hover:text-black font-bold text-3xl py-2 uppercase tracking-widest transition shadow-[0_0_10px_rgba(245,158,11,0.3)] hover:shadow-[0_0_20px_rgba(245,158,11,1)]">
                </div>
            
            </form>
        </div>

        <div class="text-center">
            <a href="games_list_and_delete.php" 
               class="inline-block text-red-500 border-2 border-red-500 px-6 py-2 mt-8 text-xl hover:bg-red-500 hover:text-black transition font-bold uppercase tracking-widest">
               ⬅ CANCELAR EDICIÓN
            </a>
        </div>

    </div>

</body>
</html>