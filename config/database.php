<?php
// Definir los parámetros de conexión a la base de datos MySQL.
$host = "localhost";           // Host de la base de datos (puede cambiar).
$user = "root";                // Nombre de usuario de la base de datos.
$password = "";                // Contraseña del usuario de la base de datos (en blanco en este caso).
$database = "php_studenthub";      // Nombre de la base de datos a la que se conectará.

try {
    // Establecer la conexión a la base de datos MySQL utilizando PDO.
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);

    // Configurar el modo de error de PDO para que lance excepciones en caso de error.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Conexión exitosa a la base de datos.";

    // Ahora puedes utilizar la variable $pdo para realizar consultas y operaciones en la base de datos.
} catch (PDOException $e) {
    die("Error al conectarse a la base de datos: " . $e->getMessage());
}
?>
