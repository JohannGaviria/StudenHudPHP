<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["user_id"])) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: users/login.php"); // Cambia "login.php" por la ruta de tu página de inicio de sesión.
    exit();
}

include "../config/database.php"; 

try {
    $pdo = new PDO("mysql:host=localhost;dbname=php_studenthub", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopila los datos del formulario
    $idUser = $_SESSION["user_id"];
    $title = $_POST["title"];
    $img = $_FILES["photo"]["name"];
    $description = $_POST["description"];
    $company = $_POST["company"];
    $location = $_POST["location"];
    $requirements = $_POST["requirements"];
    $publication_date = $_POST["publication-date"];
    $expiration_date = $_POST["expiration-date"];
    $contract_type = $_POST["contract-type"];
    $salary = $_POST["salary"];
    // $contact_form = $_POST["contact-form"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $linkedin = $_POST["linkedin"];
    $file = $_FILES["file"]["name"];

    // Procesa la foto de perfil
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $targetDirPhoto = "img/"; // Ruta donde se guardarán las fotos
        $targetFilePhoto = basename($_FILES["photo"]["name"]);
        
        // Mueve la foto al directorio de destino
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePhoto)) {
            $photo = $targetFilePhoto;
        } else {
            echo "Error al subir la foto.";
            exit;
        }
    } else {
        echo "Error al procesar la foto.";
        exit;
    }

    // Procesa el archivo adjunto
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $targetDirFile = "assets/uploads/file/jobs-file/"; // Ruta donde se guardarán los archivos adjuntos
        $targetFileFile = basename($_FILES["file"]["name"]);

        // Mueve el archivo adjunto al directorio de destino
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFileFile)) {
            $file = $targetFileFile;
        } else {
            echo "Error al subir el archivo adjunto.";
            exit;
        }
    } else {
        echo "Error al procesar el archivo adjunto.";
        exit;
    }

    // Inserta la oferta de trabajo en la base de datos
    $insertQuery = "INSERT INTO job_offers (id_user, img, title, description, company, location, requirements, publication_date, expiration_date, contract_type, salary, contact_email, contact_phone, contact_linkedin, file)
                    VALUES (:id_user, :img, :title, :description, :company, :location, :requirements, :publication_date, :expiration_date, :contract_type, :salary, :contact_email, :contact_phone, :contact_linkedin, :file)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->bindParam(":id_user", $idUser, PDO::PARAM_STR);
    $stmt->bindParam(":img", $img, PDO::PARAM_STR);
    $stmt->bindParam(":title", $title, PDO::PARAM_STR);
    $stmt->bindParam(":description", $description, PDO::PARAM_STR);
    $stmt->bindParam(":company", $company, PDO::PARAM_STR);
    $stmt->bindParam(":location", $location, PDO::PARAM_STR);
    $stmt->bindParam(":requirements", $requirements, PDO::PARAM_STR);
    $stmt->bindParam(":publication_date", $publication_date, PDO::PARAM_STR);
    $stmt->bindParam(":expiration_date", $expiration_date, PDO::PARAM_STR);
    $stmt->bindParam(":contract_type", $contract_type, PDO::PARAM_STR);
    $stmt->bindParam(":salary", $salary, PDO::PARAM_STR);
    $stmt->bindParam(":contact_email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":contact_phone", $phone, PDO::PARAM_STR);
    $stmt->bindParam(":contact_linkedin", $linkedin, PDO::PARAM_STR);
    $stmt->bindParam(":file", $file, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "¡Oferta de trabajo registrada exitosamente!";
        // Puedes redirigir al usuario a la página de inicio de ofertas de trabajo u otra página aquí.
        header('location: job-offers.php');
        exit();
    } else {
        echo "Hubo un problema durante el registro de la oferta de trabajo. Inténtalo de nuevo.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/register-job-offers.css">
    <title>StudentHud | Registro de oferta de trabajo</title>
</head>

<body>

    <div class="container">

        <a href="job-offers.php"><i class="fas fa-arrow-left"></i></a>
        <form action="" method="POST" enctype="multipart/form-data">
            <h2>Registra nueva oferta de trabajo</h2>
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" required>

            <label for="img">Imagen:</label>
            <input type="file" name="photo" id="img" style="margin-bottom: 10px;">

            <label for="description">Descripción:</label><br>
            <textarea id="descrition" name="description" rows="4" cols="50" required></textarea>

            <label for="company">Empresa:</label>
            <input type="text" id="company" name="company" required>

            <label for="location">Ubicación:</label>
            <input type="text" id="location" name="location" required>

            <label for="requirements">Requisitos:</label><br>
            <textarea id="requirements" name="requirements" rows="4" cols="50" required></textarea>

            <label for="publication-date">Fecha de Publicación:</label>
            <input type="date" id="publication-date" name="publication-date" required>

            <label for="expiration-date">Fecha de Vencimiento:</label>
            <input type="date" id="expiration-date" name="expiration-date" required>

            <label for="contract-type">Tipo de Contrato:</label>
            <select id="contract-type" name="contract-type" required>
                <option value="fullTime">Tiempo Completo</option>
                <option value="halfTime">Medio Tiempo</option>
                <option value="preatic">Prácticas</option>
            </select>

            <label for="salary">Salario:</label>
            <input type="text" id="salary" name="salary">

            <label for="contact-form">Forma de Contacto:</label>
            <select id="contact-form" onchange="showForm()">
                <option>Seleciona</option>
                <option value="all">Todas</option>
                <option value="email">Correo</option>
                <option value="phone">Celular</option>
                <option value="linkedin">LinkedIn</option>
            </select>

            <div id="email-field" style="display: none;">
                <label for="email">Correo:</label>
                <input type="text" id="email" name="email">
            </div>

            <div id="phone-field" style="display: none;">
                <label for="phone">Celular:</label>
                <input type="text" id="phone" name="phone">
            </div>

            <div id="linkedin-field" style="display: none;">
                <label for="linkedin">LinkedIn:</label>
                <input type="text" id="linkedin" name="linkedin">
            </div>

            <label for="file">Adjuntar Archivo:</label>
            <input type="file" id="file" name="file">

            <input type="submit" value="Publicar Oferta">
        </form>
    </div>

    <script src="js/register-job-offers.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const phoneInput = document.getElementById("phone");
            const form = document.querySelector("form");

            form.addEventListener("submit", function (event) {
                const phoneNumber = phoneInput.value;
                if (phoneNumber.includes(" ")) {
                    event.preventDefault(); // Evitar el envío del formulario
                    alert("No se permiten espacios en blanco en el número de teléfono.");
                }
            });
        });
    </script>


</body>

</html>