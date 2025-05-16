<?php
// Incluir el archivo de conexión
include "db.php";

// Verificar conexión
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Datos del administrador (MODIFICAR ESTOS VALORES)
$nombre = "Administrador";
$email = "admin2@example.com";
$password = "admin1234";

// Encriptación segura de la contraseña
$hashed_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

// Query para insertar en la tabla administradores
$sql = "INSERT INTO administradores (nombre, email, contraseña) VALUES (?, ?, ?)";

// Preparar la consulta
$stmt = mysqli_prepare($con, $sql);

if (!$stmt) {
    die("Error al preparar la consulta: " . mysqli_error($con));
}

// Enlazar los parámetros
mysqli_stmt_bind_param($stmt, "sss", $nombre, $email, $hashed_password);

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt)) {
    echo "Administrador creado exitosamente.<br>";
    echo "Credenciales:<br>";
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "Contraseña: " . htmlspecialchars($password) . "<br>";
    echo "<p style='color:red; font-weight:bold;'>Por seguridad, elimine este archivo después de usarlo.</p>";
} else {
    echo "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt);
}

// Cerrar la consulta y la conexión
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
