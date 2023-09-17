<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["user_id"])) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: users/login.php"); // Cambia "login.php" por la ruta de tu página de inicio de sesión.
    exit();
}

$type = 'job_offers';

// Incluye la configuración de la base de datos
include_once('../config/database.php'); 

// Consulta SQL para obtener nuevas ofertas de trabajo
$newJobOffersQuery = "SELECT * FROM job_offers WHERE is_new_job = 'isNew' ORDER BY publication_date DESC LIMIT 5";
$newJobOffersStmt = $pdo->prepare($newJobOffersQuery);
$newJobOffersStmt->execute();
$new_job_offers = $newJobOffersStmt->fetchAll(PDO::FETCH_ASSOC);

// Consulta SQL para obtener todas las ofertas de trabajo
$jobOffersQuery = "SELECT * FROM job_offers ORDER BY publication_date DESC";
$jobOffersStmt = $pdo->prepare($jobOffersQuery);
$jobOffersStmt->execute();
$job_offers = $jobOffersStmt->fetchAll(PDO::FETCH_ASSOC);

// Inicializa la variable de resultados de búsqueda
$search_results = [];

// Verifica si se ha enviado el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search-query'])) {
    // Recopila el término de búsqueda desde el formulario
    $searchTerm = "%".$_POST['search-query']."%";

    // Consulta SQL para realizar la búsqueda
    $searchQuery = "SELECT * FROM job_offers WHERE title LIKE :searchTerm";
    $searchStmt = $pdo->prepare($searchQuery);
    $searchStmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $searchStmt->execute();
    $search_results = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<?php include_once('../templates/header.php'); ?>

<main>

    <div class="search-container-general">
        <div class="header-info">
            <a href="add-job-offers.php" class="post">Publicar Oferta</a>
            <form action="/app/job-offers" method="POST" style="margin-top: 15px;">
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
