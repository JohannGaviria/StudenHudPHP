<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/header.css">
    <title>StudentHud</title>
</head>
<body>
<header>
        <div class="icon-menu">
            <i class="fas fa-bars" id="btn-open"></i>
        </div>
        <h1>
            {% if type == 'home' %} Inicio {% endif %}
            {% if type == 'job_offers' %} Ofertas Laborales {% endif %}
            {% if type == 'room_rentals' %} Arriendo de Habitaciones {% endif %}
        </h1>
    </header>

    <div class="menu-side" id="menu-side">
        
        <div class="name-page">
            <i>SH</i>
            <h4>StudentHud</h4>
        </div>

        <div class="options-menu">	

            <a href="{{ url_for('home') }}" class="{% if type == 'home' %} selected {% endif %}">
                <div class="option">
                    <i class="fas fa-home" title="Home"></i>
                    <h4>Inicio</h4>
                </div>
            </a>
            
            <a href="{{ url_for('job_offers') }}" class="{% if type == 'job_offers' %} selected {% endif %}">
                <div class="option">
                    <i class="fas fa-briefcase icon" title="Offers"></i>
                    <h4>Bolsa de Trabajo y Ofertas</h4>
                </div>
            </a>
            
            <a href="{{ url_for('room_rentals') }}" class="{% if type == 'room_rentals' %} selected {% endif %}">
                <div class="option">
                    <i class="fas fa-bed icon" title="Rent"></i>
                    <h4>Arriendo de Habitaciones</h4>
                </div>
            </a>
            
            <a href="#">
                <div class="option">
                    <i class="fas fa-user-circle icon" title="User"></i>
                    <h4>Perfil de Usuario</h4>
                </div>
            </a>
            
            <a href="{{ url_for('logout') }}">
                <div class="option">
                    <i class="fas fa-sign-out-alt icon" title="Go Out"></i>
                    <h4>Cerrar Sesion</h4>
                </div>
            </a>

        </div>
        
    </div>

    
</body>
</html>