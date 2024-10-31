<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../../config/database.php';

// Receber dados do formulário
$usuario_id = $_POST['usuario_id'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$celular = $_POST['celularDDI'] . $_POST['celularDDD'] . $_POST['celularNum'];
$whatsapp = ($_POST['whatsapp'] == 'Sim') ? 1 : 0;
$cpf = $_POST['cpf'];
$data_nascimento = $_POST['data-nascimento'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$estado = $_POST['uf'];
$bairro = $_POST['bairro'];
$logradouro = $_POST['logradouro'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];

try {
    $conn->beginTransaction();

    // Atualizar dados na tabela cidadao
    $stmt = $conn->prepare("UPDATE cidadao 
                            SET cid_nome = ?, cid_email = ?, cid_celular = ?, cid_cpf = ?, 
                                cid_dt_nascimento = ?, cid_sexo = ?, cid_whatsapp = ? 
                            WHERE cid_id = ?");
    $stmt->execute([$nome . ' ' . $sobrenome, $email, $celular, $cpf, $data_nascimento, $sexo, $whatsapp, $usuario_id]);

    // Atualizar dados na tabela logradouro
    $stmt = $conn->prepare("UPDATE logradouro 
                            SET log_estado = ?, log_municipio = ?, log_bairro = ?, 
                                log_nome = ?, log_numero = ?, log_complemento = ?, log_cep = ? 
                            WHERE cidadao_cid_id = ?");
    $stmt->execute([$estado, $cidade, $bairro, $logradouro, $numero, $complemento, $cep, $usuario_id]);

    $conn->commit();
    
    header('Location: ../../../index.php?sucesso=5');
    exit();
    
} catch (Exception $e) {
    $conn->rollBack();
    //echo "Erro: " . $e->getMessage(); // Exibir mensagem de erro
    header('Location: ../../../index.php?erro=8');
    exit();
}
?>
