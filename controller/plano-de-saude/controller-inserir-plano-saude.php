<?php
include_once __DIR__ . '/../../config/database.php';

function validarCNPJ($cnpj) {
    // Remove caracteres não numéricos
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

    // Verifica se o CNPJ tem 14 dígitos
    if (strlen($cnpj) != 14) {
        return false;
    }

    // Elimina CNPJs inválidos conhecidos
    if (preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }

    // Validação dos dígitos verificadores
    for ($t = 12; $t < 14; $t++) {
        $d = 0;
        $c = 0;
        for ($m = $t - 7; $c < $t; $c++, $m--) {
            $m = $m < 2 ? 9 : $m;
            $d += $cnpj[$c] * $m;
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cnpj[$c] != $d) {
            return false;
        }
    }
    return true;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cnpj = $_POST['conv_cnpj'];
    $num_ans = $_POST['conv_num_ans'];
    $situacao = $_POST['conv_situacao'];
    $nome = $_POST['conv_nome'];

    // Validação do CNPJ
    if (!validarCNPJ($cnpj)) {
        header("Location: ../../model/plano-de-saude/index.php?erro=4");
        exit();
    }

    try {
        $query = "INSERT INTO convenios (conv_cnpj, conv_num_ans, conv_situacao, conv_nome) VALUES (:cnpj, :num_ans, :situacao, :nome)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':num_ans', $num_ans);
        $stmt->bindParam(':situacao', $situacao);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();

        header("Location: ../../model/plano-de-saude/index.php?sucesso=1");
        exit();
    } catch (PDOException $e) {
        header("Location: ../../model/plano-de-saude/index.php?erro=1");
        exit();
    }
}
?>
