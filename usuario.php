<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "mazebankDB");
if (!$conn) {
    echo "dfa" .mysqli_connect_error();
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<?php
$username = null;
$dinero = null;
if ($_POST) {
    $_SESSION["username"] = $_POST["usuario"];
    $_SESSION["password"] = $_POST["contra"];
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    $buscar = "
        SELECT nombre, contrasena, saldo FROM usuarios
        WHERE nombre = '$username' AND contrasena = '$password';
    ";
    $resultado = mysqli_fetch_array(mysqli_query($conn, $buscar));
    
    if (!isset($resultado)) {
        $crear_usuario = "
            INSERT INTO usuarios (nombre, contrasena, saldo) 
            VALUES ('$username', '$password', 1000.00);
        ";
        mysqli_query($conn, $crear_usuario);
        $resultado = mysqli_fetch_array(mysqli_query($conn, $buscar));
    }
    $_SESSION["result"] = $resultado;
    $_SESSION["money"] = $resultado[2];
    $dinero = $_SESSION["money"];



} else {
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    $dinero = $_SESSION["money"];
}
?>
<body>
    <header>
        <img src="logo.webp" alt="">
        <nav>
            <h1>MAZE BANK</h1>
            <h2>OF LOS SANTOS</h2>
        </nav>
        <h3><?php echo $dinero;?></h3>
    </header>
    <form action="./procesar.php" method="post">
        <h3>Bienvenido de nuevo</h3>
        <h3><?php echo $username ?></h3>
        
        <button class="button" value="ingresa" name="accion">Ingresar dinero</button>
        <button class="button" value="retira" name="accion">Retirar dinero</button>

    </form>
</body>

</html>