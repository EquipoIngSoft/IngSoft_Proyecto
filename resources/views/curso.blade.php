<!DOCTYPE html>
<html lang="es">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Curso</title>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('./css/website/cursos.css') }}">
</head>
<body>
    
    <div class="bar">
        <a href="/">
        <div class="sidebar-logo">
            
                <img src="{{ asset('./Logos/LogoEgau.png') }}" alt="EGAU Chess" class="sidebar-logo-img">
           
            <span class="sidebar-brand">EGAU Chess</span>
        </div>
         </a>

        <div class="controls-container centrar">
             <a href="/cursos" class="btn" style="text-decoration: none; margin-top: 10px;">
                 <i class="ri-arrow-left-line"></i> Volver al Catálogo
             </a>
        </div>

        <div class="bar-menu btn-container">
            <a href="/login" class="bar-item active" style="text-decoration: none;">Iniciar sesión</a>
        </div>
    </div>
    <br>
    
    <main>
        <div class="content">
            <h1 class="main-title">Curso de Ajedrez para Principiantes</h1>
            <div class="centrar" style="gap: 15px;">
                <span class="badge badge-principiante">Nivel: Principiante</span>
                <span class="badge badge-activo">Modalidad: En línea</span>
                <span class="badge badge-intermedio">Sede: Sede 1</span>
            </div>
        </div>

        <div class="two-content">
            <div>
        
                <img src="{{ asset('./Logos/LogoAmaac.png') }}" alt="Curso Principiantes" style="width: 100%; border-radius: 12px;">
               <br><br>
               
            </div>

            <div>
                <div class="card">
                    <h3 class="curso-title">Acerca de este curso</h3>
                    <br>
                    <p class="curso-description">
                        Aprende las reglas básicas del ajedrez, movimientos de las piezas y estrategias iniciales para comenzar tu camino en el mundo del ajedrez. Ideal para jugadores que inician desde cero o desean reforzar sus fundamentos antes de pasar a tácticas más complejas.
                    </p>
                    <br><br>
                    
                    <div class="content">
                    <h3 class="curso-title">Detalles Técnicos</h3>
                    <p class="curso-description"><strong>Sede:</strong> Morelia, Michoacán</p>
                    <p class="curso-description"><strong>Duración:</strong> 4 semanas</p>
                    <p class="curso-description"><strong>Horario:</strong> Tarde (16:00 - 18:00 hrs)</p>
                    <p class="curso-description"><strong>Instructor:</strong> Mtro. Ilse Arreola</p>
                      <a href="/registro" class="centrar"> <button class="btn-inscribirse" onclick="irARegistro()">Solicitar inscripción</button></a>
        </a>    
                </div>
                        
                </div>
              
                
            </div>
            
        </div>
    </main>
</body>
</html>