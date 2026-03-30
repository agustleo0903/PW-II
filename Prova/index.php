<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logística Express</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1> Cálculo de Frete</h1>

<h2>Digite as informações para o cálculo</h2>

    <form method="POST">
    Peso(Kg): <input type="number" name="Peso">
    Distância(Km): <input type="number" name="Distancia">
    Tipo de Envio(Normal ou Expresso): <input type="text" name="Tipo">
    <button type="submit">Calcular</button>
    </form>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Peso = $_POST[ "Peso"];
    $Distancia = $_POST[ "Distancia"];
    $Tipo = $_POST[ "Tipo"];

    $valor = 10;

$valor += $Distancia * 0.50;

if($Peso > 20) {
$valor += 30;
}

if($Tipo == "Expresso") {
    $valor += 20/100; 
}
 
echo "<h3> Valor final do Frete é: " . number_format ($valor, 2, ',', ',') . "</h3>"; 
}

?>
</body>
</html>

