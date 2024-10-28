<?php
include __DIR__ . '/../../config/database.php';

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do formulário
    $nome = $_POST['nome'];
    $ans = $_POST['ans'];
    $cnpj = $_POST['cnpj'];
    $situacao = $_POST['situacao'];
    $telefone = $_POST['telefone'];

    // Insere o plano no banco de dados
    $stmt = $conn->prepare("INSERT INTO planos (nome, ans, cnpj, situacao, telefone) VALUES (:nome, :ans, :cnpj, :situacao, :telefone)");
    $stmt->execute([
        ':nome' => $nome,
        ':ans' => $ans,
        ':cnpj' => $cnpj,
        ':situacao' => $situacao,
        ':telefone' => $telefone,
    ]);

    // Redirecionar ou mostrar mensagem de sucesso
    header('Location: index.php');
    exit();
}

$conn = null; // Fecha a conexão
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Planos de Saúde Associados</title>
</head>
<body class="container mt-5">

    <h2 class="text-center">Inserir Planos</h2>
    
    <form method="post" action="">
        <div class="bg-white rounded p-4 shadow-sm mb-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Plano" required>
                </div>
                <div class="col-md-6">
                    <label for="ans" class="form-label">N° ANS</label>
                    <input type="text" class="form-control" id="ans" name="ans" placeholder="N° ANS" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cnpj" class="form-label">CNPJ</label>
                    <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" required>
                </div>
                <div class="col-md-6">
                    <label for="situacao" class="form-label">Situação</label>
                    <input type="text" class="form-control" id="situacao" name="situacao" placeholder="Situação" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(DD) + Número" required>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-start">
            <button type="submit" class="btn btn-secondary me-2">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
