<?php
session_start(); // Iniciei a sessão para acessar as variáveis de sessão

// Verifiquei se o usuário está logado
if (isset($_SESSION['usu_id'])) {
    // Destruui todas as variáveis de sessão
    $_SESSION = array();

    // Destrui a sessão
    session_destroy();

    // Redirecionei o usuário para a página inicial ou de login
    header('Location: /');
    exit(); // Termine o script após o redirecionamento
} else {
    // Se não estiver logado, redirecionei para a página de login 
    header('Location: /');
    exit();
}
?>
