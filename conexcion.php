<?php

$host = "127.0.0.1";
$usuario = "root";
$password = "";
$database = "turno_ya";

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$database;charset=utf8mb4",
        $usuario,
        $password
    );

    
    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    
    
} catch (PDOException $e) {
    http_response_code(500);
    
    echo "Error de conexión: " . $e->getMessage();
}
