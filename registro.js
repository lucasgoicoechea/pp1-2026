
const formulario = document.getElementById("formRegistro");

formulario.addEventListener("submit", async function(e) {
    e.preventDefault();

    const nombre = document.getElementById("nombre").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmar = document.getElementById("confirmarPassword").value;
    const mensaje = document.getElementById("mensaje");

    if (password !== confirmar) {
        mensaje.textContent = "Las contraseñas no coinciden.";
        return;
    }

    mensaje.textContent = "Conectando con Supabase...";

    try {
        const { data, error } = await window.supabaseClient.auth.signUp({
            email: email,
            password: password,
            options: {
                data: { nombre: nombre }
            }
        });

        if (error) {
            mensaje.textContent = "Error: " + error.message;
            return;
        }

        mensaje.textContent =
            "Registro enviado. Revisá tu correo si te piden confirmar la cuenta.";

        formulario.reset();

    } catch (error) {
        mensaje.textContent = "Error de conexión: " + error.message;
    }
});
