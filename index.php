<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    include_once "fdata.php";
    require_once "conf/Conexao.php";
    $title = "Estacionamento Schweder";

    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "1";
    $procurar = isset($_POST['procurar']) ? $_POST['procurar'] : "";
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link rel="manifest" href="manifest.webmanifest">
    <link rel="shortcut icon" href="img/favicon.png"/>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url; 
        }
    </script>
</head>
<body>
    <nav class="navbar navbar fixed-top navbar-light bg-light">
        <a></a><a class="navbar-brand"><img src="img/favicon.png" width="30" height="30" class="d-inline-block align-top"> Estacionamento Schweder</a>
    </nav>
    <br><br><br>
    <div class="container">
    <a href="cad.php"><button class="btn btn-outline-primary">Novo</button></a>
    <br><br>
    <form method="post">
        
        <label >Código</label> <input type="radio" name="tipo" id="tipo" value="1" <?php if ($tipo == 1) { echo "checked"; }?>> <br>  
        <label >Placa</label> <input type="radio" name="tipo" id="tipo" value="2" <?php if ($tipo == 2) { echo "checked"; }?>> <br>
        <div class="row">
            <div class="col-5"><input class="form-control" type="text" name="procurar" id="procurar" value="<?php echo $procurar; ?>"> </div>
            <div class="col"><input class="btn btn-primary" type="submit" value="Pesquisar"></div>
        </div>
         
    </form>
    
    <br>
    <table class="table table-striped">
       <tr><th>Código</th>
        <th>Placa</th>
        <th>Horário Entrada</th>
        <th>Horário Saída</th> 
        <th>Valor</th> 
        <th>Troco</th> 
        <th>Detalhes</th> 
        <th>Alterar</th> 
        <th>Excluir</th>
    </tr>

    <?php 
        $sql = "";
        if ($tipo == 1){
            if($procurar == ""){
                $sql = "SELECT * FROM carro ORDER BY id";    
            }else{
                $sql = "SELECT * FROM carro WHERE id = $procurar ORDER BY id";
            }
        }else{    
            $sql = "SELECT * FROM carro WHERE placa LIKE '$procurar%' ORDER BY placa";
        }

        $pdo = Conexao::getInstance();
        
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {   

        $dinheiro = $linha['dinheiro'];
        $hrsComp = $linha['hrsCompradas'];
        $hrsEnt = $linha['hrsEntrada'];
        $hrsSaida = date("d/m/Y H:i:s", strtotime('+'.$hrsComp.' Hour', strtotime($hrsEnt)));
        
        $valor = 15* $hrsComp;

        $troco = $dinheiro-$valor;
    ?>
        <tr><td><?php echo $linha['id'];?></td>
            <td><?php echo strtoupper($linha['placa']);?></td>
            <td><?php echo datatimeFormat($linha['hrsEntrada']);?></td>
            <td><?php echo datatimeFormat($hrsSaida);?></td>
            <td><?php echo "R$ ". number_format($valor, 2, ',', '.');?></td>
            <td><?php echo "R$ ". number_format($troco, 2, ',', '.');?></td>            
            <td align="center"><a href='show.php?id=<?php echo $linha['id'];?>'> <img  src="img/show.png" alt="ver mais"> </a></td>
            <td align="center"><a href='cad.php?acao=editar&id=<?php echo $linha['id'];?>'><img  src="img/edit.png" alt="editar"></a></td>
            <td align="center"><a href="javascript:excluirRegistro('acao.php?acao=excluir&id=<?php echo $linha['id'];?>')"><img  src="img/delete.png" alt="excluir"></a></td>
        </tr>
    <?php } ?>       
    </table>
    </div>
</body>
</html>
