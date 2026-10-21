<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.html");
    exit;
}

$usuario = htmlspecialchars($_SESSION["usuario"], ENT_QUOTES, "UTF-8");
$rol = $_SESSION["rol"] ?? "paciente";
$esDoctor = $rol === "doctor";
$rolTexto = $esDoctor ? "Doctor" : "Paciente";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turno Ya | Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f8fc; color: #172033; }
        .navbar { background: #fff; box-shadow: 0 2px 16px rgba(20,40,70,.06); }
        .brand { color: #0d6efd; font-weight: 800; font-size: 1.35rem; }
        .user-menu { border: 1px solid #e5eaf1; border-radius: 14px; background: #fff; padding: 7px 12px; }
        .avatar { width: 38px; height: 38px; border-radius: 50%; display:flex; align-items:center; justify-content:center; background:#eaf2ff; color:#0d6efd; font-weight:700; }
        .hero { border-radius: 24px; background: linear-gradient(135deg,#0d6efd,#4b8df8); color:#fff; box-shadow: 0 15px 40px rgba(13,110,253,.18); }
        .card-action { border: 0; border-radius: 18px; transition: .2s; box-shadow: 0 5px 22px rgba(30,50,80,.06); }
        .card-action:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(30,50,80,.10); }
        .icon { width: 48px; height:48px; border-radius:14px; display:flex; align-items:center; justify-content:center; background:#edf4ff; color:#0d6efd; font-size:1.3rem; }
        .badge-role { font-size:.72rem; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container py-2">
        <a class="navbar-brand brand" href="turnoya.php">Turno Ya</a>
        <div class="dropdown ms-auto">
            <button class="btn user-menu d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="avatar"><?= strtoupper(substr($usuario, 0, 1)) ?></span>
                <span class="text-start d-none d-sm-block">
                    <strong class="d-block lh-1"><?= $usuario ?></strong>
                    <span class="badge text-bg-<?= $esDoctor ? 'primary' : 'secondary' ?> badge-role mt-1"><?= $rolTexto ?></span>
                </span>
                <span>⌄</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2">
                <li><h6 class="dropdown-header">Sesión de <?= $rolTexto ?></h6></li>
                <li><a class="dropdown-item" href="#">Mi perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="logout.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4 py-md-5">
    <section class="hero p-4 p-md-5 mb-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-white text-primary mb-3">Panel de <?= $rolTexto ?></span>
                <h1 class="display-6 fw-bold">¡Hola, <?= $usuario ?>!</h1>
                <p class="lead mb-0 opacity-75">
                    <?= $esDoctor ? 'Administrá tu agenda y organizá tus consultas.' : 'Encontrá profesionales y gestioná tus próximos turnos.' ?>
                </p>
            </div>
        </div>
    </section>

    <h2 class="h4 fw-bold mb-3"><?= $esDoctor ? 'Gestión profesional' : '¿Qué querés hacer?' ?></h2>
    <div class="row g-3">
        <?php if ($esDoctor): ?>
            <div class="col-md-4"><div class="card card-action h-100 p-4"><div class="icon mb-3">📅</div><h3 class="h5">Mi agenda</h3><p class="text-secondary">Consultá y organizá tus turnos.</p><a href="#" class="btn btn-primary">Ver agenda</a></div></div>
            <div class="col-md-4"><div class="card card-action h-100 p-4"><div class="icon mb-3">👥</div><h3 class="h5">Mis pacientes</h3><p class="text-secondary">Accedé a tus pacientes y consultas.</p><a href="#" class="btn btn-outline-primary">Ver pacientes</a></div></div>
            <div class="col-md-4"><div class="card card-action h-100 p-4"><div class="icon mb-3">🕐</div><h3 class="h5">Disponibilidad</h3><p class="text-secondary">Definí los días y horarios disponibles.</p><a href="#" class="btn btn-outline-primary">Configurar</a></div></div>
        <?php else: ?>
            <div class="col-md-4"><div class="card card-action h-100 p-4"><div class="icon mb-3">🔎</div><h3 class="h5">Buscar doctor</h3><p class="text-secondary">Encontrá un profesional por especialidad.</p><a href="#" class="btn btn-primary">Buscar</a></div></div>
            <div class="col-md-4"><div class="card card-action h-100 p-4"><div class="icon mb-3">📅</div><h3 class="h5">Mis turnos</h3><p class="text-secondary">Consultá tus próximos turnos.</p><a href="#" class="btn btn-outline-primary">Ver turnos</a></div></div>
            <div class="col-md-4"><div class="card card-action h-100 p-4"><div class="icon mb-3">📋</div><h3 class="h5">Historial</h3><p class="text-secondary">Revisá tus consultas anteriores.</p><a href="#" class="btn btn-outline-primary">Ver historial</a></div></div>
        <?php endif; ?>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
