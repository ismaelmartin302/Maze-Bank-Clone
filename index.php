<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Maze Bank</title>
</head>

<body>
    <header>
        <img src="logo.webp" alt="">
        <nav>
            <h1>MAZE BANK</h1>
            <h2>OF LOS SANTOS</h2>
        </nav>
    </header>
    <form action="./usuario.php" method="post">
        <h3>Introduce usuario</h3>
        <input type="text" name="usuario" placeholder="Usuario">
        <input type="password" name="contra" placeholder="Contraseña">
        <input type="submit" value="Iniciar Sesion" class="button">
    </form>
</body>

</html>
<?php
if (isset($_SESSION)) session_destroy();
?>