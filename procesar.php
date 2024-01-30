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
$dinero = null;
$accion = null;
if ($_POST) {
    $_SESSION["action"] = $_POST["accion"];
    $accion = $_SESSION["action"];


    $resultado = $_SESSION["result"];
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
    <form action="./completado.php" method="post">
        <h3>Elige la cantidad a <?php echo $accion."r"?></h3>
        <section>
            <input type="submit" name="cantidad" value="5" class="button">
            <input type="submit" name="cantidad" value="10" class="button">
            <input type="submit" name="cantidad" value="20" class="button">
            <input type="submit" name="cantidad" value="50" class="button">
            <input type="submit" name="cantidad" value="100" class="button">
            <input type="submit" name="cantidad" value="200" class="button">
            <input type="submit" name="cantidad" value="500" class="button">
        </section>
    </form>
</body>

</html>