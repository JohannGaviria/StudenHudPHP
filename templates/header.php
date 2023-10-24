<?php

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    // Destruir la sesión actual
    session_destroy();

    // Redirigir al usuario a la página de inicio o a donde desees
    header("Location: index.php"); // Cambia 'index.php' al nombre de tu página de inicio
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/logo/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/card.css">
    <link rel="stylesheet" href="../public/css/profile.css">
    
    <title>
        StudentHud |
        <?php if ($type == 'home') { echo 'Inicio'; } ?>
        <?php if ($type == 'job_offers') { echo 'Ofertas Laborales'; } ?>
        <?php if ($type == 'profile') { echo 'Perfil'; } ?>
    </title>
</head>
<body id="body">
    
    <header>
        <div class="icon-menu">
            <i class="fas fa-bars" id="btn-open"></i>
        </div>
        <h1>
            <?php if ($type == 'home') { echo 'Inicio'; } ?>
            <?php if ($type == 'job_offers') { echo 'Ofertas Laborales'; } ?>
            <?php if ($type == 'profile') { echo 'Perfil'; } ?>

        </h1>
    </header>

    <div class="menu-side" id="menu-side">
        
        <div class="name-page">
            <i>SH</i>
            <h4>StudentHud</h4>
        </div>

        <div class="options-menu">	

            <a href="index.php" class="<?php if ($type == 'home'): ?> selected <?php endif; ?>">
                <div class="option">
                    <i class="fas fa-home" title="Home"></i>
                    <h4>Inicio</h4>
                </div>
            </a>
            
            <a href="job-offers.php" class="<?php if ($type == 'job_offers'): ?> selected <?php endif; ?>">
                <div class="option">
                    <i class="fas fa-briefcase icon" title="Offers"></i>
                    <h4>Bolsa de Trabajo y Ofertas</h4>
                </div>
            </a>
            
            
            
            <a href="?logout=true">
                <div class="option">
                    <i class="fas fa-sign-out-alt icon" title="Go Out"></i>
                    <h4>Cerrar Sesión</h4>
                </div>
            </a>


        </div>
        
    </div>

