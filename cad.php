<!DOCTYPE html>
<?php
include_once "acao.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/favicon.png"/>
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Novo Carro</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <a></a><a class="navbar-brand"><img src="img/favicon.png" width="30" height="30" class="d-inline-block align-top"> Estacionamento Schweder</a>
</nav>
<div class="container">
    <br>
    <a href="index.php"><button class="btn btn-outline-secondary">Voltar</button></a>
    <a href="cad.php"><button class="btn btn-secondary">Novo</button></a>
    <br><br>
    <form action="acao.php" method="post">
    <div class="row">
        <div class="col">
            <label for="id">Id:</label><input class="form-control" readonly  type="text" name="id" id="id" value="<?php if ($acao == "editar") echo $dados['id']; else echo 0; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for="placa">Placa:</label> <input class="form-control" required=true type="text" name="placa" id="placa" placeholder="NNN-2222, MMM-3333..." value="<?php if ($acao == "editar") echo $dados['placa']; ?>">
        </div>
        <div class="col-6">
            <label for="modeloCar">Modelo do Carro:</label> <input class="form-control" required="true" type="text" name="modeloCar" id="modeloCar" placeholder="Fusca, Celta..." value="<?php if ($acao == "editar") echo $dados['modeloCar']; ?>">
        </div>
    <div>
    <div class="row">
        <div class="col">
            <label for="marcaCar">Marca do Carro:</label> <input class="form-control" type="text" name="marcaCar" id="marcaCar" placeholder="Voltswagen, Chevrollet..." value="<?php if ($acao == "editar") echo $dados['marcaCar']; ?>">
        </div>
    <div>
    <div class="row">
        <div class="col-6">
            <label for="placa">Horas Compradas:</label> <input class="form-control" required=true type="number" name="hrsCompradas" id="hrsCompradas" placeholder="1, 2, 3..." value="<?php if ($acao == "editar") echo $dados['hrsCompradas']; ?>">
        </div>
        <div class="col-6">
            <label for="hrsEntrada">Dia/Hora da Entrada:</label> <input class="form-control" required="true" type="datetime" name="hrsEntrada" id="hrsEntrada" placeholder="dd/mm/AAAA HH:mm:ss" value="<?php if ($acao == "editar") echo date('d/m/Y H:i:s', strtotime($dados['hrsEntrada'])); ?>">
        </div>
    <div>
    <div class="row">
        <div class="col">
            <label for="dinheiro">Dinheiro:</label> <input class="form-control" type="text" name="dinheiro" id="dinheiro" placeholder="R$00,00" value="<?php if ($acao == "editar") echo $dados['dinheiro']; ?>">
        </div>
    <div>
    <br>
    <button class="btn btn-success" type="submit" name="acao" id="acao" value="salvar">Salvar</button>
    
    </form>
    </body>
</div>
</html>