<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.html");
    exit;
}

if (($_SESSION["rol"] ?? "") === "doctor") {
    header("Location: turnos-doctor.php");
} else {
    header("Location: turnos-paciente.php");
}

exit;