<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usu_id'])) {
    // Redireciona para a página de login se o ID do usuário não estiver na sessão
    header('Location: /');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php 
    include __DIR__ . '/../../components/header.php'; 
?>
<body class="overflow-hidden">
    <div class="container d-flex justify-content-center align-items-center flex-column mt-5  w-25">
        <div class="container">
            <form class="row g-3" method="POST" action="/controller/login/controller-alterar-senha.php">
                <!-- Senha e Confirmação -->
                <div class="col-md-12">
                    <label for="senha" class="form-label">Digite uma nova senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="col-md-12">
                    <label for="confirma-senha" class="form-label">Confirme sua nova senha</label>
                    <input type="password" class="form-control" id="confirma-senha" name="confirma-senha" required>
                </div>

                <!-- Botão de Gravar Alteração da Senha -->
                <div class="col-12">
                    <button type="submit" class="btn btn-secondary w-100">Alterar</button>
                </div>
            </form>
        </div>    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php
    include __DIR__ . '/../../components/footer.php'
?>
</html>
