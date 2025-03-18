const contraseña = "salle";
const passwd = document.querySelectorAll('.passwd');
const btn_ver = document.getElementById("btn-verificar")

console.log(passwd); 
btn_ver.addEventListener('click', () => {

    if (passwd===contraseña){
        window.location.href = "https://www.google.com";
        alert("enhorabuena");
        console.log("correcto");
    }

});
