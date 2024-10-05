<?php
include '../config/database.php';

// Verifica se a conexão foi estabelecida
if (!$conn) {
    die("Erro na conexão com o banco de dados.");
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do formulário
    $nome = $_POST['nome'];
    $cep = $_POST['cep'];
    $bairro = $_POST['bairro'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $telefone = $_POST['telefone'];

    // Insere a clínica no banco de dados
    $stmt = $conn->prepare("INSERT INTO clinicas (nome, cep, bairro, estado, cidade, telefone) VALUES (:nome, :cep, :bairro, :estado, :cidade, :telefone)");
    $stmt->execute([
        ':nome' => $nome,
        ':cep' => $cep,
        ':bairro' => $bairro,
        ':estado' => $estado,
        ':cidade' => $cidade,
        ':telefone' => $telefone,
    ]);
}

$conn = null; // Fecha a conexão
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inserir Clínicas</title>
</head>
<body class="container mt-5">

    <h2 class="text-center">Inserir Clínicas Atuantes</h2>
    
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id ?? ''); ?>"> <!-- Campo oculto para o ID -->
        
        <div class="bg-white rounded p-4 shadow-sm mb-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Clínica" required>
                </div>
                <div class="col-md-6">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" required>
                </div>
                <div class="col-md-6">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" required>
                </div>
                <div class="col-md-6">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
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
