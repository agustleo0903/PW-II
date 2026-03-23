<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Calculadora de IMC</title>
</head>

<body>
  <?php
  // echo "<h3>Estado atual do POST:</h3>";
  // var_dump($_POST); // Mostra para o aluno se a "mochila" chegou cheia ou vazia
  ?>

  <h2>Calculadora de IMC</h2>
  <form method="POST" action="imc.php">
    <label>Peso (kg):</label><br>
    <input type="text" name="peso" placeholder="Ex: 80.5" required><br><br>

    <label>Altura (m):</label><br>
    <input type="text" name="altura" placeholder="Ex: 1.75" required><br><br>

    <button type="submit">Calcular Agora</button>
  </form>

  <?php
  /* ESTÁGIO 1: LÓGICA PURA (SEM FORMULÁRIO)
  $peso = 85.5;
  $altura = 1.75;
  $imc = $peso / ($altura * $altura);
  echo "IMC Fixo: " . $imc;
  */

  /* ESTÁGIO 2: PROCESSAMENTO DIRETO DO POST
  if ($_POST) {
      $p = (float)$_POST['peso'];
      $a = (float)$_POST['altura'];
      $res = $p / ($a * $a);
      echo "Resultado Direto: " . number_format($res, 2);
  }
  */

  // ESTÁGIO 3: PADRÃO PRG (Post-Redirect-Get)
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $p = $_POST['peso'];
    $a = $_POST['altura'];
    $res = $p / ($a * $a);

    // Redireciona para limpar o POST e passa o valor via GET
    header("Location: imc.php?resultado=" . number_format($res, 2) . "&peso=" . $p  . "&altura=" . $a);
    exit;
  }

  if (isset($_GET['resultado'])) {
    echo "<h3>Resultado (via GET): " . $_GET['resultado'] . "</h3>";
    echo "<h3>Peso (via GET): " . $_GET['peso'] . "</h3>";
    echo "<h3>Altura (via GET): " . $_GET['altura'] . "</h3>";
  }
  ?>
  <br><br>
  <a href="index.php">← Voltar ao Menu</a>
</body>

</html>