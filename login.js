
const formulario = document.getElementById("formLogin");

formulario.addEventListener("submit", async function(e) {
    e.preventDefault();

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const mensaje = document.getElementById("mensaje");

    mensaje.textContent = "Verificando datos...";

    try {
        const { data, error } =
            await window.supabaseClient.auth.signInWithPassword({
                email: email,
                password: password
            });

        if (error) {
            mensaje.textContent = "Error: " + error.message;
            return;
        }

        mensaje.textContent = "¡Inicio de sesión correcto!";

        window.location.href = "index.html";

    } catch (error) {
        mensaje.textContent = "Error de conexión: " + error.message;
    }
});
