<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.html");
    exit;
}

if (($_SESSION["rol"] ?? "") !== "doctor") {
    header("Location: turnos-paciente.php");
    exit;
}

$usuario = htmlspecialchars($_SESSION["usuario"], ENT_QUOTES, "UTF-8");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turno Ya | Doctor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="turnos-doctor.php">
            Turno Ya
        </a>

        <div class="ms-auto d-flex align-items-center gap-3">
            <span>Hola, Dr. <?= $usuario ?></span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">
                Cerrar sesión
            </a>
        </div>
    </div>
</nav>

<main class="container py-5">

    <div class="mb-4">
        <h1 class="fw-bold">Panel del doctor</h1>
        <p class="text-secondary">
            Administrá tu agenda y atendé a tus pacientes.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="card-title">Mi agenda</h5>
                    <p class="text-secondary">
                        Consultá los turnos asignados.
                    </p>
                    <a href="#" class="btn btn-primary">
                        Ver agenda
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="card-title">Mis pacientes</h5>
                    <p class="text-secondary">
                        Consultá la información de tus pacientes.
                    </p>
                    <a href="#" class="btn btn-outline-primary">
                        Ver pacientes
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="card-title">Disponibilidad</h5>
                    <p class="text-secondary">
                        Organizá tus días y horarios de atención.
                    </p>
                    <a href="#" class="btn btn-outline-primary">
                        Configurar horarios
                    </a>
                </div>
            </div>
        </div>

    </div>
</main>

</body>
</html>