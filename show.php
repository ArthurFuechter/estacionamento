<!DOCTYPE html>
<?php 
     include_once "conf/default.inc.php";
     include_once "fdata.php";
     require_once "conf/Conexao.php";
     $title = "Detalhe do Carro";
     $id = isset($_GET['id']) ? $_GET['id'] : "1";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="shortcut icon" href="img/favicon.png"/>
    <title> <?php echo $title; ?> </title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <a></a><a class="navbar-brand"><img src="img/favicon.png" width="30" height="30" class="d-inline-block align-top"> Estacionamento Schweder</a>
</nav>
<div class="container">
<br>
    <a href="index.php"><button  class="btn btn-outline-primary">Voltar</button></a>
    <a href="cad.php?acao=editar&id=<?php echo $id;?>"><button class="btn btn-primary">Alterar</button></a>
    <a href="cad.php"><button class="btn btn-outline-info">Novo</button></a>
    </br></br>
    <?php

        $sql = "SELECT * FROM carro WHERE id = $id";
    
        $pdo = Conexao::getInstance(); 
        $consulta = $pdo->query($sql);
        
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)){
            $dinheiro = $linha['dinheiro'];
            $hrsComp = $linha['hrsCompradas'];
            $hrsEnt = $linha['hrsEntrada'];
            $hrsSaida = date("d/m/Y H:i:s", strtotime('+'.$hrsComp.' Hour', strtotime($hrsEnt)));
            
            $valor = 15* $hrsComp;
    
            $troco = $dinheiro-$valor;

            echo "Código: {$linha['id']} <br>Placa: ". strtoupper($linha['placa'])." <br>Modelo: {$linha['modeloCar']} <br>Marca: {$linha['marcaCar']} <br>Horas Compradas: {$linha['hrsCompradas']} horas <br>Dia/Hora da Entrada: ".datatimeFormat($linha['hrsEntrada'])."<br>Dia/Hora da Saída: ".datatimeFormat($hrsSaida)."<br>Valor: R$".number_format($valor, 2, ',', '.')."<br>Dinheiro: R$".number_format($dinheiro, 2, ',', '.')."<br>Troco: R$". number_format($troco,2,',','.');
        }
    ?>
</div>
</body>
</html>