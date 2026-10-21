const Datos = document.getElementById("Datos");
const msg = document.getElementById("msj");

if (Datos) {
    Datos.addEventListener("submit", async function (event) {
        event.preventDefault();
        msg.textContent = "Iniciando sesión...";
        msg.className = "text-muted mt-3";

        const reg = {
            user: document.getElementById("usuario").value.trim(),
            pass: document.getElementById("password").value
        };

        try {
            const respuesta = await fetch("login.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(reg)
            });
            const data = await respuesta.json();

            msg.textContent = data.mensaje;
            msg.className = data.ok ? "text-success mt-3" : "text-danger mt-3";

            if (data.ok) {
                setTimeout(() => window.location.href = "turnoya.php", 250);
            }
        } catch (error) {
            console.error(error);
            msg.textContent = "No se pudo conectar con el servidor.";
            msg.className = "text-danger mt-3";
        }
    });
}
