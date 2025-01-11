<?php
// Ya existente:
$host = "localhost";
$user = "root";
$password = "";
$dbname = "proyecto";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar: " . $e->getMessage());
}

// Nueva función para verificar si es administrador:
function esAdministrador($usuario) {
    return $usuario === 'harry'; // Nombre del administrador.
}
?>
