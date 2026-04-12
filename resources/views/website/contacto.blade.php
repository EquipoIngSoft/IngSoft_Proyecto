<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - EGAU Chess</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/website/landing.css') }}">
</head>
<body>

    @include('website.header')

    <section class="page-hero">
        <h1>Contáctanos</h1>
        <p>Estamos aquí para resolver todas tus dudas</p>
    </section>

    <section class="seccion">
        <div class="contenedor">
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">

                <div style="display:flex; flex-direction:column; gap:20px;">
                    <h2 style="font-size:24px; color:var(--negro);">Información de contacto</h2>
                    <div class="sede-tarjeta">
                        <h3>Sede Centro</h3>
                        <p>📍 Av. Principal #123, Centro, Morelia</p>
                        <p>📞 (443) 123-4567</p>
                        <p>✉️ centro@egauchess.mx</p>
                        <p>🕐 Lun - Vie: 9:00 - 19:00</p>
                    </div>
                    <div class="sede-tarjeta">
                        <h3>Sede Norte</h3>
                        <p>📍 Calle Norte #456, Col. Las Palmas</p>
                        <p>📞 (443) 765-4321</p>
                        <p>✉️ norte@egauchess.mx</p>
                        <p>🕐 Lun - Sáb: 10:00 - 18:00</p>
                    </div>
                </div>

                <div class="form-contacto">
                    <h2 style="font-size:22px; color:var(--negro); margin-bottom:20px;">Envíanos un mensaje</h2>
                    <div class="form-grupo">
                        <label>Nombre completo *</label>
                        <input type="text" placeholder="Tu nombre">
                    </div>
                    <div class="form-grupo">
                        <label>Correo electrónico *</label>
                        <input type="email" placeholder="tucorreo@ejemplo.com">
                    </div>
                    <div class="form-grupo">
                        <label>Teléfono (opcional)</label>
                        <input type="tel" placeholder="(443) 000-0000">
                    </div>
                    <div class="form-grupo">
                        <label>Asunto *</label>
                        <select>
                            <option value="">Selecciona un asunto</option>
                            <option>Información sobre cursos</option>
                            <option>Pre-inscripción</option>
                            <option>Torneos</option>
                            <option>Otro</option>
                        </select>
                    </div>
                    <div class="form-grupo">
                        <label>Mensaje *</label>
                        <textarea placeholder="Escribe tu mensaje aquí..."></textarea>
                    </div>
                    <button class="btn-primario btn-completo">Enviar mensaje</button>
                </div>

            </div>
        </div>
    </section>

    @include('website.footer')

</body>
</html>