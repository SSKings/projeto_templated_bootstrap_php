<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

include 'dadosDeConexao.php';

try {
    $conexao = new mysqli($URL, $USUARIO, $SENHA, $BD);

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
        $sucesso = "Usuário cadastrado com sucesso.";
        header("Location: cadastro.php?sucesso=" . urlencode($sucesso));
    } else {
        echo 'Erro ao inserir dados no banco de dados: ' . $comando->error;
    }
} catch (Exception $e) {
    $erro = "A conexão com servidor falhou.";
    header("Location: cadastro.php?erro=" . urlencode($erro));
} finally {
    $conexao->close();
    $comando->close();
}

}
?>
