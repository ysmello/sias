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
    $uf = $_POST['uf'];
    $tipo_logradouro = $_POST['tipo-logradouro'];
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

        // Inserir logradouro
        $stmt = $conn->prepare("INSERT INTO logradouro (tipo_logradouro_tp_log_id, municipio_mun_id, log_nome, log_numero, log_complemento, log_cep) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        
        // Aqui você precisa resolver a busca ou inserção de município e tipo_logradouro.
        $stmt->execute([$tipo_logradouro, $cidade, $logradouro, $numero, $complemento, $cep]);

        $conn->commit();
        echo "Cadastro realizado com sucesso!";
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Falha no cadastro: " . $e->getMessage();
    }
}
?>
