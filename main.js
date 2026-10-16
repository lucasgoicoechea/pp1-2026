const Datos = document.getElementById("Datos");
const msg = document.getElementById("msj");

Datos.addEventListener("submit", function(event) {

    event.preventDefault();

    const reg = {
        user: document.getElementById("usuario").value,
        pass: document.getElementById("password").value
    };

    fetch("login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(reg)
    })

    .then(respuesta => respuesta.json())

    .then(data => {

        msg.textContent = data.mensaje;

        if (data.ok === true) {
            window.location.href = "turnos.html";
        }

    })

    .catch(error => {
        console.log(error);
        msg.textContent = "Error al iniciar sesión";
    });

});