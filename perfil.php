<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$nombreActual = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoNombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $query = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, telefono = ? WHERE nombre = ?");
    $query->execute([$nuevoNombre, $email, $telefono, $nombreActual]);

    $_SESSION['usuario'] = $nuevoNombre; // Actualiza la sesión.
    echo "Datos actualizados.";
}

// Recuperar datos actuales:
$query = $conn->prepare("SELECT nombre, email, telefono FROM usuarios WHERE nombre = ?");
$query->execute([$nombreActual]);
$datos = $query->fetch();
?>

<?php include 'includes/header.php'; ?>
<h2>Perfil de Usuario</h2>
<form method="POST" action="">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($datos['nombre']) ?>" required>
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($datos['email']) ?>">
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" value="<?= htmlspecialchars($datos['telefono']) ?>">
    <button type="submit">Actualizar</button>
</form>
<a href="index.php">Volver al inicio</a>
</body>
</html>
