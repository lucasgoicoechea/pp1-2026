<?php
require_once "conexcion.php";

$usuarios = [
    [
        "nombre" => "Paciente de prueba",
        "usuario" => "paciente",
        "password" => "Paciente123!",
        "rol" => "paciente"
    ],
    [
        "nombre" => "Doctor de prueba",
        "usuario" => "doctor",
        "password" => "Doctor123!",
        "rol" => "doctor"
    ]
];

foreach ($usuarios as $u) {

    $consulta = $conexion->prepare(
        "SELECT id FROM usuarios WHERE usuario = ?"
    );

    $consulta->execute([$u["usuario"]]);

    if (!$consulta->fetch()) {

        $passwordHash = password_hash(
            $u["password"],
            PASSWORD_DEFAULT
        );

        $insertar = $conexion->prepare(
            "INSERT INTO usuarios (nombre, usuario, password, rol)
             VALUES (?, ?, ?, ?)"
        );

        $insertar->execute([
            $u["nombre"],
            $u["usuario"],
            $passwordHash,
            $u["rol"]
        ]);

        echo "Usuario " . $u["usuario"] . " creado.<br>";

    } else {
        echo "El usuario " . $u["usuario"] . " ya existe.<br>";
    }
}

echo "<br>Proceso terminado.";
?>