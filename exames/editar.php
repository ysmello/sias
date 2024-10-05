<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $id = $_POST['id']; // O ID do registro a ser alterado
    $protocolo = $_POST['protocolo'];
    $exame = $_POST['exame'];
    $nans = $_POST['nans'];
    $status = $_POST['status'];

    // Prepare e execute a consulta de atualização
    try {
        $stmt = $conn->prepare("UPDATE exames_procedimentos SET protocolo = ?, nome = ?, nans = ?, status = ? WHERE id = ?");
        $stmt->execute([$protocolo, $exame, $nans, $status, $id]);
        
        // Redireciona para a página index após sucesso
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

// Se o ID for passado, buscar os dados do exame
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT protocolo, nome, nans, status FROM exames_procedimentos WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $protocolo = $row['protocolo'];
        $exame = $row['nome'];
        $nans = $row['nans'];
        $status = $row['status'];
    } else {
        // Redireciona se não encontrar o registro
        header("Location: index.php");
        exit();
    }
} else {
    // Redireciona se não houver ID
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Alterar Exames e Procedimentos</title>
</head>
<body class="container mt-5">

    <h2 class="text-center">Alterar Exames e Procedimentos</h2>
    
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"> <!-- Campo oculto para o ID -->
        <div class="bg-white rounded p-4 shadow-sm mb-4">
            <div class="row mb-3">
                <div class="col">
                    <label for="exame" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="exame" name="exame" placeholder="Exame ou Procedimento" value="<?php echo htmlspecialchars($exame); ?>" required>
                </div>
                <div class="col">
                    <label for="protocolo" class="form-label">Protocolo</label>
                    <input type="text" class="form-control" id="protocolo" name="protocolo" placeholder="N° do protocolo" value="<?php echo htmlspecialchars($protocolo); ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="nans" class="form-label">N° ANS</label>
                    <input type="text" class="form-control" id="nans" name="nans" placeholder="N° ANS" value="<?php echo htmlspecialchars($nans); ?>" required>
                </div>
                <div class="col">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" class="form-select" name="status" required>
                        <option value="1" <?php echo $status == 1 ? 'selected' : ''; ?>>Ativo</option>
                        <option value="0" <?php echo $status == 0 ? 'selected' : ''; ?>>Inativo</option>
                    </select>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-secondary me-2">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn = null; // Fecha a conexão
?>
