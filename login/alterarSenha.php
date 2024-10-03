<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 w-100" style="background-color: #f8f9fa;">
    <div class="container mt-5">
        <h2 class="text-center">Redefinir Senha</h2>
        <form class="row g-3">
            <!-- Senha e Confirmação -->
            <div class="col-md-12">
                <label for="senha" class="form-label">digite uma nova senha</label>
                <input type="password" class="form-control" id="senha" required>
            </div>
            <div class="col-md-12">
                <label for="confirma-senha" class="form-label">Confirme sua nova senha</label>
                <input type="password" class="form-control" id="confirma-senha" required>
            </div>

            <!-- Botão de Gravar Alteração da Senha -->
            <div class="col-12">
                <button type="submit" class="btn btn-secondary w-100">Alterar</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
