
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Dados</title>
</head>
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
    background-image: linear-gradient(rgba(0, 0, 0, 0.80), rgba(0, 0, 0, 0.80)), url('img/fondo.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.letra-neon {
    color: "rgba(233, 109, 109, 1)";
    text-shadow:
        0 0 5px #ffffffff, 
        0 0 10px #ffffffff,
        0 0 20px #ffffffff, 
        0 0 30px #f8f8f8ff;
}
.neon-verde {
    color: #39FF14;
    text-shadow:
        0 0 0px #37ff14d8,
        0 0 0px #37ff14e3,
        0 0 20px #37ff14d5;
}
.neon-azul {
    color: #00BFFF;
    text-shadow:
        0 0 0px #00bfffe1,
        0 0 0px #00bfffde,
        0 0 20px #00bfffcb;
}
.neon-rojo {
    color: #ff1111ff;
    text-shadow:
        0 0 0px #FF1177,
        0 0 0px #ff1178de,
        0 0 20px #ff1178ce;
}
.neon-amarillo {
    color: #FFFF00;
    text-shadow:
    0 0 0px #ffff00da,
    0 0 0px #ffff00d3,
    0 0 20px #ffff00cb;
}
.neon-rosa {
    color: #FF00FF;
    text-shadow:
        0 0 0px #ff00ffe5,
        0 0 0px #ff00ffdc,
        0 0 20px #ff00ffc5;
}
.card-neon {
    margin-top: -20px;
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    width: 45%;
    box-shadow: 0 0 10px #fff,
                0 0 12px #fff,
                0 0 15px #fff;

    transition: all 0.2s ease-in-out; 
}
.card-neon:hover {

    box-shadow: 0 0 13px #ffffffff,
                0 0 16px #ffffffff,
                0 0 19px #ffffffff;
    cursor: pointer; 
    transform: translateY(-5px);
}
.form-div {
    margin-bottom: 20px;
    display: flex;     
    align-items: center; 
    gap: 10px;
}

.form-label {
    display: block;
    margin-bottom: 5px;
    color: #000000ff;
    width: 40%;
    font-size: 22px;
    font-weight: bold;
}

.form-input {
    width: 100%;
    padding: 10px;
    border: 2px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    font-size: 20px;
    transition: all 0.1s ease;
}
.form-input:hover,
.form-input:focus {
    outline: none; 
    border-color: #00BFFF;
    box-shadow: 0 0 10px #00BFFF;
    transform: rotate(1deg); 
}
.form-div:nth-child(odd) .form-input:hover,
.form-div:nth-child(odd) .form-input:focus {
    transform: rotate(-1deg); 
}
.form-boton {
    width: 25%;
    padding: 10px;
    font-size: 20px;
    font-weight: bold;
    background-color: #000000ff;
    color: #00BFFF;
    border: 1px solid #00BFFF;
    box-shadow: 0 0 5px #00BFFF;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.1s ease-in-out;
}
.form-boton:hover {
    transform: translateY(-3px);
    box-shadow: 0 0 5px #00bfffe3,
                0 0 15px #00bfffee;

}
</style>
<body>
    <h1 style="font-size: 100px;text-align: center; margin-top:0px;" class="fontDados">
    <span class="neon-verde">D</span>
    <span class="neon-azul">A</span>
    <span class="neon-rojo">D</span>
    <span class="neon-amarillo">O</span>
    <span class="neon-rosa">S</span>
    </h1>
    <form action="da02.php" method="post" class="card-neon">
        
        <div class="form-div">
            <label for="num_dado" class="form-label font-retro">Numero de Dados :</label>
            <select name="num_dado" id="num_dado" class="form-input font-retro">
                <option disabled selected>Elige tus dados</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
        <div class="form-div">
            <label for="num_caras" class="form-label font-retro">Numero de Caras :</label>
            <select name="num_caras" id="num_caras" class="form-input font-retro">
                <option disabled selected>Elige el numero de caras</option>
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="10">10</option>
                <option value="12">12</option>
                <option value="20">20</option>
            </select>
        </div>
        <div class="form-div">
            <label for="opo" class="form-label font-retro">Puntos Oponente (1-60)</label>
            <select name="opo" id="opo" class="form-input font-retro"> 
            <?php
            $resulOpo = "";
            for ($i = 1; $i <= 60; $i++) {
                $resulOpo .= "<option value='$i'>$i</option>";
            }
            echo $resulOpo;
            ?>
            </select>
            <button type="button" onclick="document.getElementById('opo').value = Math.floor(Math.random() * 60) + 1;" class="form-boton font-retro">
            Elegir al azar
            </button>
            
        </div>
        <input type="submit" value="Confirmar" class="form-boton font-retro">
    </form>
    
</body>
</html>