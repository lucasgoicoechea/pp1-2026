<?php

header("Content-Type: application/json; charset=UTF-8");

require_once "conexion.php";

$datosRecibidos = json_decode(
    file_get_contents("php://input"),
    true
);

$usuario = $datosRecibidos["user"] ?? "";
$password = $datosRecibidos["pass"] ?? "";

if ($usuario === "" || $password === "") {
    echo json_encode([
        "ok" => false,
        "mensaje" => "Completá todos los campos"
    ]);
    exit;
}

$sql = "SELECT * FROM usuarios WHERE usuario = ?";

$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario]);

$datos = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$datos) {

    echo json_encode([
        "ok" => false,
        "mensaje" => "Usuario no encontrado"
    ]);

} elseif ($password === $datos["password"]) {

    echo json_encode([
        "ok" => true,
        "mensaje" => "Login correcto"
    ]);

} else {

    echo json_encode([
        "ok" => false,
        "mensaje" => "Contraseña incorrecta"
    ]);
}
