<?php

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