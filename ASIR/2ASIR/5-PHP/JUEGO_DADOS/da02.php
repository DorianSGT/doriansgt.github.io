<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Duelo</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Jersey+20&family=Pixelify+Sans:wght@400..700&display=swap');

.font-retro {
    font-family: "Jersey 20", sans-serif;
    font-size: 24px;
    image-rendering: pixelated;
    font-smooth: never;
    -webkit-font-smoothing: none;
}
.fontDados {
    font-family: "Pixelify Sans", sans-serif;
    font-optical-sizing: auto;
    font-style: normal;
}

body {
    background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url('img/fondo.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    text-align: center;
    color: #fff;
}
.neon-blanco {
    color: #fff;
    text-shadow:
        0 0 0px #fff,
        0 0 0px #fff,
        0 0 20px #ffffffd3;
}
.dados-container {
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 0 4px #fff,
                0 0 10px #ffffffce,
                0 0 20px #ffffffc5;

    width: 80%;
    max-width: 390px;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    padding-top: 0px;
    padding-bottom: 0px;
}
@keyframes flotar {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}
.dado-resultado {
    position: relative; 
    width: 100px;
    height: 100px;
    display: inline-block; 
    margin: 10px;
    animation: flotar 3s ease-in-out infinite;
}
.dado-resultado:nth-child(2) {
    animation-delay: 0.5s;
}
.dado-resultado:nth-child(3) {
    animation-delay: 1s;
}

.dado-imagen {
    width: 100%;
    height: 100%;
}
.dado-numero {
    position: absolute; 
    top: 50%;  
    left: 50%;
    transform: translate(-50%,-50%); 
    font-size: 30px;
    font-weight: bold;
    color: white;
    text-shadow: 0 0 0px white, 0 0 3px white;
}
.dado-d4 .dado-numero { top: 60%; }
.dado-d8 .dado-numero { top: 45%; }
.dado-d10 .dado-numero { top: 35%; }
.dado-d20 .dado-numero { top: 55%; }

.suma-bloque {
    display: inline-flex;
    flex-direction: column; 
    align-items: center;
    margin: 0px 30px;
    margin-top: -15px;
    padding: 15px;
    border: 2px solid #fff;
    border-radius: 8px;
    color: #fff;
    box-shadow: 0 0 10px #fff;
    text-shadow: 0 0 3px #fff;
    transition: all 0.1s ease; 
    vertical-align: middle;
}
.suma-bloque:hover {
    transform: translateY(-5px) scale(1.05);
}
.suma-jugador {
    border-color: #00BFFF;
    color: #00BFFF;
    box-shadow: 0 0 10px #00BFFF;
    text-shadow: 0 0 10px #ffffffa8;
}
.suma-jugador:hover {
    box-shadow: 0 0 15px #00BFFF, 0 0 25px #00BFFF;
}
.num-suma-jugador{
    color: #00BFFF;
    text-shadow: 0 0 10px #00bfffbe;
}
.suma-oponente {
    border-color: #ff1131ff; 
    color: #ff1131ff;
    box-shadow: 0 0 10px #ff1131ff;
    text-shadow: 0 0 10px #ffffffa8;
}
.suma-oponente:hover {
    box-shadow: 0 0 15px #ff1131ff, 0 0 25px #ff1131ff;
}
.num-suma-oponente{
    color: #ff1131ff;
    text-shadow: 0 0 10px #ff1131b0;
}
.suma-bloque span {
    display: block;
    font-size: 35px;
    color: #ccc;
    position: relative;
    z-index: 1; 
}   
.suma-bloque p {
    margin: 0;
    font-size: 40px;
    font-weight: bold;
}

.form-button {
    width: auto; 
    padding: 5px 12px;
    font-size: 18px;
    font-weight: bold;
    background-color: transparent;
    color: #fafafaff;
    border: 2px solid #ffffffff;
    box-shadow: 0 0 5px #ffffffd5;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.1s ease-in-out;
}
.form-button:hover {
    transform: translateY(-5px);
    border: 2px solid #00BFFF;
    box-shadow: 0 0 10px #00bfffe1,
                0 0 20px #00bfffc5;
}
.ganador {
    color: #39FF14;
    text-shadow:
        0 0 0px #39FF14,
        0 0 0px #39FF14,
        0 0 20px #37ff14b7;
}
.perdedor {
    color: #ff1131ff;
    text-shadow:
        0 0 0px #ff1131ff,
        0 0 0px #ff1131ff,
        0 0 20px #ff1131b6;
        
}
.perdedor:hover {
    transform: rotate(-10deg);
}

.empate {
    color: #00BFFF;
    text-shadow:
        0 0 0px #00BFFF,
        0 0 0px #00BFFF,
        0 0 20px #00bfffb7;
}
.versus {
    font-size: 40px;
    padding: 10px;
    vertical-align: middle;
}

</style>
</head>
<body>
    <h1 class="neon-blanco fontDados" style="font-size: 55px; margin-bottom: 20px;margin-top: 0px;">RESULTADO</h1>
    
    <?php
    if (isset($_POST['num_dado']) && isset($_POST['num_caras']) && isset($_POST['opo'])) {

        // Variables inputs
        $num_dados = (int)$_POST['num_dado'];
        $num_caras = (int)$_POST['num_caras'];
        $sum_opo = (int)$_POST['opo'];

        // Tirar Dados
        $resultados_individuales = [];
        $sum_dados = 0;
        for ($i = 0; $i < $num_dados; $i++) {
            $tirada = rand(1, $num_caras);
            $resultados_individuales[] = $tirada;
            $sum_dados += $tirada; 
        }

        // Mostrar Dados

        echo "<div class='dados-container'>";
        for ($i=0; $i < count($resultados_individuales); $i++) {
            $tirada = $resultados_individuales[$i];  
            $imagen_base = "img/d{$num_caras}.png"; 

            echo "<div class='dado-resultado dado-d{$num_caras}'>";
            echo "  <img src='$imagen_base' alt='Dado de $num_caras caras' class='dado-imagen'>";
            echo "  <span class='dado-numero fontDados'>$tirada</span>";
            echo "</div>";
        }
        echo "</div>";

        
        echo "<h2 class='neon-blanco font-retro' style='margin-top: 30px; font-size:30px;'>SUMA:</h2>";
        //SUMA jugador
        echo "<div>";

        echo "<div class='suma-bloque suma-jugador font-retro'>";
        echo "  <span>PUNTOS OBTENIDOS</span>"; 
        echo "  <p class='num-suma-jugador'>$sum_dados</p>";
        echo "</div>";
        //VS
        echo "<div class='font-retro versus' style='display:inline-block'>VS";
        echo "</div>";

        //SUMA oponente
        echo "<div class='suma-bloque suma-oponente font-retro'>";
        echo "  <span>PUNTOS OPONENTE</span>";
        echo "  <p class='num-suma-oponente'>$sum_opo</p>"; 
        echo "</div>";

        echo "</div>";

    
        echo "<div class='resultado-final fontDados' style='font-size: 25px; margin-top: -15px;'>";
        
        if ($sum_dados > $sum_opo) {
            echo "<h1 class='ganador'>¡ENHORABUENA DE LA BUENA!</h1>";
        } else if ($sum_dados < $sum_opo) {
            echo "<h1 class='perdedor'>¡PIERDES!</h1>";
        } else {
            echo "<h1 class='empate'>EMPATE</h1>";
        }
        
        echo "</div>";
        
    } else {
        echo "<h1 class='perdedor font-retro'>Error: No has tirado los dados</h1>";
    }
    ?>

    <a href="da01.php"><button class="form-button font-retro" style="margin-top: -30px;">Volver</button></a>

</body>
</html>