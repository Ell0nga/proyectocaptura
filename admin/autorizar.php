<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION['usuario']) || !esAdministrador($_SESSION['usuario'])) {
    die("Acceso denegado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $query = $conn->prepare("UPDATE usuarios SET autorizado = 1 WHERE id = ?");
    $query->execute([$id]);

    header("Location: index.php"); // Redirige de nuevo a la tabla
    exit();
}
?>
