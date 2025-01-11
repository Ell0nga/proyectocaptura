<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION['usuario']) || !esAdministrador($_SESSION['usuario'])) {
    die("Acceso denegado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $estado = $_POST['estado']; // 1 para autorizar, 0 para bloquear

    $query = $conn->prepare("UPDATE usuarios SET autorizado = ? WHERE id = ?");
    $query->execute([$estado, $id]);

    header("Location: index.php");
    exit();
}
?>
