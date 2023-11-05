<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    include 'dadosDeConexao.php';
    session_start();

try{
    $conexao = new mysqli($URL, $USUARIO, $SENHA, $BD);
    
    if ($conexao->connect_error) {
        $erro = "Erro de conexão com o servidor.";
        header("Location: listagemPesquisaConta.php?erro=" . urlencode($erro));
    }  

    $comando = $conexao->prepare("SELECT id, banco, numero, saldo FROM conta 
        WHERE usuario_id = ? ");

    $id = $_SESSION['usuario_id'];    
  
    $comando->bind_param("i", $id);
    
    $comando->execute();
    if($resultado = $comando->get_result()){

        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['banco'] . "</td>";
            echo "<td>" . $row['numero'] . "</td>";
            echo "<td>" . $row['saldo'] . "</td>";
            echo "</tr>";
        }

    } else {
        $erro = "Não possui conta cadastrada.";
        header("Location: listagemPesquisaConta.php?erro=" . urlencode($erro));
    }

    
}catch(Exception $e){
    $erro = "Erro de Conexão.";
    header("Location: listagemPesquisaConta.php?erro=" . urlencode($erro));
}finally{
    $conexao->close();
    $comando->close();
}

}

