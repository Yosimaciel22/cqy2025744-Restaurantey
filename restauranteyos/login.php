<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Pizzeria Y</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-image: url('https://cdn.vox-cdn.com/thumbor/5d_RtADj8ncnVqh-afV3mU-XQv0=/0x0:1600x1067/1200x900/filters:focal(672x406:928x662)/cdn.vox-cdn.com/uploads/chorus_image/image/57698831/51951042270_78ea1e8590_h.7.jpg'); /* Imagen de fondo general */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        header {
            background-image: url('https://images.unsplash.com/photo-1556740738-b6a63e6e0d41'); /* Imagen de fondo para el header */
            background-size: cover;
            background-position: center;
            background-color: rgba(0, 0, 0, 0.6); /* Fondo oscuro con opacidad */
            color: white;
            padding: 10px 0;
        }

        header .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 120px); /* Altura ajustada para el header y footer */
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9); /* Fondo blanco con opacidad */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .form-container h2 {
            margin-top: 0;
        }

        .form-container input {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .form-container p {
            margin: 10px 0 0;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.8); /* Fondo oscuro */
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Iniciar Sesión</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="register.php">Registrarse</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="form-container">
            <h2>Iniciar Sesión</h2>
            <form method="POST" action="login_process.php">
                <input type="email" name="correo" placeholder="Correo" required>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Pizzeria Y. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
