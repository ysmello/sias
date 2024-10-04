<?php
include 'conexao_db.php'; 

$sql = "SELECT id, protocolo, nome, nans, status FROM exames_procedimentos";
$result = $conn->query($sql);
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
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr data-id="<?php echo $row['id']; ?>">
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['protocolo']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['nans']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum dado encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
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
                window.location.href = 'alterar.php?id=' + id; // Redireciona para a página de alteração
            });

            // Confirmar e excluir
            $('#deleteBtn').on('click', function() {
                const id = selectedRow.data('id');
                const confirmDelete = confirm("Tem certeza que deseja excluir este exame?");
                if (confirmDelete) {
                    $.post('excluir.php', { id: id }, function(response) {
                        alert(response); // Mostra a mensagem de retorno do PHP
                        if (response.includes("Exame excluído com sucesso")) {
                            selectedRow.remove(); // Remove a linha da tabela
                            $('#alterBtn').prop('disabled', true); // Desabilita o botão de alterar
                            $('#deleteBtn').prop('disabled', true); // Desabilita o botão de excluir
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>