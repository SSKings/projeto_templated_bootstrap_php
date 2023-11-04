<?php
    session_start();

    if(!isset($_SESSION['logado'])){
        echo ("<h2>Acesso Ao Sistema Não Permitido</h2>");
        echo ("É necessário informar usuário e senha válidos para ter acesso.<br><br>");
        echo ("Para entrar no sistema clique no botão abaixo:<br><br>");
        echo ("<input type=\"button\" value=\"Login\" onclick=\"location.href='login.php'\" />");
        die();
    }