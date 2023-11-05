<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['banco']) && isset($_POST['numero']) && isset($_POST['saldo'])){


        include 'dadosDeConexao.php';
        session_start();
        
        try{

            $conexao = new mysqli($URL, $USUARIO, $SENHA, $BD);

            if($conexao->connect_error){
                $erro = "Erro de conexão com um servidor";
                header("Location: registroConta.php", urlencode($erro));
            }

            $banco = $_POST['banco'];
            $numero = $_POST['numero'];
            $limite = $_POST['saldo'];
            $usuario_id = $_SESSION['usuario_id'];

            $comando = $conexao->prepare("INSERT INTO conta (banco, numero, saldo, usuario_id) VALUES (?,?,?,?)");

            $comando->bind_param("ssdi", $banco, $numero, $limite, $usuario_id);

            if ($comando->execute()) {
                $conexao->commit();
                $sucesso = "Conta registrada com sucesso.";
                header("Location: registroConta.php?sucesso=" . urlencode($sucesso));

            } else {
                $erro = "Erro na hora de registrar os dados.";
                header("Location: registroConta.php?sucesso=" . urlencode($erro));
            }

        }catch(Exception $ex){
            $erro = "A conexão com servidor falhou.". $ex->getMessage();
            header("Location: registroConta.php?erro=" . urlencode($erro));
        } finally {
            $conexao->close();
            $comando->close();
        }
    }
}

?>