<?php

include 'VerificarAcesso.php';

session_start();
session_unset();
session_destroy();

echo "<h2>Encerramento de Sessão de Sistema</h2>";

echo ("Encerramento de Sessão realizado com sucesso.<br><br>");

echo ("Para entrar no sistema novamente clique no botão abaixo:<br><br>");
echo ("<input type=\"button\" value=\"Acesso\" onclick=\"location.href='login.php'\" />");