<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
     <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Iconos (Remix Icons) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Hoja de estilos -->
    <link rel="stylesheet" href="{{ asset('./css/website/cursos.css') }}">
</head>
<body>
    

    <div class="content">
        <h1 class="main-title">Registro de Usuario</h1>
    <div class="btn-container">
        
    </div>
     
    </div>
    <form action="/registrar" method="POST">
    <fieldset>
        <legend>Información del Tutor <small>(Si es el caso)</small></legend>
        <label for="nombre">Nombre del tutor:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido1">Primer apellido del tutor:</label>
        <input type="text" id="apellido1" name="apellido1" required><br><br>

        <label for="apellido2">Segundo apellido del tutor:</label>
        <input type="text" id="apellido2" name="apellido2"><br><br>

        <label for="telefono">Teléfono del tutor:</label>
        <input type="tel" id="telefono" name="telefono" required><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="parentezco">Parentesco con el estudiante:</label>
        <input type="text" id="parentezco" name="parentezco" required><br><br>

    
        
    </fieldset>

    <fieldset>
        <legend>Información del Estudiante</legend>
        <label for="nombre_estudiante">Nombre del estudiante:</label>
        <input type="text" id="nombre_estudiante" name="nombre_estudiante" required><br><br>

        <label for="apellido1_estudiante">Primer apellido del estudiante:</label>
        <input type="text" id="apellido1_estudiante" name="apellido1_estudiante" required><br><br>

        <label for="apellido2_estudiante">Segundo apellido del estudiante:</label>
        <input type="text" id="apellido2_estudiante" name="apellido2_estudiante"><br><br>

        <label for="sexo">Género:</label>
        <select id="sexo" name="sexo" required>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
        </select><br><br>

        <label for="telefono_estudiante">Teléfono del estudiante:</label>
        <input type="tel" id="telefono_estudiante" name="telefono_estudiante" required><br><br>

        <label for="email_estudiante">Correo Electrónico del estudiante:</label>
        <input type="email" id="email_estudiante" name="email_estudiante" required><br><br>

        <label for="fecha_nacimiento">Fecha de nacimiento del estudiante:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
    </fieldset>
   
</form>
 <div class="btn-container">

        <a href="/cursos"><button type="submit" class="btn">Registrar</button></a>
        <a href="/cursos"><button type="submit" class="btn">Volver</button></a>
        
    </div>

    <br>

 
    
</body>
</html>  