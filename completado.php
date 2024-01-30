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
$accion = null;
if ($_POST) {
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    $accion = $_SESSION["action"];
    $cantidad = $_POST["cantidad"];

    $resultado = $_SESSION["result"];
    $_SESSION["money"] = $resultado[2];
    $dinero = $_SESSION["money"];

    $texto = "Has $accion" . "do $cantidad" . "€";
    if ($accion == "ingresa") {
        $ingresar_dinero = "
            UPDATE usuarios
            SET saldo =" . $dinero+$cantidad ."
            WHERE nombre = '$username' AND contrasena = '$password';        
        ";
        mysqli_query($conn, $ingresar_dinero);
    } else if ($accion == "retira") {
        if ($cantidad > $dinero) {
            $texto = "No tienes suficiente dinero en la cuenta";
        } else {
            $retirar_dinero = "
            UPDATE usuarios
            SET saldo =" . $dinero-$cantidad ."
            WHERE nombre = '$username' AND contrasena = '$password';        
        ";
        mysqli_query($conn, $retirar_dinero);
        }
    }

    $buscar = "
    SELECT nombre, contrasena, saldo FROM usuarios
    WHERE nombre = '$username' AND contrasena = '$password';
    ";
    $resultado = mysqli_fetch_array(mysqli_query($conn, $buscar));
    $_SESSION["result"] = $resultado;
    $_SESSION["money"] = $resultado[2];
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
    <form action="./usuario.php" method="post">
        <h3><?php echo $texto?>  </h3>
        <input type="submit" value="Volver" class="button">
    </form>
</body>

</html>