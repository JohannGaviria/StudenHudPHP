<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["user_id"])) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: users/login.php"); // Cambia "login.php" por la ruta de tu página de inicio de sesión.
    exit();
}

$type = 'home';

?>

<?php include_once('../templates/php/info-job.php'); ?>
<?php include_once('../templates/header.php'); ?>

<main>

    <div class="search-container-general">
        <div class="header-info">
            <h2>Bienvenido <span><?php echo $_SESSION['user_name']; ?></span>, ¿Qué buscas?</h2>
            <form method="get" action="buscar.php">
                <input type="text" name="q" placeholder="Buscar..." class="search" />
                <button type="submit" class="btn-search">Buscar</button>
            </form>
        </div>
    </div>

    <h3 class="title-section">Publicaciones de interés</h3>
    <div class="interest-posts container">
        <?php foreach ($results as $job_offer): ?>
            <?php include "../templates/card-template.php"; ?>
        <?php endforeach; ?>
    </div>

    <h3 class="title-section">Ofertas de Trabajo</h3>
    <div class="job-offers-section container">
        <?php foreach ($job_offers as $job_offer): ?>
            <?php include "../templates/card-template.php"; ?>
        <?php endforeach; ?>
    </div>

</main>

<?php include_once('../templates/footer.php'); ?>