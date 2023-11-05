<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['banco']) && isset($_POST['numero']) && isset($_POST['limite'])){


        include 'dadosDeConexao.php';
        session_start();
        
        try{

            $conexao = new mysqli($URL, $USUARIO, $SENHA, $BD);

            if($conexao->connect_error){
                $erro = "Erro de conexão com um servidor";
                header("Location: registroCartao.php", urlencode($erro));
            }

            $banco = $_POST['banco'];
            $numero = $_POST['numero'];
            $limite = $_POST['limite'];
            $limite_disponivel = $_POST['limite'];
            $usuario_id = $_SESSION['usuario_id'];

            $comando = $conexao->prepare("INSERT INTO cartao (banco, numero, limite, limite_disponivel, usuario_id) VALUES (?,?,?,?,?)");

            $comando->bind_param("ssddi", $banco, $numero, $limite, $limite_disponivel, $usuario_id);

            if ($comando->execute()) {
                $conexao->commit();
                $sucesso = "Cartão registrado com sucesso.";
                header("Location: registroCartao.php?sucesso=" . urlencode($sucesso));

            } else {
                $erro = "Erro na hora de registrar os dados.";
                header("Location: registroCartao.php?sucesso=" . urlencode($erro));
            }

        }catch(Exception $ex){
            $erro = "A conexão com servidor falhou.". $ex->getMessage();
            header("Location: registroCartao.php?erro=" . urlencode($erro));
        } finally {
            $conexao->close();
            $comando->close();
        }
    }
}

?>