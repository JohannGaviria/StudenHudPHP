<?php

// Incluye la configuración de la base de datos
include_once('../config/database.php'); 

// Obtener el valor actual del campo 'searchs' del usuario
$user_id = $_SESSION["user_id"];
$get_searchs_query = "SELECT searchs FROM users WHERE id_user = :user_id";
$stmt_get_searchs = $pdo->prepare($get_searchs_query);
$stmt_get_searchs->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_get_searchs->execute();
$current_searchs = $stmt_get_searchs->fetchColumn();

// Dividir las palabras clave en el campo 'searchs' en un conjunto
$current_searchs_set = array_map('trim', explode(',', $current_searchs));
$current_searchs_set = array_unique($current_searchs_set);

// Consulta SQL para buscar ofertas relacionadas con las palabras clave
if (!empty($current_searchs_set)) {
    // Construir la parte WHERE de la consulta SQL con condiciones OR para cada palabra clave
    $where_conditions = [];
    foreach ($current_searchs_set as $search_term) {
        $where_conditions[] = "title LIKE :searchTerm";
    }
    $where_clause = implode(" OR ", $where_conditions);

    // Consulta SQL final
    $searchQuery = "SELECT * FROM job_offers WHERE $where_clause";
    $searchStmt = $pdo->prepare($searchQuery);

    // Vincular los parámetros de búsqueda para cada palabra clave
    foreach ($current_searchs_set as $search_term) {
        $search_term = "%" . $search_term . "%";
        $searchStmt->bindParam(':searchTerm', $search_term, PDO::PARAM_STR);
    }

    // Ejecutar la consulta
    $searchStmt->execute();
    $results = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
}

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