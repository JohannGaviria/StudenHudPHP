<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=php_studenthub", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Error de conexión a la base de datos: " . $e->getMessage());
    }

    // Consulta para obtener el usuario con el correo electrónico proporcionado
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        // Las contraseñas coinciden, el usuario está autenticado
        $_SESSION["user_id"] = $user["id_user"];
        $_SESSION["user_name"] = $user["name"];
        header("Location: ../index.php");
        exit();
    } else {
        echo "Credenciales incorrectas. Por favor, verifica tu correo electrónico y contraseña.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/logo/logo-white.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/users.css">
    <title>StudentHud | Iniciar Sesión</title>
</head>
<body class="form-login">
    <div class="container">
        <img src="../assets/logo/logo-complete-white.png" alt="">
        <h1>Iniciar Sesión</h1>
        <form method="POST">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <p class="txt-record">¿No tienes cuenta? <a href="register.php"><span>regístrate aquí</span></a></p>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
