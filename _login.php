<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'dadosDeConexao.php';

try{
    $conexao = new mysqli($URL, $USUARIO, $SENHA, $BD);
    if ($conexao->connect_error) {
        echo "Erro de conexão: " . $conexao->connect_error;
    }

    $email = $_POST["email"];
    $senha = $_POST["senha"];  

    $comando = $conexao->prepare("SELECT id, nome, sobrenome, email, senha FROM usuario 
        WHERE email = ? AND senha = ?");
  
    $comando->bind_param("ss", $email, $senha);
    
    $comando->execute();
    $resultado = $comando->get_result();

        if ($resultado->num_rows > 0) {
            session_start();
            $_SESSION['logado'] = true;
            $linha = $resultado->fetch_assoc();
            $nome = $linha['nome'];
            $_SESSION['nome'] = $nome;
            $comando->close();
            $conexao->close();

            
            header("Location: principal.php");
        } else {
            // echo '<script>alert("email ou senha incorretos");</script>';
            // echo '<script>window.location.href = "login.php";</script>';
            $erro = "Nome de usuário ou senha incorretos.";
            header("Location: login.php?erro=" . urlencode($erro));
        }
        $comando->close();


    
}catch(Exception $e){
    $erro = "Erro de Conexão.";
    header("Location: login.php?erro=" . urlencode($erro));
}finally{
    $conexao->close();
}

}

?>
