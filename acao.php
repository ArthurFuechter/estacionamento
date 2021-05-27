<?php

    include_once "conf/default.inc.php";
    include_once "fdata.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        excluir($id);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        if ($id == 0)
            inserir($id);
        else
            editar($id);
    }

    // Métodos para cada operação
    function inserir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO carro (placa, modeloCar, marcaCar, hrsCompradas, hrsEntrada, dinheiro) VALUES(:placa, :modeloCar, :marcaCar, :hrsCompradas, :hrsEntrada, :dinheiro)');
        $stmt->bindParam(':placa', $placa, PDO::PARAM_STR);
        $stmt->bindParam(':modeloCar', $modeloCar, PDO::PARAM_STR);
        $stmt->bindParam(':marcaCar', $marcaCar, PDO::PARAM_STR);
        $stmt->bindParam(':hrsCompradas', $hrsCompradas, PDO::PARAM_STR);
        $stmt->bindParam(':hrsEntrada', $hrsEntrada, PDO::PARAM_STR);
        $stmt->bindParam(':dinheiro', $dinheiro, PDO::PARAM_STR);

        $placa = $_POST['placa'];
        $modeloCar = $_POST['modeloCar'];
        $marcaCar = $_POST['marcaCar'];
        $hrsCompradas = $_POST['hrsCompradas'];
        $hrsEntrada = date('Y-m-d H:i:s', strtotime($_POST['hrsEntrada']));
        $dinheiro = $_POST['dinheiro'];

        $stmt->execute();

        header("location:cad.php"); 
    }

    //UPDATE `estacionamento`.`carro` SET `modeloCar` = 'chevette', `dinheiro` = '100' WHERE (`id` = '3');

    function editar($id){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE carro SET placa = :placa, modeloCar = :modeloCar, marcaCar = :marcaCar, hrsCompradas = :hrsCompradas, hrsEntrada = :hrsEntrada, dinheiro = :dinheiro WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':placa', $placa, PDO::PARAM_STR);
        $stmt->bindParam(':modeloCar', $modeloCar, PDO::PARAM_STR);
        $stmt->bindParam(':marcaCar', $marcaCar, PDO::PARAM_STR);
        $stmt->bindParam(':hrsCompradas', $hrsCompradas, PDO::PARAM_STR);
        $stmt->bindParam(':hrsEntrada', $hrsEntrada, PDO::PARAM_STR);
        $stmt->bindParam(':dinheiro', $dinheiro, PDO::PARAM_STR);
        
        $id= $_POST['id'];
        $placa = $_POST['placa'];
        $modeloCar= $_POST['modeloCar'];
        $marcaCar = $_POST['marcaCar'];
        $hrsCompradas = $_POST['hrsCompradas'];
        $hrsEntrada = $_POST['hrsEntrada'];
        $dinheiro = $_POST['dinheiro'];

        $stmt->execute();
        header("location:index.php");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from carro WHERE id = :id');
        $stmt->bindParam(':id', $idD, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();
        header("location:index.php");
    }


    // Busca um item pelo código no BD
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM carro WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['placa'] = $linha['placa'];
            $dados['modeloCar'] = $linha['modeloCar'];
            $dados['marcaCar'] = $linha['marcaCar'];
            $dados['hrsCompradas'] = $linha['hrsCompradas'];
            $dados['hrsEntrada'] = $linha['hrsEntrada'];
            $dados['dinheiro'] = $linha['dinheiro'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['placa'] = $_POST['placa'];
        $dados['modeloCar'] = $_POST['modeloCar'];
        $dados['marcaCar'] = $_POST['marcaCar'];
        $dados['hrsCompradas'] = $_POST['hrsCompradas'];
        $dados['hrsEntrada'] = $_POST['hrsEntrada'];
        $dados['dinheiro'] = $_POST['dinheiro'];
        return $dados;
    }
?>