<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

echo json_encode([
    "logueado" => isset($_SESSION["usuario"]),
    "usuario" => $_SESSION["usuario"] ?? null,
    "rol" => $_SESSION["rol"] ?? null
]);
