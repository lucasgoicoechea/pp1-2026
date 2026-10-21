<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
require_once "conexion.php";

$datosRecibidos = json_decode(file_get_contents("php://input"), true) ?? [];
$usuario = trim($datosRecibidos["user"] ?? "");
$password = $datosRecibidos["pass"] ?? "";

if ($usuario === "" || $password === "") {
    echo json_encode(["ok" => false, "mensaje" => "Completá todos los campos"]);
    exit;
}

try {
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ? LIMIT 1");
    $stmt->execute([$usuario]);
    $datos = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$datos) {
        echo json_encode(["ok" => false, "mensaje" => "Usuario no encontrado"]);
        exit;
    }

    
    $passwordCorrecta = password_verify($password, $datos["password"] ?? "") || hash_equals((string)($datos["password"] ?? ""), $password);

    if (!$passwordCorrecta) {
        echo json_encode(["ok" => false, "mensaje" => "Contraseña incorrecta"]);
        exit;
    }

    session_regenerate_id(true);

    $rol = strtolower(trim((string)(
        $datos["rol"] ?? $datos["tipo_usuario"] ?? $datos["tipo"] ?? $datos["perfil"] ?? "paciente"
    )));

    if (in_array($rol, ["doctor", "médico", "medico"], true)) {
        $rol = "doctor";
    } else {
        $rol = "paciente";
    }

    $_SESSION["usuario"] = $datos["usuario"];
    $_SESSION["rol"] = $rol;
    $_SESSION["usuario_id"] = $datos["id"] ?? null;

    echo json_encode([
        "ok" => true,
        "mensaje" => "Login correcto",
        "usuario" => $datos["usuario"],
        "rol" => $rol
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["ok" => false, "mensaje" => "Error del servidor"]);
}
