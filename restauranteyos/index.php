<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Pizzeria Yosi</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #343a40;
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

        .hero {
    position: relative;
    background-image: url('https://www.comedera.com/wp-content/uploads/2015/10/ensalada-de-pollo.jpg'); /* Imagen de comida */
    background-size: cover;
    background-position: center;
    color: black;
    text-align: center;
    padding: 100px 20px;
    margin-bottom: 20px;
}

.hero::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.5); /* Fondo blanco semi-transparente */
    z-index: 1;
}

.hero h2, .hero p, .hero .button-wrapper {
    position: relative;
    z-index: 2; /* Asegura que el texto y el botón estén por encima del fondo semi-transparente */
}


        .hero h2 {
            margin: 0;
            font-size: 2.5em;
        }

        .hero p {
            font-size: 1.2em;
        }

        .hero .button-wrapper {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            background-image: url('path/to/your-background-image.jpg'); /* Imagen de fondo detrás del botón */
            background-size: cover;
            background-position: center;
            border-radius: 5px;
        }

        .hero .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            position: relative;
            z-index: 1; /* Asegura que el botón esté encima de la imagen de fondo */
        }

        .hero .button:hover {
            background-color: #0056b3;
        }

        .about {
            padding: 20px;
            text-align: center;
        }

        .about img {
            max-width: 150px; /* Ajusta el ancho máximo según tus necesidades */
            height: auto;
            margin: 10px;
            border-radius: 8px; /* Opcional: Redondea las esquinas de las imágenes */
            border: 2px solid #ddd; /* Opcional: Añade un borde */
        }

        footer {
            background-color: #343a40;
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
            <h1>Bienvenido a Pizzeria Yosi</h1>
            <nav>
                <ul>
                    <li><a href="login.php">Iniciar Sesión</a></li>
                    <li><a href="register.php">Registrarse</a></li>
                    <li><a href="order.php">Realizar Pedido</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="hero">
            <h2>Disfruta de nuestra deliciosa comida</h2>
            <p>Explora nuestro menú y realiza tu pedido en línea.</p>
            <div class="button-wrapper">
                <a href="order.php" class="button">Ver Menú y Ordenar</a>
            </div>
        </section>
        <section class="about">
            <h2>Sobre Nosotros</h2>
            <p>Somos un restaurante relativamente nuevo que quiere probar suerte en el mercado, estamos encantados de servirles <3</p>
            <img src="IMG/pizza.jpg" alt="Pizzas">
            <img src="IMG/tallarin.jpg" alt="Pastas">
            <img src="IMG/helado.jpg" alt="Ensalada">
        </section>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Pizzeria Y. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
