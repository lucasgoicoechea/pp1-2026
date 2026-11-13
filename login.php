<?php
session_start();

header("Content-Type: application/json; charset=UTF-8");

require_once "conexcion.php";

$datos = json_decode(file_get_contents("php://input"), true) ?? [];

$usuario = trim($datos["user"] ?? "");
$password = $datos["pass"] ?? "";

if ($usuario === "" || $password === "") {
    echo json_encode([
        "ok" => false,
        "mensaje" => "Completá todos los campos"
    ]);
    exit;
}

try {
    $stmt = $conexion->prepare(
        "SELECT * FROM usuarios WHERE usuario = ? LIMIT 1"
    );

    $stmt->execute([$usuario]);
    $datosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$datosUsuario || !password_verify(
        $password,
        $datosUsuario["password"]
    )) {
        echo json_encode([
            "ok" => false,
            "mensaje" => "Usuario o contraseña incorrectos"
        ]);
        exit;
    }

    session_regenerate_id(true);

    $rol = $datosUsuario["rol"];

    $_SESSION["usuario"] = $datosUsuario["usuario"];
    $_SESSION["usuario_id"] = $datosUsuario["id"];
    $_SESSION["nombre"] = $datosUsuario["nombre"];
    $_SESSION["rol"] = $rol;

    $destino = ($rol === "doctor")
        ? "turnos-doctor.php"
        : "turnos-paciente.php";

    echo json_encode([
        "ok" => true,
        "mensaje" => "Login correcto",
        "rol" => $rol,
        "destino" => $destino
    ]);

} catch (PDOException $e) {
    http_response_code(500);

    echo json_encode([
        "ok" => false,
        "mensaje" => "Error del servidor"
    ]);
}