<?php
include '../config/database.php';

// Verificar se a requisição para deletar foi feita
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // Verificar se o exame está em uso em outras tabelas
        $checkSql = "SELECT COUNT(*) as total FROM agenda WHERE especialidade_has_profissional_profissional_prof_id = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['total'] > 0) {
            echo "Não é possível excluir este Exame/Procedimento, pois ele está em uso.";
        } else {
            // Se não estiver em uso, exclua o exame
            $deleteSql = "DELETE FROM exames_procedimentos WHERE id = ?";
            $stmt = $conn->prepare($deleteSql);
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                echo "Exame/Procedimento excluído com sucesso.";
            } else {
                echo "Erro ao excluir exame: Nenhum registro foi afetado.";
            }
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

    // Encerrar o script para evitar que o HTML seja processado
    exit;
}

// Preparar a consulta para listar os exames
try {
    $sql = "SELECT id, protocolo, nome, nans, 
                CASE 
                    WHEN status = 1 THEN 'Ativo' 
                    WHEN status = 0 THEN 'Inativo' 
                    ELSE 'Desconhecido' 
                END as status
            FROM exames_procedimentos";
    
    // Executar a consulta
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Armazena o resultado
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
    $result = []; // Garantir que result esteja definido mesmo em caso de erro
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro de Exames e Procedimentos</title>
</head>
<body class="container mt-5">

    <h2 class="text-center">Cadastro de Exames e Procedimentos</h2>
    
    <div class="bg-white rounded p-4 shadow-sm mb-4">
        <div class="d-flex justify-content-start mb-3">
            <button onclick="window.location.href='inserir.php'" class="btn btn-secondary me-2">Inserir</button>
            <button id="alterBtn" class="btn btn-secondary me-2" disabled>Alterar</button>
            <button id="deleteBtn" class="btn btn-secondary" disabled>Excluir</button>
        </div>
        <table class="table table-bordered mx-auto text-center" id="examTable">
            <thead class="table-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Protocolo</th>
                    <th scope="col">Nome</th>
                    <th scope="col">N° ANS</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($result) > 0): ?>
                    <?php foreach ($result as $row): ?>
                    <tr data-id="<?php echo htmlspecialchars($row['id']); ?>">
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['protocolo']); ?></td>
                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td><?php echo htmlspecialchars($row['nans']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum dado encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let selectedRow;

            // Selecionar linha da tabela
            $('#examTable tbody tr').on('click', function() {
                // Remover seleção de outras linhas
                $('#examTable tbody tr').removeClass('table-primary');
                $(this).addClass('table-primary');

                // Armazenar a linha selecionada e habilitar botões
                selectedRow = $(this);
                $('#alterBtn').prop('disabled', false);
                $('#deleteBtn').prop('disabled', false);
            });

            // Redirecionar para alterar.php ao clicar no botão de alterar
            $('#alterBtn').on('click', function() {
                const id = selectedRow.data('id');
                window.location.href = 'editar.php?id=' + id; // Redireciona para a página de alteração
            });

            // Confirmar e excluir
            $('#deleteBtn').on('click', function() {
                const id = selectedRow.data('id');
                const confirmDelete = confirm("Tem certeza que deseja excluir este exame?");
                if (confirmDelete) {
                    $.post('', { id: id }, function(response) {
                        // Remove a tag HTML da resposta
                        alert(response.trim()); // Mostra a mensagem de retorno do PHP
                        if (response.includes("Exame/Procedimento excluído com sucesso")) {
                            selectedRow.remove(); // Remove a linha da tabela
                            $('#alterBtn').prop('disabled', true); // Desabilita o botão de alterar
                            $('#deleteBtn').prop('disabled', true); // Desabilita o botão de excluir
                        }
                    }).fail(function() {
                        alert("Ocorreu um erro ao tentar excluir o exame.");
                    });
                }
            });
        });
    </script>
</body>
</html>

<?php
$conn = null; // Fecha a conexão
?>
