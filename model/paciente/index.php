<?php
session_start();
include __DIR__ . '/../../components/header.php';
include __DIR__ . '/../../config/database.php';

$usuario_id = $_SESSION['usu_id'];
$query = "
    SELECT cid.cid_nome, cid.cid_dt_nascimento, cid.cid_sexo, cid.cid_email, cid.cid_celular 
    FROM cidadao cid 
    JOIN usuario usu ON cid.cid_id = usu.cidadao_cid_id 
    WHERE usu.usu_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$usuario_id]);
$cidadao = $stmt->fetch();
$sexoFormatado = $cidadao['cid_sexo'] === 'M' ? 'Masculino' : 'Feminino';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <!-- Navegação por abas -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="dados-pessoais-tab" data-bs-toggle="tab" href="#dados-pessoais" role="tab">Dados Pessoais</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="convenios-tab" data-bs-toggle="tab" href="#convenios" role="tab">Convênios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="endereco-tab" data-bs-toggle="tab" href="#endereco" role="tab">Endereço</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="informacoes-tab" data-bs-toggle="tab" href="#informacoes" role="tab">Informações Adicionais</a>
        </li>
    </ul>

    <form action="processar_cadastro.php" method="post">
        <div class="tab-content mt-3">
            <!-- Aba Dados Pessoais -->
            <div class="tab-pane fade show active" id="dados-pessoais" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nome" value="<?php echo htmlspecialchars($cidadao['cid_nome']); ?>" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label>Data de Nascimento</label>
                            <input type="date" class="form-control" name="dt_nascimento" value="<?php echo htmlspecialchars($cidadao['cid_dt_nascimento']); ?>" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label>Sexo</label>
                            <input type="text" class="form-control" name="sexo" value="<?php echo htmlspecialchars($sexoFormatado); ?>" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($cidadao['cid_email']); ?>" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label>Celular</label>
                            <input type="text" class="form-control" name="celular" value="<?php echo htmlspecialchars($cidadao['cid_celular']); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aba Convênios -->
            <div class="tab-pane fade" id="convenios" role="tabpanel">
                <p>Seção de Convênios - Adicione conteúdo conforme necessário.</p>
            </div>

            <!-- Aba Endereço -->
            <div class="tab-pane fade" id="endereco" role="tabpanel">
                <p>Seção de Endereço - Adicione conteúdo conforme necessário.</p>
            </div>

            <!-- Aba Informações Adicionais -->
            <div class="tab-pane fade" id="informacoes" role="tabpanel">
                <p>Seção de Informações Adicionais - Adicione conteúdo conforme necessário.</p>
            </div>
        </div>

        <!-- Botões de ação -->
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="reset" class="btn btn-secondary">Limpar</button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../../components/footer.php'; ?>

<!-- Scripts do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
