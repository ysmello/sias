<?php
$host = 'localhost';
$dbname = 'atv3'; 
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_prod = $_POST['nome_prod'];
    $setor_prod = $_POST['setor_prod'];
    $custo_prod = $_POST['custo_prod'];
    $venda_prod = $_POST['venda_prod'];
    $estoque_prod = $_POST['estoque_prod'];

    $sql = "INSERT INTO produtos (nome_prod, setor_prod, custo_prod, venda_prod, estoque_prod) VALUES ('$nome_prod', $setor_prod, $custo_prod, $venda_prod, $estoque_prod)";
    if ($conn->query($sql) === TRUE) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<form method="post">
    Nome do Produto: <input type="text" name="nome_prod" required><br>
    Setor do Produto: 
    <select name="setor_prod" required>
        <?php
        $setores = $conn->query("SELECT * FROM setores");
        while ($setor = $setores->fetch_assoc()) {
            echo "<option value='" . $setor['id_set'] . "'>" . $setor['nome_set'] . "</option>";
        }
        ?>
    </select><br>
    Preço de Custo: <input type="text" name="custo_prod" required><br>
    Preço de Venda: <input type="text" name="venda_prod" required><br>
    Estoque: <input type="number" name="estoque_prod" required><br>
    <input type="submit" value="Cadastrar Produto">
</form>

<?php
    if (isset($_GET['delete'])) {
        $id_prod = $_GET['delete'];
        $conn->query("DELETE FROM produtos WHERE id_prod = $id_prod");
        header("Location: " . $_SERVER['PHP_SELF']); // Redireciona para evitar reenvio do formulário
    }
?>

<h2>Produtos Cadastrados</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome do Produto</th>
        <th>Setor</th>
        <th>Preço de Custo</th>
        <th>Preço de Venda</th>
        <th>Estoque</th>
        <th>Ações</th>
    </tr>
    <?php
    $produtos = $conn->query("SELECT p.*, s.nome_set FROM produtos p JOIN setores s ON p.setor_prod = s.id_set");
    while ($produto = $produtos->fetch_assoc()) {
        echo "<tr>
                <td>{$produto['id_prod']}</td>
                <td>{$produto['nome_prod']}</td>
                <td>{$produto['nome_set']}</td>
                <td>{$produto['custo_prod']}</td>
                <td>{$produto['venda_prod']}</td>
                <td>{$produto['estoque_prod']}</td>
                <td>
                    <a href='?delete={$produto['id_prod']}'>Excluir</a>
                </td>
              </tr>";
    }
    ?>
</table>

