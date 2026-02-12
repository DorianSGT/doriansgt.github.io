<?php
include 'db.php';
$conexion = conectarDB(); 

$sql = "SELECT * FROM GAMES";

$result = mysqli_query($conexion, $sql);


// BORRADO DE JUEGOS

if (isset($_GET['borrar'])) {
    $id_para_borrar = $_GET['borrar'];

    $sql_delete = "DELETE FROM GAMES WHERE ID = $id_para_borrar";
    
    if (mysqli_query($conexion, $sql_delete)) {
        header("Location: games_list.php");
        exit();
    } else {
        echo "<p style='color:red'>Error al borrar: " . mysqli_error($conexion) . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>System Database - GAMES</title>
    
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
            color: #00ffff; 
            text-shadow: 0 0 5px #00dddd, 0 0 15px #00aaaa; 
        }

        .caja-neon {
            border: 2px solid #00ffff;
            box-shadow: 0 0 10px #00ffff, inset 0 0 5px #00ffff;
            background-color: rgba(0, 10, 20, 0.9);
        }
        .boton-arcade {
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.2s;
            border: 2px solid;
        }
        .boton-arcade:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px currentColor;
            color: black;
        }
    </style>
</head>

<body class="bg-black text-gray-200 p-6 min-h-screen flex flex-col items-center">

    <div class="container max-w-5xl mx-auto">

        <h1 class="text-6xl text-center mb-10 uppercase texto-neon font-bold tracking-widest">
            GESTIONAR <span class="text-white">GAMES</span>
        </h1>

        <div class="flex justify-between items-center mb-8">
            
            <a href="index.php" class="boton-arcade border-yellow-500 text-yellow-500 px-6 py-2 hover:bg-yellow-500 font-bold text-xl">
                ⬅ VOLVER
            </a>
            
            <a href="games_insert.php" class="boton-arcade border-green-500 text-green-500 px-6 py-2 hover:bg-green-500 font-bold text-xl">
                ✚ INSERTAR JUEGO
            </a>
        </div>

        <div class="caja-neon p-1 rounded-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                
                <thead>
                    <tr class="bg-cyan-900/30 text-white text-4xl border-b-2 border-cyan-500">
                        <th class="p-4 uppercase tracking-widest font-bold">ID</th>
                        <th class="p-4 uppercase tracking-widest font-bold">NOMBRE</th>
                        <th class="p-4 uppercase tracking-widest font-bold">PLATAFORMA</th>
                        <th class="p-4 uppercase tracking-widest font-bold text-right pr-12">ACCIONES</th>
                    </tr>
                </thead>

                <tbody class="text-xl">
                    <?php
                    // Si no hay juegos
                    if (mysqli_num_rows($result) == 0) {
                        echo "<tr><td colspan='4' class='p-6 text-center text-gray-500 tracking-widest'>NO HAY NINGÚN JUEGO...</td></tr>";
                    }

                    // BUCLE PARA MOSTRAR JUEGOS
                    foreach ($result as $fila) {
                        echo "<tr class='border-b border-cyan-500/30 hover:bg-cyan-500/20 transition duration-200 text-2xl'>";
                        
                        echo "<td class='p-4 text-cyan-200 font-bold'>" . $fila['ID'] . "</td>";
                        echo "<td class='p-4 text-cyan-200 tracking-wide'>" . $fila['NOMBRE'] . "</td>";
                        echo "<td class='p-4 text-blue-200 uppercase'>" . $fila['PLATAFORMA'] . "</td>";
                        
                        echo "<td class='p-4 text-right space-x-4'>
                                
                                <a href='games_edit.php?id=" . $fila['ID'] . "' 
                                    class='inline-block border-2 border-amber-500 text-amber-500 hover:bg-amber-500 hover:text-black font-bold py-1 px-3 rounded-sm transition-all duration-200 uppercase tracking-widest text-xl shadow-[0_0_5px_rgba(255,174,0,0.5)] hover:shadow-[0_0_15px_rgba(255,174,0,1)]'>
                                    EDITAR
                                </a>
                                
                                <a href='games_list_and_delete.php?borrar=" . $fila['ID'] . "' 
                                    class='inline-block border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-black font-bold py-1 px-3 rounded-sm transition-all duration-200 uppercase tracking-widest text-xl shadow-[0_0_5px_rgba(239,68,68,0.5)] hover:shadow-[0_0_15px_rgba(239,68,68,1)]'
                                    onclick=\"return confirm('¡CUIDADO!: ¿Quieres borrar el juego: " . $fila['NOMBRE'] . "?');\">
                                    BORRAR
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>