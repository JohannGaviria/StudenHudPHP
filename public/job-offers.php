<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["user_id"])) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: users/login.php"); // Cambia "login.php" por la ruta de tu página de inicio de sesión.
    exit();
}

$type = 'job_offers';

include "../config/database.php"; 

$search_results = [];

if (isset($_POST["search-query"])) {
    $search_query = $_POST["search-query"];

    // Preparar la consulta SQL con una declaración preparada
    $sql_search = "SELECT * FROM job_offers WHERE 
                    title LIKE :query OR 
                    company LIKE :query OR 
                    description LIKE :query OR 
                    location LIKE :query OR 
                    requirements LIKE :query OR 
                    salary LIKE :query";
    $stmt = $pdo->prepare($sql_search);

    // Comprobar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $pdo->errorInfo()[2]);
    }

    // Agregar comodines '%' a la consulta para buscar parcialmente
    $search_query = '%' . $search_query . '%';

    // Vincular los parámetros y ejecutar la consulta
    $stmt->bindParam(':query', $search_query, PDO::PARAM_STR);
    $stmt->execute();

    // Obtener los resultados de la consulta
    $search_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Resto de tu código

include_once('../templates/php/info-job.php');
include_once('../templates/header.php');
?>

<main>

    <div class="search-container-general">
        <div class="header-info">
            <a href="add-job-offers.php" class="post">Publicar Oferta</a>
            <form action="" method="POST" style="margin-top: 15px;">
                <input type="text" name="search-query" placeholder="Buscar..." class="search" />
                <button type="submit" class="btn-search" title="Buscar ofertas"><i class="fa fa-search" id="searchIcon"></i></button>
                <button type="submit" class="btn-filter" name="show-all-offers" title="Mostrar todas las ofertas"><i class="fas fa-filter"></i></button>
            </form>
        </div>
    </div>

    <?php if (!empty($search_results)): ?>
        <h3 class="title-section">Resultados de Búsqueda</h3>
        <div class="result-search container">
            <?php foreach ($search_results as $job_offer): ?>
                <?php include "../templates/card-template.php"; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (empty($search_results)): ?>
        <h3 class="title-section">Nuevas Ofertas de Trabajo</h3>
        <div class="new-job-offerts container">
            <?php foreach ($new_job_offers as $job_offer): ?>
                <?php include "../templates/card-template.php"; ?>
            <?php endforeach; ?>
        </div>

        <h3 class="title-section">Ofertas de Trabajo</h3>
        <div class="job-offers-section container">
            <?php foreach ($job_offers as $job_offer): ?>
                <?php include "../templates/card-template.php"; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</main>

<?php include_once('../templates/footer.php'); ?>
