<?php
include 'includes/db.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta para buscar al usuario
    $query = $conn->prepare("SELECT id, nombre, contrasena, autorizado FROM usuarios WHERE nombre = ?");
    $query->execute([$usuario]);
    $user = $query->fetch();

    // Verificar usuario y contraseña
    if ($user && password_verify($password, $user['contrasena'])) {
        if ($user['autorizado'] == 1) {
            $_SESSION['usuario'] = $user['nombre'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Tu cuenta está esperando autorización del administrador.";
        }
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<?php include 'includes/header.php'; ?>
<h2>Iniciar Sesión</h2>
<form method="POST" action="">
    <label for="usuario">Usuario:</label>
    <input type="text" name="usuario" required>
    <br>
    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>
    <br>
    <button type="submit">Iniciar Sesión</button>
</form>
<?php if ($error): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<a href="registro.php">¿No tienes una cuenta? Regístrate</a>
</body>
</html>
