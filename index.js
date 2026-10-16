
async function comprobarSesion() {
    const { data, error } =
        await window.supabaseClient.auth.getSession();

    if (error || !data.session) {
        window.location.href = "login.html";
        return;
    }

    console.log("Sesión iniciada correctamente");
}

comprobarSesion();
