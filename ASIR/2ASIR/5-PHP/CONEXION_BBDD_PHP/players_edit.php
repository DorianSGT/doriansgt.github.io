<?php
include 'db.php';
$conexion = conectarDB();

if (isset($_POST['btn_actualizar'])) {

    $id     = $_POST['campo_id']; // ID oculto para saber qué registro modificar

    $alias  = $_POST['campo_alias'];
    $nombre = $_POST['campo_nombre'];
    $nivel  = $_POST['campo_nivel'];

    $sql_update = "UPDATE PLAYERS SET ALIAS='$alias', NOMBRE='$nombre', NIVEL='$nivel' WHERE ID=$id";

    if (mysqli_query($conexion, $sql_update)) {
        echo "<p style='color: green; font-weight: bold;'>¡Jugador actualizado!</p>";

        $fila['ALIAS']  = $alias;
        $fila['NOMBRE'] = $nombre;
        $fila['NIVEL']  = $nivel;
    } else {
        echo "<p style='color: red;'>Error: " . mysqli_error($conexion) . "</p>";
    }
}


if (isset($_GET['id'])) {
    $id_editar = $_GET['id'];
    
    $sql_buscar = "SELECT * FROM PLAYERS WHERE ID = $id_editar";
    
    $resultado = mysqli_query($conexion, $sql_buscar);
    
    $fila = mysqli_fetch_assoc($resultado);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Jugador</title>
    
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
                linear-gradient(to bottom, #062133ff, #000000); 
        }
        .texto-neon-celeste { 
            color: #84f3ffff; 
            text-shadow: 0 0 5px #67e8f9f1, 0 0 20px #22d3eecc; 
        }
        .caja-neon-celeste { 
            border: 2px solid #67e8f9; 
            box-shadow: 0 0 10px #67e8f9, inset 0 0 5px #67e8f9; 
            background-color: rgba(8, 51, 68, 0.9); 
        }
        .input-retro { 
            background-color: rgba(0, 0, 0, 0.6); 
            border: 2px solid #0e7490;
            color: #a5f3fc; 
            font-size: 1.5rem; 
            transition: all 0.3s; 
        }

        .input-retro:focus { 
            outline: none; 
            border-color: #67e8f9; 
            box-shadow: 0 0 10px #67e8f9; 
            color: white; 
        }
        .parpadeo { 
            animation: animacionParpadeo 3s infinite; 
        }

        @keyframes animacionParpadeo { 
            0%, 100% { opacity: 1; } 
            50% { opacity: 0.8; } 
        }
    </style>
</head>

<body class="bg-black text-gray-200 pt-1 min-h-screen flex flex-col justify-center items-center">

    <div class="container max-w-xl mx-auto">
        
        <h1 class="text-5xl text-center mb-4 uppercase texto-neon-celeste font-bold tracking-widest parpadeo">
            EDITAR JUGADOR
        </h1>

        <div class="caja-neon-celeste px-8 pb-4 rounded-sm">
            
            <form action="" method="POST" class="space-y-3">
                
                <input type="hidden" name="campo_id" value="<?php echo $fila['ID']; ?>">

                <div>
                    <label class="block text-3xl font-bold text-cyan-200 mb-1 uppercase tracking-widest">
                        ALIAS:
                    </label>
                    <input type="text" name="campo_alias" required 
                           value="<?php echo $fila['ALIAS']; ?>"
                           class="input-retro w-full p-2 rounded-sm">
                </div>

                <div>
                    <label class="block text-3xl font-bold text-cyan-200 mb-1 uppercase tracking-widest">
                        NOMBRE REAL:
                    </label>
                    <input type="text" name="campo_nombre" required 
                           value="<?php echo $fila['NOMBRE']; ?>"
                           class="input-retro w-full p-2 rounded-sm">
                </div>

                <div>
                    <label class="block text-3xl font-bold text-cyan-200 mb-1 uppercase tracking-widest">
                        NIVEL ACTUAL:
                    </label>
                    <input type="number" name="campo_nivel" required 
                           value="<?php echo $fila['NIVEL']; ?>"
                           class="input-retro w-full p-2 rounded-sm">
                </div>

                <div class="pt-1">
                    <input type="submit" name="btn_actualizar" value="[ GUARDAR CAMBIOS ]"
                           class="w-full cursor-pointer bg-amber-900/40 border-2 border-amber-500 text-amber-500 hover:bg-amber-500 hover:text-black font-bold text-3xl py-2 uppercase tracking-widest transition shadow-[0_0_10px_rgba(245,158,11,0.3)] hover:shadow-[0_0_20px_rgba(245,158,11,1)]">
                </div>
            
            </form>
        </div>

        <div class=" text-center">
            <a href="players_list_and_delete.php" 
               class="inline-block text-red-500 border-2 border-red-500 px-6 py-2 mt-4 text-xl hover:bg-red-500 hover:text-black transition font-bold uppercase tracking-widest">
               ⬅ CANCELAR EDICIÓN
            </a>
        </div>

    </div>

</body>
</html>