<?php
include 'includes/db.php'; // Ruta ajustada según la ubicación del archivo
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Botón de salir
echo '<a href="logout.php" style="float: right; margin: 10px;">Salir</a>';
?>

<?php include 'includes/header.php'; ?>
<p>Hola, <?php echo $_SESSION['usuario']; ?>. ¡Bienvenido a tu página!</p>
<a href="perfil.php">Ir a mi perfil</a>
<?php if (esAdministrador($_SESSION['usuario'])): ?>
    <a href="admin/index.php">Administrar usuarios</a>
<?php endif; ?>
<a href="logout.php">Cerrar sesión</a>
</body>
</html>

