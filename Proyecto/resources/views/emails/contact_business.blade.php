<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto para {{ $negocio->nombre_negocio }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #0d6efd; /* Bootstrap primary color */
            color: #ffffff;
            padding: 10px 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            margin-bottom: 10px;
        }
        .details {
            background-color: #f9f9f9;
            border-left: 4px solid #0d6efd;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }
        .details strong {
            color: #0d6efd;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
        .button {
            display: inline-block;
            background-color: #0d6efd;
            color: #ffffff !important;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Contacto para {{ $negocio->nombre_negocio }}</h1>
        </div>
        <div class="content">
            <p>Has recibido un nuevo mensaje de contacto a través del Directorio Comercial.</p>
            <p><strong>Negocio:</strong> {{ $negocio->nombre_negocio }}</p>

            <div class="details">
                <p><strong>De:</strong> {{ $contactData['nombre_interesado'] }}</p>
                <p><strong>Correo:</strong> <a href="mailto:{{ $contactData['correo_interesado'] }}">{{ $contactData['correo_interesado'] }}</a></p>
                <p><strong>Teléfono:</strong> {{ $contactData['telefono_interesado'] }}</p>
                <p><strong>Mensaje:</strong></p>
                <p style="background-color: #eee; padding: 10px; border-radius: 4px;">{{ $contactData['mensaje'] }}</p>
            </div>

            @if($negocio->id_negocio)
                <p>Puedes ver el negocio en el directorio haciendo clic aquí:</p>
                <a href="{{ url('/negocio/' . $negocio->id_negocio) }}" class="button">Ver Negocio</a>
            @endif
        </div>
        <div class="footer">
            <p>Este correo fue enviado automáticamente desde el Directorio Comercial.</p>
        </div>
    </div>
</body>
</html>
