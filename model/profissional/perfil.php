<?php
    include __DIR__ . '../../../config/database.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white; /* Fundo branco */
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../../components/header.php' ?>

    <?php
        require "../../config/database.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data_inicio = $_POST['data_inicio'];
            $data_fim = $_POST['data_fim'];
            $hora_inicio = $_POST['hora_inicio'];
            $hora_fim = $_POST['hora_fim'];
            $intervalo = $_POST['intervalo'];
            $prof_id = 4;
    
            // Consulta SQL para inserir os dados na tabela profissional_disponibilidade
            $sql = "INSERT INTO profissional_disponibilidade (prof_id, data_inicio, data_fim, hora_inicio, hora_fim, intervalo) 
                    VALUES (:prof_id, :data_inicio, :data_fim, :hora_inicio, :hora_fim, :intervalo)";
    
            // Preparar a declaração
            $stmt = $conn->prepare($sql);
            
            // Vincular os parâmetros
            $stmt->bindParam(':prof_id', $prof_id, PDO::PARAM_INT);
            $stmt->bindParam(':data_inicio', $data_inicio);
            $stmt->bindParam(':data_fim', $data_fim);
            $stmt->bindParam(':hora_inicio', $hora_inicio);
            $stmt->bindParam(':hora_fim', $hora_fim);
            $stmt->bindParam(':intervalo', $intervalo, PDO::PARAM_INT);
    
            // Executar a declaração
            if ($stmt->execute()) {
                echo "<h1>Dados inseridos com sucesso!</h1>";
            } else {
                echo "Erro ao inserir os dados.";
            }
        } else {
            echo "Método de requisição inválido.";
        }
    ?>
    
    <div class="container mt-5">
        <h1 class="text-center">Cadastro de Atendimento Médico</h1>
        <form method="POST">
            <div class="form-group">
                <label for="data_inicio">Data de Início:</label>
                <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
            </div>

            <div class="form-group">
                <label for="data_fim">Data Final:</label>
                <input type="date" class="form-control" id="data_fim" name="data_fim" required>
            </div>

            <div class="form-group">
                <label for="hora_inicio">Hora de Início:</label>
                <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
            </div>

            <div class="form-group">
                <label for="hora_fim">Hora de Fim:</label>
                <input type="time" class="form-control" id="hora_fim" name="hora_fim" required>
            </div>

            <div class="form-group">
                <label for="intervalo">Intervalo de Atendimento (em minutos):</label>
                <input type="number" class="form-control" id="intervalo" name="intervalo" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
