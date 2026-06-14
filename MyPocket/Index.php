<?php

session_start();

require_once 'classes/Carteira.php';

if (!isset($_SESSION['carteira'])) {
    $_SESSION['carteira'] = serialize(new Carteira());
}

$carteira = unserialize($_SESSION['carteira']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<title>MyPocket</title>

</head>
<body>

<div class="container mt-5">

<h1>MyPocket</h1>

<h3>
Saldo:
R$
<?= number_format(
    $carteira->getSaldo(),
    2,
    ',',
    '.'
) ?>
</h3>

<?php if(isset($_SESSION['mensagem'])): ?>

<div class="alert alert-success">
<?= $_SESSION['mensagem']; ?>
</div>

<?php unset($_SESSION['mensagem']); ?>

<?php endif; ?>

<?php if(isset($_SESSION['erro'])): ?>

<div class="alert alert-danger">
<?= $_SESSION['erro']; ?>
</div>

<?php unset($_SESSION['erro']); ?>

<?php endif; ?>

<form action="processa.php" method="POST">

<select
name="tipo"
class="form-select mb-2">

<option value="receita">
Receita
</option>

<option value="despesa">
Despesa
</option>

</select>

<input
type="number"
step="0.01"
name="valor"
class="form-control mb-2"
placeholder="Valor"
required>

<input
type="text"
name="descricao"
class="form-control mb-2"
placeholder="Descrição"
required>

<input
type="date"
name="data"
class="form-control mb-2"
required>

<button
class="btn btn-primary">
Cadastrar
</button>

</form>

<hr>

<h3>Extrato</h3>

<table class="table">

<tr>
<th>Data</th>
<th>Descrição</th>
<th>Tipo</th>
<th>Valor</th>
</tr>

<?php foreach($carteira->getTransacoes() as $t): ?>

<tr>

<td><?= $t->getData() ?></td>

<td><?= $t->getDescricao() ?></td>

<td>

<?php if($t->getTipo() === 'Entrada'): ?>

<span class="badge bg-success">
Entrada
</span>

<?php else: ?>

<span class="badge bg-danger">
Saída
</span>

<?php endif; ?>

</td>

<td>

R$
<?= number_format(
    $t->getValor(),
    2,
    ',',
    '.'
) ?>

</td>

</tr>

<?php endforeach; ?>

</table>

</div>

</body>
</html>