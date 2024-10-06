<?php
// Incluindo o arquivo de conexão ao banco de dados
include '../config/database.php';

// Verifica se a conexão foi estabelecida
if (!$conn) {
    die("Erro na conexão com o banco de dados.");
}

// Busca todas as especialidades
$stmt = $conn->query("SELECT * FROM especialidade");
$especialidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Selecionar Especialidade</title>
</head>
<body class="container mt-5">

    <h2 class="text-center">Selecionar Especialidade</h2>
    
    <form method="post" action="seu_script_de_processamento.php">
        <div class="mb-3">
            <label for="especialidade" class="form-label">Escolha uma Especialidade</label>
            <select class="form-select" id="especialidade" name="especialidade" required>
                <option value="">Selecione uma especialidade</option>
                <?php foreach ($especialidades as $especialidade): ?>
                    <option value="<?php echo htmlspecialchars($especialidade['id'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?php echo htmlspecialchars($especialidade['esp_nome'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-secondary">Salvar</button> <!-- Botão cinza -->
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
