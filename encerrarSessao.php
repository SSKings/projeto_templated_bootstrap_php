<?php

include 'VerificarAcesso.php';

session_start();
session_unset();
session_destroy();

$sucesso = "Sessão encerrada.";
header("Location: login.php", urlencode($sucesso));