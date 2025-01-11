<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contrasenaActual = $_POST['contrasena_actual'];
    $contrasenaNueva = password_hash($_POST['contrasena_nueva'], PASSWORD_DEFAULT);

    $query = $conn->prepare("SELECT contrasena FROM usuarios WHERE nombre = ?");
    $query->execute([$_SESSION['usuario']]);
    $usuario = $query->fetch();

    if (password_verify($contrasenaActual, $usuario['contrasena'])) {
        $update = $conn->prepare("UPDATE usuarios SET contrasena = ? WHERE nombre = ?");
        $update->execute([$contrasenaNueva, $_SESSION['usuario']]);
        echo "Contraseña actualizada.";
    } else {
        echo "La contraseña actual es incorrecta.";
    }
}
?>

<?php include 'includes/header.php'; ?>
<h2>Cambiar Contraseña</h2>
<form method="POST" action="">
    <input type="password" name="contrasena_actual" placeholder="Contraseña actual" required>
    <input type="password" name="contrasena_nueva" placeholder="Nueva contraseña" required>
    <button type="submit">Actualizar</button>
</form>
<a href="perfil.php">Volver al perfil</a>
</body>
</html>
