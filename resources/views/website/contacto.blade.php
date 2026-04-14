<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - EGAU Chess</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
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
            <div style="display:grid; grid-template-columns: 1fr 1.2fr; gap: 40px; align-items: start;">

                <!-- Información de contacto -->
                <div style="display:flex; flex-direction:column; gap:20px;">
                    <div>
                        <h2 style="font-size:22px; font-weight:700; color:var(--negro); margin-bottom:6px;">Información de contacto</h2>
                        <p style="font-size:14px; color:var(--texto-suave);">Visítanos en cualquiera de nuestras sedes</p>
                    </div>

                    <div class="sede-tarjeta">
                        <h3>Sede Centro</h3>
                        <p><i class="ri-map-pin-2-line"></i> Av. Principal #123, Centro, Morelia</p>
                        <p><i class="ri-phone-line"></i> (443) 123-4567</p>
                        <p><i class="ri-mail-line"></i> centro@egauchess.mx</p>
                        <p><i class="ri-time-line"></i> Lun - Vie: 9:00 - 19:00</p>
                    </div>

                    <div class="sede-tarjeta">
                        <h3>Sede Norte</h3>
                        <p><i class="ri-map-pin-2-line"></i> Calle Norte #456, Col. Las Palmas</p>
                        <p><i class="ri-phone-line"></i> (443) 765-4321</p>
                        <p><i class="ri-mail-line"></i> norte@egauchess.mx</p>
                        <p><i class="ri-time-line"></i> Lun - Sáb: 10:00 - 18:00</p>
                    </div>
                </div>

                <!-- Formulario de contacto -->
                <div class="form-contacto">
                    <div style="margin-bottom:26px;">
                        <h2 style="font-size:22px; font-weight:700; color:var(--negro); margin-bottom:4px;">Envíanos un mensaje</h2>
                        <p style="font-size:14px; color:var(--texto-suave);">Te responderemos en menos de 24 horas</p>
                    </div>

                    <fieldset style="border:none; padding:0; margin:0 0 18px; display:grid; grid-template-columns:1fr 1fr; gap:14px;">
                        <legend style="display:none;">Datos personales</legend>
                        <div class="form-grupo" style="margin:0;">
                            <label for="c-nombre">Nombre *</label>
                            <input type="text" id="c-nombre" name="nombre" placeholder="Tu nombre">
                        </div>
                        <div class="form-grupo" style="margin:0;">
                            <label for="c-apellido">Apellido *</label>
                            <input type="text" id="c-apellido" name="apellido" placeholder="Tu apellido">
                        </div>
                    </fieldset>

                    <div class="form-grupo">
                        <label for="c-correo">Correo electrónico *</label>
                        <input type="email" id="c-correo" name="correo" placeholder="tucorreo@ejemplo.com">
                    </div>

                    <div class="form-grupo">
                        <label for="c-telefono">Teléfono (opcional)</label>
                        <input type="tel" id="c-telefono" name="telefono" placeholder="(443) 000-0000">
                    </div>

                    <div class="form-grupo">
                        <label for="c-asunto">Asunto *</label>
                        <select id="c-asunto" name="asunto">
                            <option value="">Selecciona un asunto</option>
                            <option>Información sobre cursos</option>
                            <option>Pre-inscripción</option>
                            <option>Torneos</option>
                            <option>Otro</option>
                        </select>
                    </div>

                    <div class="form-grupo">
                        <label for="c-mensaje">Mensaje *</label>
                        <textarea id="c-mensaje" name="mensaje" placeholder="Escribe tu mensaje aquí..."></textarea>
                    </div>

                    <button class="btn-primario btn-completo">Enviar mensaje</button>
                </div>

            </div>
        </div>
    </section>

    @include('website.footer')

</body>
</html>