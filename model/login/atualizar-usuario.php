<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/../../config/database.php';

// Verifique se o usuário está logado
if (!isset($_SESSION['usu_id'])) {
    header('Location: /');
    exit();
}

$userId = $_SESSION['usu_id'];
$stmt = $conn->prepare("
select 
	a.usu_id,
	a.cidadao_cid_id,	
	a.usu_tp,
	a.usu_senha,	
	a.usu_dt_cadastro,	
	a.usu_dt_ultimo_acesso,	
	a.usu_situacao,	
	b.cid_id,	
	b.cid_cpf,	
	b.cid_nome,	
	b.cid_foto,	
	b.cid_dt_nascimento,	
	b.cid_sexo,	
	b.cid_email,	
	b.cid_celular,	
	b.cid_whatsapp,	
	b.reset_token,
	c.log_id,
	c.log_municipio,
    c.log_estado,
	c.log_nome,
	c.log_numero,
	c.log_complemento,
	c.log_bairro,
	c.log_cep
from usuario a
        inner join cidadao b on a.cidadao_cid_id = b.cid_id 
        inner join logradouro c on a.cidadao_cid_id = c.cidadao_cid_id 
where usu_id = :userId  
");
$stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<p>Usuário não encontrado.</p>";
    exit;
}

// Separando o nome e sobrenome
$nomeCompleto = $usuario['cid_nome'] ?? '';
$partesNome = explode(' ', $nomeCompleto);

// O primeiro nome e o sobrenome
$nome = implode(' ', array_slice($partesNome, 0, -1)); // Todos menos o último
$sobrenome = end($partesNome); // O último

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Dados Cadastrais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="overflow-hidden">
    <?php 
        include __DIR__ . '/../../components/header.php'; 
    ?>
    <div class="container d-flex justify-content-center align-items-center flex-column mt-5">
        <div class="container">
            <form class="row g-3" method="POST" action="/controller/login/controller-atualizar-usuario.php">
                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario['usu_id'] ?? ''); ?>">

                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($nome ?? ''); ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="sobrenome" class="form-label">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo htmlspecialchars($sobrenome ?? ''); ?>" required>
                </div>
                <div class="col-md-2">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select id="sexo" class="form-select" name="sexo" required>
                        <option value="M" <?php echo (isset($usuario['cid_sexo']) && $usuario['cid_sexo'] == 'M') ? 'selected' : ''; ?>>Masculino</option>
                        <option value="F" <?php echo (isset($usuario['cid_sexo']) && $usuario['cid_sexo'] == 'F') ? 'selected' : ''; ?>>Feminino</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['cid_email'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="confirma-email" class="form-label">Confirme o e-mail</label>
                    <input type="email" class="form-control" id="confirma-email" name="confirma-email" value="<?php echo htmlspecialchars($usuario['cid_email'] ?? ''); ?>" required>
                </div>

                <div class="col-md-1">
                    <label for="celularDDI" class="form-label">DDI</label>
                    <input type="tel" class="form-control" id="celularDDI" name="celularDDI" value="<?php echo htmlspecialchars(substr($usuario['cid_celular'] ?? '', 0, 3)); ?>" placeholder="+55">
                </div>
                <div class="col-md-1">
                    <label for="celularDDD" class="form-label">DDD</label>
                    <input type="tel" class="form-control" id="celularDDD" name="celularDDD" value="<?php echo htmlspecialchars(substr($usuario['cid_celular'] ?? '', 3, 2)); ?>" placeholder="(00)">
                </div>
                <div class="col-md-2">
                    <label for="celularNum" class="form-label">N° Celular</label>
                    <input type="tel" class="form-control" id="celularNum" name="celularNum" value="<?php echo htmlspecialchars(substr($usuario['cid_celular'] ?? '', 5)); ?>" placeholder="9-9999-9999">
                </div>
                <div class="col-md-2">
                    <label for="whatsapp" class="form-label">WhatsApp</label>
                    <select id="whatsapp" class="form-select" name="whatsapp">
                        <option value="Sim" <?php echo (isset($usuario['cid_whatsapp']) && $usuario['cid_whatsapp'] == 'Sim') ? 'selected' : ''; ?>>Sim</option>
                        <option value="Não" <?php echo (isset($usuario['cid_whatsapp']) && $usuario['cid_whatsapp'] == 'Não') ? 'selected' : ''; ?>>Não</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo htmlspecialchars($usuario['cid_cpf'] ?? ''); ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="data-nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data-nascimento" name="data-nascimento" value="<?php echo htmlspecialchars($usuario['cid_dt_nascimento'] ?? ''); ?>" required>
                </div>

                <div class="col-md-3">
                    <label for="cep" class="form-label">CEP</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="cep" name="cep" value="<?php echo htmlspecialchars($usuario['log_cep'] ?? ''); ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="localidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="localidade" name="cidade" value="<?php echo htmlspecialchars($usuario['log_municipio'] ?? ''); ?>" required readonly>
                </div>
                <div class="col-md-2">
                    <label for="uf" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="uf" name="uf" value="<?php echo htmlspecialchars($usuario['log_estado'] ?? ''); ?>" required readonly>
                </div>

                <div class="col-md-4">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo htmlspecialchars($usuario['log_bairro'] ?? ''); ?>" required readonly>
                </div>
                <div class="col-md-5">
                    <label for="logradouro" class="form-label">Nome Logradouro</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro" value="<?php echo htmlspecialchars($usuario['log_nome'] ?? ''); ?>" required readonly>
                </div>
                <div class="col-md-2">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" value="<?php echo htmlspecialchars($usuario['log_numero'] ?? ''); ?>" required>
                </div>

                <div class="col-md-5">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" value="<?php echo htmlspecialchars($usuario['log_complemento'] ?? ''); ?>">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-secondary w-100">Atualizar Dados</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>    
    <script>
        const cepInput = document.querySelector("#cep")

        cepInput.addEventListener('blur', async (e) => {
            const cep = e.target.value
            const adress = await fetchAddress(cep)
            fillAddressFields(adress)
        })

        async function fetchAddress(value) {
            const response = await fetch(`https://viacep.com.br/ws/${value}/json/`)
            const body = await response.json()
            return body
        }

        function fillAddressFields(body) {
            const fields = ['localidade', 'logradouro', 'bairro', 'uf']
            fields.forEach(key => {
                const currentField = document.getElementById(key)

                if (currentField) {
                    currentField.value = body[key]
                }
            })
        }
    </script>    
</body>
<?php
    include __DIR__ . '/../../components/footer.php'
?>
</html>
