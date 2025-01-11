<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION['usuario']) || !esAdministrador($_SESSION['usuario'])) {
    die("Acceso denegado.");
}

// Obtener todos los usuarios con fecha de registro
$query = $conn->prepare("SELECT id, nombre, email, telefono, autorizado, fecha_registro FROM usuarios");
$query->execute();
$usuarios = $query->fetchAll();
?>

<?php include '../includes/header.php'; ?>
<h2>Administración - Gestionar Usuarios</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Estado</th>
        <th>Fecha de Registro</th>
        <th>Acción</th>
    </tr>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= $usuario['id'] ?></td>
            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
            <td><?= htmlspecialchars($usuario['email']) ?></td>
            <td><?= htmlspecialchars($usuario['telefono']) ?></td>
            <td><?= $usuario['autorizado'] ? 'Registrado' : 'Esperando autorización' ?></td>
            <td><?= htmlspecialchars($usuario['fecha_registro']) ?></td>
            <td>
                <form method="POST" action="cambiar_estado.php" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                    <input type="hidden" name="estado" value="<?= $usuario['autorizado'] ? 0 : 1 ?>">
                    <button type="submit"><?= $usuario['autorizado'] ? 'Bloquear' : 'Autorizar' ?></button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="../index.php">Volver al inicio</a>
</body>
</html>
