<?php
    include __DIR__ . '/../../config/database.php';

// Consulta para obter especialidades
/*
$query = "SELECT esp_id, esp_nome FROM especialidade";
$stmt = $conn->prepare($query);
$stmt->execute();
$especialidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT plano_id, plano_nome FROM planos";
$stmt = $conn->prepare($query);
$stmt->execute();
$planos = $stmt->fetchAll(PDO::FETCH_ASSOC);*/
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
    
    <div class="container mt-5">
        <h2 class="text-center mb-4">Cadastro Profissional da Saúde</h2>
        <form class="row g-3" method="POST" action="insert-profissional.php">
            <!-- Nome e Sobrenome -->
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="col-md-6">
                <label for="sobrenome" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
            </div>
            <div class="col-md-4">
                <label for="sexo" class="form-label">Sexo</label>
                <select id="sexo" class="form-select" name="sexo" required>
                    <option selected>Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>

            <!-- E-mail e Conselho Regional -->
            <div class="col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-6">
                <label for="conselho" class="form-label">Conselho Regional</label>
                <input type="text" class="form-control" id="conselho" name="conselho" placeholder="Conselho Regional">
            </div>

            <!-- Número de celular, WhatsApp, CPF e Data de Nascimento -->
            <div class="col-md-1">
                <label for="celularDDI" class="form-label">DDI</label>
                <input type="tel" class="form-control" id="celularDDI" name="celularDDI" placeholder="+55">
            </div>
            <div class="col-md-1">
                <label for="celularDDD" class="form-label">DDD</label>
                <input type="tel" class="form-control" id="celularDDD" name="celularDDD" placeholder="(00)">
            </div>
            <div class="col-md-2">
                <label for="celularNum" class="form-label">N° Celular</label>
                <input type="tel" class="form-control" id="celularNum" name="celularNum" placeholder="9-9999-9999">
            </div>
            <div class="col-md-2">
                <label for="whatsapp" class="form-label">WhatsApp</label>
                <select id="whatsapp" class="form-select" name="whatsapp" required>
                    <option selected>Sim</option>
                    <option>Não</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="col-md-3">
                <label for="data-nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="data-nascimento" name="data-nascimento" required>
            </div>

            <!-- CEP e Cidade -->
            <div class="col-md-3">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" required>
            </div>
            <div class="col-md-3">
                <label for="localidade" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="localidade" name="cidade" required readonly>
            </div>
            <div class="col-md-2">
                <label for="uf" class="form-label">Estado</label>
                <input type="text" class="form-control" id="uf" name="uf" required readonly>
            </div>

            <!-- Logradouro e Número -->
            <div class="col-md-4">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" required readonly>
            </div>
            <div class="col-md-3">
                <label for="logradouro" class="form-label">Nome Logradouro</label>
                <input type="text" class="form-control" id="logradouro" name="logradouro" required readonly>
            </div>
            <div class="col-md-3">
                <label for="numero" class="form-label">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" required>
            </div>
            <!-- Complemento -->
            <div class="col-md-6">
                <label for="complemento" class="form-label">Complemento</label>
                <input type="text" class="form-control" id="complemento" name="complemento">
            </div>

            <!-- Especialização e Planos -->
            <div class="col-md-6">
                <label for="especialidade" class="form-label">Escolha uma Especialidade:</label>
                <select class="form-select" id="especialidade" name="especialidade" required>
                    <option value="" disabled selected>Selecione uma especialidade</option>
                    <?php foreach ($especialidades as $especialidade): ?>
                        <option value="<?php echo htmlspecialchars($especialidade['esp_nome'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($especialidade['esp_nome'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="plano" class="form-label">Escolha o Plano de Saúde Associado</label>
                <select class="form-select" id="plano" name="plano" required>
                    <option value="" disabled selected>Selecione um plano</option>
                    <?php foreach ($planos as $plano): ?>
                        <option value="<?php echo htmlspecialchars($plano['plano_nome'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($plano['plano_nome'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                    <label for="senha" class="form-label">Crie uma senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="col-md-4">
                    <label for="confirma-senha" class="form-label">Confirme a senha</label>
                    <input type="password" class="form-control" id="confirma-senha" required>
                </div>

            <button type="submit" class="btn btn-secondary mt-4">Cadastrar-se</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const cepInput = document.querySelector("#cep");

        cepInput.addEventListener('blur', async (e) => {
            const cep = e.target.value.replace(/\D/g, ''); // Remove caracteres não numéricos
            if (cep.length === 8) { // Verifica se o CEP tem 8 dígitos
                const address = await fetchAddress(cep);
                fillAddressFields(address);
            } else {
                alert('Por favor, insira um CEP válido com 8 dígitos.');
            }
        });

        async function fetchAddress(value) {
            const response = await fetch(`https://viacep.com.br/ws/${value}/json/`);
            const body = await response.json();
            return body;
        }

        function fillAddressFields(body) {
            if (body.erro) {
                alert('CEP não encontrado. Verifique e tente novamente.');
                return;
            }
            document.getElementById('localidade').value = body.localidade || '';
            document.getElementById('logradouro').value = body.logradouro || '';
            document.getElementById('bairro').value = body.bairro || '';
            document.getElementById('uf').value = body.uf || '';
        }
    </script>
</body>
</html>
