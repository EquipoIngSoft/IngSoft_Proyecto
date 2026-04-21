<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - EGAU Chess</title>
    <!-- Fuentes de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <!-- Hoja de estilos externa -->
    <link rel="stylesheet" href="{{ asset('css/logIn.css') }}">
</head>

<body>

    <div class="wrapper">

        <!-- ===== CAJA IZQUIERDA: Logo AMAAC ===== -->
        <div class="box-logo">
            <img src="{{ asset('Logos/LogoAmaac.png') }}" alt="Logo AMAAC">
            <span class="amaac-label">Asociación AMAAC</span>
        </div>

        <!-- ===== CAJA DERECHA: Formulario + Logo EGAU ===== -->
        <div class="box-form">

            <!-- Logo EGAU (el que no dice ALT) -->
            <img src="{{ asset('Logos/LogoEgau.png') }}" alt="Logo EGAU Chess" class="egau-logo">

            <!-- Nombre con fuente elegante -->
            <h1 class="egau-name">EGAU Chess</h1>

            <!-- Tabs con pill naranja deslizante -->
            <div class="tabs">
                <!-- Pill animado -->
                <div id="tab-pill"></div>
                <button class="tab-btn active" id="tab-alumno" onclick="switchTab('alumno')">Alumno</button>
                <button class="tab-btn" id="tab-personal" onclick="switchTab('personal')">Personal</button>
            </div>

            <!-- Formulario -->
            <form id="login-form" action="#" method="POST" style="width:100%;" novalidate>
                <input type="hidden" id="tipo-usuario" name="tipo" value="alumno">

                <div class="form-group">
                    <label for="username">Correo / Usuario</label>
                    <input type="email" id="username" name="username" placeholder="Ingresa tu correo" required>
                    <span class="error-msg" id="error-username"></span>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required minlength="6">
                    <div class="forgot-wrapper">
                        <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
                    </div>
                    <span class="error-msg" id="error-password"></span>
                </div>

                <button type="submit" class="login-btn">Iniciar sesión</button>
            </form>

        </div>
    </div>

    <!-- JS de animaciones -->
    <script src="{{ asset('animaciones/logIn.js') }}"></script>

</body>

</html>