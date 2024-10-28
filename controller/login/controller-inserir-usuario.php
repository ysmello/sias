<?php
// Conectar ao banco de dados
include __DIR__ . '/../../config/database.php';

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
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    try {
        $conn->beginTransaction();
        
        $stmt = $conn->prepare("INSERT INTO cidadao (cid_nome, cid_email, cid_celular, cid_cpf, cid_dt_nascimento, cid_sexo, cid_whatsapp) 
                                             VALUES (?,        ?,          ?,          ?,       ?,                 ?,        ?)");
        $stmt->execute([$nome . ' ' . $sobrenome, $email, $celular, $cpf, $data_nascimento, $sexo, $whatsapp]);
        $cidadao_id = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO usuario (cidadao_cid_id, usu_senha, usu_dt_cadastro, usu_situacao) 
                                VALUES (?, ?, NOW(), 1)");
        $stmt->execute([$cidadao_id, $senha]);

        $stmt = $conn->prepare("INSERT INTO logradouro (cidadao_cid_id, municipio, log_nome, log_numero, log_complemento, log_cep) 
                                                VALUES (?,              ?,         ?,        ?,          ?,               ?)");
        
        $stmt->execute([$cidadao_id, $cidade, $logradouro, $numero, $complemento, $cep]);

        $conn->commit();
        
        header('Location: ../../../index.php?sucesso=1');
        exit();
        
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Falha no cadastro: " . $e->getMessage();
    }
}
?>
