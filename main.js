const Num= document.getElementById ("gastos_fijos");
const BtnEnviar=document.getElementById("BtnEnviar");
const msj=document.getElementById("msj");


BtnEnviar.addEventListener("click", () => {
    alert (Num.value)
    msj.textContent = Num.value
    
    } )