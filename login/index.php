<?php
    include __DIR__ . '/../config/database.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100" style="background-color: #f8f9fa;">
    <div class="text-center w-50">
        <form action="processa_login.php" method="POST" class="bg-white p-4 rounded shadow w-100">
            <div class="mb-3 text-start"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                </svg>
                <label for="username" class="form-label"><b>E-mail</b></label>
                <input type="email" class="form-control form-control-lg w-100" id="username" name="username" required>
            </div>
            <div class="mb-3 text-start"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
                    <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1"/>
                </svg>                
                <label for="password" class="form-label"><b>Senha</b></label>
                <input type="password" class="form-control form-control-lg w-100" id="password" name="password" required>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-secondary" type="submit"><b>ENTRAR</b></button>
                <div class="d-flex ms-3">
                    <a href="#" onclick="carregarPagina(event, 'alterar-senha.php')" class="link-secondary me-3">Esqueci minha senha</a>
                    <a href="#" onclick="carregarPagina(event, 'registro.php')" class="link-secondary">Registre-se</a>
                </div>
            </div>
        </form>
    </div>
    <!-- Link da CDN do Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK"></script>
    <!-- Link para JS do projeto-->
    <script src="../js/carregarLogin.js"></script>
</body>
</html>
