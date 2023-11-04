<?php

include 'dadosDeConexao.php';

try {
    $conexao = new mysqli($URL, $USUARIO, $SENHA, $BD);
    $conexao->autocommit(false);

    if ($conexao->connect_error) {
        echo 'Erro na conexão com o banco de dados: ' . $conexao->connect_error;
    }

    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $comando = $conexao->prepare("INSERT INTO usuario (nome, sobrenome, email, senha) VALUES (?,?,?,?)");
    $comando->bind_param("ssss", $nome, $sobrenome, $email, $senha);

    if ($comando->execute()) {
        $conexao->commit();
        echo '<script>alert("Usuário Cadastrado com sucesso.");</script>';
        echo '<script>window.location.href = "login.php";</script>';
    } else {
        echo 'Erro ao inserir dados no banco de dados: ' . $comando->error;
    }
} catch (Exception $e) {
    $conexao->rollback();
    echo 'Erro ao cadastrar um usuário: ' . $e->getMessage();
} finally {
    $conexao->close();
    $comando->close();
}
?>
