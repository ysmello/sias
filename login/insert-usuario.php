<?php
// Conectar ao banco de dados
include __DIR__ . '/../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];
    $celular = '+' . $_POST['celularDDI'] . $_POST['celularDDD'] . $_POST['celularNum'];
    $whatsapp = ($_POST['whatsapp'] == 'Sim') ? 1 : 0;
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data-nascimento'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $uf = $_POST['uf'];  // Nome do estado vindo da API ViaCEP
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    try {
        $conn->beginTransaction();
        
        // Inserir cidadão
        $stmt = $conn->prepare("INSERT INTO cidadao (cid_nome_razao, cid_email, cid_celular, cid_cpf_cnpj, cid_dt_nascimento, cid_sexo, cid_whatsapp) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome . ' ' . $sobrenome, $email, $celular, $cpf, $data_nascimento, $sexo, $whatsapp]);
        $cidadao_id = $conn->lastInsertId();

        // Inserir usuário
        $stmt = $conn->prepare("INSERT INTO usuario (cidadao_cid_id, usu_senha, usu_dt_cadastro, usu_situacao) 
                                                    VALUES (?, ?, NOW(), 1)");
        $stmt->execute([$cidadao_id, $senha]);

        // Verificar se o estado já existe
        $stmt = $conn->prepare("SELECT est_id FROM estado WHERE est_nome = ?");
        $stmt->execute([$uf]);
        $estado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$estado) {
            // Inserir novo estado se não existir
            $stmt = $conn->prepare("INSERT INTO estado (est_nome) VALUES (?)");
            $stmt->execute([$uf]);
            $estado_id = $conn->lastInsertId();
        } else {
            $estado_id = $estado['est_id'];
        }

        // Verificar se o município já existe
        $stmt = $conn->prepare("SELECT mun_id FROM municipio WHERE mun_nome = ? AND estado_est_id = ?");
        $stmt->execute([$cidade, $estado_id]);
        $municipio = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$municipio) {
            // Inserir novo município se não existir
            $stmt = $conn->prepare("INSERT INTO municipio (mun_nome, estado_est_id) VALUES (?, ?)");
            $stmt->execute([$cidade, $estado_id]);
            $municipio_id = $conn->lastInsertId();
        } else {
            $municipio_id = $municipio['mun_id'];
        }

        // Inserir logradouro
        $stmt = $conn->prepare("INSERT INTO logradouro (log_nome, log_numero, log_complemento, log_bairro, log_cep, municipio_mun_id) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$logradouro, $numero, $complemento, $bairro, $cep, $municipio_id]);

        $conn->commit();

        // Redirecionar de volta para a página de cadastro com uma mensagem de sucesso
        header('Location: ../login/registro.php?sucesso=1');
        exit();
        
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Falha no cadastro: " . $e->getMessage();
    }
}
?>
