<?php

include "../../config/database.php"; 

try {
    $pdo = new PDO("mysql:host=localhost;dbname=php_studenthub", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// registro.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $birth_date = $_POST["birth-date"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    $institution = $_POST["institution"];
    $study_area = $_POST["study-area"];
    $direction = $_POST["direction"];
    $interests = $_POST["interest"];

    // Procesa la foto de perfil
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $targetDir = "../assets/uploads/img/user-img/"; // Ruta donde se guardarán las fotos
        $targetFile = basename($_FILES["photo"]["name"]);
        
        // Mueve la foto al directorio de destino
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            $photo = $targetFile;
        } else {
            echo "Error al subir la foto.";
            exit;
        }
    } else {
        echo "Error al procesar la foto de perfil.";
        exit;
    }

    // Verifica si el usuario ya existe en la base de datos
    $checkQuery = "SELECT id_user FROM users WHERE email = :email";
    $stmt = $pdo->prepare($checkQuery);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "El correo electrónico ya está registrado. Por favor, utiliza otro correo.";
    } else {
        // Inserta el nuevo usuario en la base de datos
        $insertQuery = "INSERT INTO users (name, email, password, birth_date, gender, phone, institution, study_area, direction, interests, photo)
                        VALUES (:name, :email, :password, :birth_date, :gender, :phone, :institution, :study_area, :direction, :interests, :photo)";
        $stmt = $pdo->prepare($insertQuery);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":birth_date", $birth_date, PDO::PARAM_STR);
        $stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->bindParam(":institution", $institution, PDO::PARAM_STR);
        $stmt->bindParam(":study_area", $study_area, PDO::PARAM_STR);
        $stmt->bindParam(":direction", $direction, PDO::PARAM_STR);
        $stmt->bindParam(":interests", $interests, PDO::PARAM_STR);
        $stmt->bindParam(":photo", $photo, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "¡Registro exitoso!";
            // Puedes redirigir al usuario a la página de inicio de sesión u otra página aquí.
            header('location: login.php');
            exit();
        } else {
            echo "Hubo un problema durante el registro. Inténtalo de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/logo/logo-white.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/users.css">
    <title>StudentHud | Formulario de Registro</title>
</head>
<body>
    <div class="container">
        <img src="../assets/logo/logo-complete-white.png">
        <h1>Registro de Usuario</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información Básica</legend>
                <label for="name">Nombre Completo:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </fieldset>

            <fieldset>
                <legend>Detalles Personales</legend>
                <label for="birth-date">Fecha de Nacimiento:</label>
                <input type="date" id="birth-date" name="birth-date" required>
                <label for="gender">Género:</label>
                <select id="gender" name="gender">
                    <option value="male">Masculino</option>
                    <option value="female">Femenino</option>
                    <option value="other">Otro</option>
                </select>
                <label for="phone">Teléfono de Contacto:</label>
                <input type="text" id="phone" name="phone">
            </fieldset>

            <fieldset>
                <legend>Información Académica</legend>
                <label for="institution">Universidad/Institución:</label>
                <input type="text" id="institution" name="institution" required>
                <label for="study-area">Carrera o Área de Estudio:</label>
                <input type="text" id="study-area" name="study-area" required>
            </fieldset>

            <fieldset>
                <legend>Preferencias y Personalización</legend>
                <label for="direction">Dirección:</label>
                <input type="text" id="direction" name="direction">
                <label for="interest">Intereses:</label>
                <textarea id="interest" name="interest" rows="3"></textarea>
                <label for="photo">Foto de Perfil:</label>
                <button type="button" class="btn-photo" onclick="openFileExplorer()">
                    <i class="fas fa-user-circle"></i>
                    <img id="photo-preview" src="#" class="photo-preview">
                </button>
                <input type="file" id="photo" name="photo" accept="image/*" style="display: none;"
                    onchange="displayPhoto(event)">
            </fieldset>

            <fieldset>
                <legend>Términos y Condiciones</legend>
                <label for="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    Acepto los Términos de Uso y la Política de Privacidad.
                </label>
            </fieldset>

            <p class="txt-record">¿Ya tienes cuenta? <a href="login.php"><span>inicia sesión aquí</span></a></p>

            <button type="submit">Registrarse</button>
        </form>
    </div>

    <script src="../js/users.js"></script>
</body>
</html>

