<?php
include 'includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insertar el nuevo usuario
    $query = $conn->prepare("INSERT INTO usuarios (nombre, contrasena) VALUES (?, ?)");
    $query->execute([$nombre, $password]);

    // Mostrar mensaje de éxito y redirigir al login
    echo "<script>
        alert('Registro exitoso. Debes esperar que el administrador autorice tu registro.');
        window.location.href = 'login.php';
    </script>";
    exit();
}
?>

<?php include 'includes/header.php'; ?>
<h2>Registro</h2>
<form method="POST" action="">
    <label for="nombre">Usuario:</label>
    <input type="text" name="nombre" required>
    <br>
    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>
    <br>
    <button type="submit">Registrar</button>
</form>
<a href="login.php">¿Ya tienes una cuenta? Inicia sesión</a>
</body>
</html>
