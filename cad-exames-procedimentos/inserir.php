<?php
include 'conexao_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $protocolo = $_POST['protocolo'];
    $exame = $_POST['exame'];
    $nans = $_POST['nans'];
    $status = $_POST['status'];

    // Prepare e execute a consulta
    $stmt = $conn->prepare("INSERT INTO exames_procedimentos (protocolo, nome, nans, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $protocolo, $exame, $nans, $status);
    
    if ($stmt->execute()) {
        // Redireciona para a página index após sucesso
        header("Location: index.php");
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inserir Exames e Procedimentos</title>
</head>
<body class="container mt-5">

    <h2 class="text-center">Inserir Exames e Procedimentos</h2>
    
    <form method="post" action="">
        <div class="bg-white rounded p-4 shadow-sm mb-4">
            <div class="row mb-3">
                <div class="col">
                    <label for="exame" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="exame" name="exame" placeholder="Exame ou Procedimento" required>
                </div>
                <div class="col">
                    <label for="protocolo" class="form-label">Protocolo</label>
                    <input type="text" class="form-control" id="protocolo" name="protocolo" placeholder="N° do protocolo" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="nans" class="form-label">N° ANS</label>
                    <input type="text" class="form-control" id="nans" name="nans" placeholder="N° ANS" required>
                </div>
                <div class="col">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="status" name="status" placeholder="Status" required>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-secondary me-2">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close(); // Fecha a conexão
?>