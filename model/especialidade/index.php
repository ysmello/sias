<?php
session_start();
include __DIR__ . '/../../components/header.php';
include __DIR__ . '/../../config/database.php'; // Conexão ao banco de dados

// Consulta para obter registros da tabela `convenios`
$query = "SELECT esp_id, esp_nome, esp_descr, esp_situacao FROM especialidade";
$stmt = $conn->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Especialidades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="overflow-hidden">
<?php if (isset($_GET['sucesso']) || isset($_GET['erro'])): ?>
        <!-- Botão que aciona o modal -->
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#mensagensModal" style="display: none;"></button>

        <!-- Modal de Mensagens -->
        <div class="modal fade" id="mensagensModal" tabindex="-1" aria-labelledby="mensagensModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header <?php echo (isset($_GET['sucesso'])) ? 'bg-success text-white' : 'bg-danger text-white'; ?> text-center border-bottom <?php echo (isset($_GET['sucesso'])) ? 'border-success' : 'border-danger'; ?> w-100">
                        <?php if (isset($_GET['sucesso'])): ?>
                            <?php if ($_GET['sucesso'] == 1): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ESPECIALIDADE INSERIDA COM SUCESSO!</h5>
                            <?php elseif ($_GET['sucesso'] == 2): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ESPECIALIDADE ALTERADA COM SUCESSO!</h5>
                            <?php elseif ($_GET['sucesso'] == 3): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ESPECIALIDADE EXCLUÍDA COM SUCESSO!</h5>
                            <?php endif; ?>
                        <?php elseif (isset($_GET['erro'])): ?>
                            <?php if ($_GET['erro'] == 1): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ERRO AO TENTAR INSERIR ESPECIALIDADE!</h5>
                            <?php elseif ($_GET['erro'] == 2): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ERRO AO TENTAR ALTERAR ESPECIALIDADE!</h5>
                            <?php elseif ($_GET['erro'] == 3): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ERRO AO TENTAR EXCLUIR ESPECIALIDADE!</h5>
                            <?php endif; ?>
                        <?php endif; ?>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="window.location='index.php';"></button>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>    
    <div class="container my-5">
        <!-- Conjunto de Botões -->
        <div class="d-flex mb-3">
            <button id="btnInserir" class="btn btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#modalFormulario">Inserir</button>
            <button id="btnAlterar" class="btn btn-warning me-2" disabled data-bs-toggle="modal" data-bs-target="#modalFormulario">Alterar</button>
            <button id="btnExcluir" class="btn btn-danger me-2" disabled data-bs-toggle="modal" data-bs-target="#modalExcluir">Excluir</button>
            <button id="btnVisualizar" class="btn btn-info" disabled data-bs-toggle="modal" data-bs-target="#modalFormulario">Visualizar</button>
        </div>

        <!-- Tabela de Registros -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col"><input type="checkbox" id="selectAll"></th>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Situação</th>
                </tr>
            </thead>
            <tbody id="tabelaRegistros">
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><input type="checkbox" class="checkboxRegistro" value="<?= $row['esp_id'] ?>"></td>
                        <td><?= $row['esp_id'] ?></td>
                        <td><?= $row['esp_nome'] ?></td>
                        <td><?= $row['esp_descr'] ?></td>
                        <td><?php 
                            switch ($row['esp_situacao']) {
                                case 1:
                                    echo 'Ativo';
                                    break;
                                case 0:
                                    echo 'Inativo';
                                    break;
                                default:
                                    echo 'Desconhecido';
                            }
                        ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para Formulário -->
    <div class="modal fade" id="modalFormulario" tabindex="-1" aria-labelledby="modalFormularioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormularioLabel">Formulário Especialidade</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formulario" method="POST">
                        <input type="hidden" name="registroId" id="registroId">
                        <div class="mb-3">
                            <label for="esp_nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="esp_nome" name="esp_nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="esp_descr" class="form-label">Descrição</label>
                            <textarea class="form-control" id="esp_descr" name="esp_descr" rows="10" maxlength="255"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="esp_situacao" class="form-label">Situação</label>
                            <select class="form-control" id="esp_situacao" name="esp_situacao" required>
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" id="btnSalvar">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para confirmação de exclusão -->
    <div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="modalExcluirLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExcluirLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente excluir os registros selecionados?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnConfirmarExcluir">Excluir</button>
                </div>
            </div>
        </div>
    </div>    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const checkboxes = document.querySelectorAll('.checkboxRegistro');
    const btnAlterar = document.getElementById('btnAlterar');
    const btnExcluir = document.getElementById('btnExcluir');
    const btnVisualizar = document.getElementById('btnVisualizar');
    const form = document.getElementById('formulario');
    const btnSalvar = document.getElementById('btnSalvar');    

    // Configuração de estado dos botões
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const selecionados = document.querySelectorAll('.checkboxRegistro:checked');
            if (selecionados.length === 1) {
                btnAlterar.disabled = false;
                btnVisualizar.disabled = false;
                btnExcluir.disabled = false;
            } else if (selecionados.length > 1) {
                btnAlterar.disabled = true;
                btnVisualizar.disabled = true;
                btnExcluir.disabled = false;
            } else {
                btnAlterar.disabled = true;
                btnVisualizar.disabled = true;
                btnExcluir.disabled = true;
            }
        });
    });


    // Inserção de Especialidade
    document.getElementById('btnInserir').addEventListener('click', () => {
        form.reset();
        document.getElementById('modalFormularioLabel').textContent = 'Inserir Especialidade';
        form.action = '/controller/especialidade/controller-inserir-especialidade.php';
        enableFields(true);
        btnSalvar.disabled = false;
    });

    // Alteração de Especialidade
    document.getElementById('btnAlterar').addEventListener('click', () => {
        const selecionado = document.querySelector('.checkboxRegistro:checked').value;
        fetchDataAndFillForm(selecionado);
        document.getElementById('modalFormularioLabel').textContent = 'Alterar Especialidade';
        form.action = `/controller/especialidade/controller-alterar-especialidade.php?id=${selecionado}`;
        enableFields(true);
        btnSalvar.disabled = false;
    });


    // Visualização de Especialidade
    document.getElementById('btnVisualizar').addEventListener('click', () => {
        const selecionado = document.querySelector('.checkboxRegistro:checked').value;
        fetchDataAndFillForm(selecionado);
        document.getElementById('modalFormularioLabel').textContent = 'Visualizar Especialidade';
        form.action = '#'; 
        enableFields(false);
        btnSalvar.disabled = true; 
    });

    // Função para habilitar ou desabilitar os campos
    function enableFields(isEnabled) {
        document.getElementById('esp_nome').disabled = !isEnabled;
        document.getElementById('esp_descr').disabled = !isEnabled;
        document.getElementById('esp_situacao').disabled = !isEnabled;
    }

    // Função para buscar dados e preencher o formulário
    function fetchDataAndFillForm(id) {
        fetch(`/controller/especialidade/controller-visualizar-especialidade.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('registroId').value = data.esp_id;
                document.getElementById('esp_nome').value = data.esp_nome;
                document.getElementById('esp_descr').value = data.esp_descr;
                document.getElementById('esp_situacao').value = data.esp_situacao; 
            });
    }

    // Exclusão de Convênio
    document.getElementById('btnExcluir').addEventListener('click', () => {
        const idsParaExcluir = Array.from(document.querySelectorAll('.checkboxRegistro:checked')).map(cb => cb.value);
        
        // Mostrar modal de confirmação
        const modalExcluir = new bootstrap.Modal(document.getElementById('modalExcluir'));
        modalExcluir.show();

        // Aguardar a confirmação do usuário para excluir
        document.getElementById('btnConfirmarExcluir').onclick = () => {
            window.location.href = `/controller/especialidade/controller-excluir-especialidade.php?ids=${idsParaExcluir.join(',')}`;
        };
    });
    
    // Acionamento automático da mensagem
    document.querySelector('button[data-bs-target="#mensagensModal"]').click();
    
    // Redirecionamento de página caso o usuário não feche a mensagem pelo botão "Fechar"
    var mensagensModal = document.getElementById('mensagensModal');
    mensagensModal.addEventListener('hidden.bs.modal', function (event) {
        window.location = 'index.php';
    });
    document.querySelector('button[data-bs-target="#mensagensModal"]').click();              

    </script>
</body>

<?php include __DIR__ . '/../../components/footer.php'; ?>
</html>
