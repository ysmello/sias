<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="overflow-hidden">
    <?php
        include 'config/database.php';
        include 'components/header.php';
    ?>

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
                                <h5 class="modal-title w-100" id="mensagensModalLabel">USUÁRIO CADASTRADO COM SUCESSO!</h5>
                            <?php elseif ($_GET['sucesso'] == 2): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">LOGIN REALIZADO COM SUCESSO!</h5>
                            <?php elseif ($_GET['sucesso'] == 3): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">E-MAIL ENVIADO COM SUCESSO!</h5>
                            <?php elseif ($_GET['sucesso'] == 4): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">SENHA ALTERADA COM SUCESSO!</h5>                                
                            <?php elseif ($_GET['sucesso'] == 5): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">DADOS CADASTRAIS ALTERADOS COM SUCESO!</h5>                                
                            <?php elseif ($_GET['sucesso'] == 6): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">SENHA ALTERADA COM SUCESO!</h5>                                
                            <?php endif; ?>
                        <?php elseif (isset($_GET['erro'])): ?>
                            <?php if ($_GET['erro'] == 1): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">SENHA INCORRETA!</h5>
                            <?php elseif ($_GET['erro'] == 2): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">USUÁRIO NÃO LOCALIZADO!</h5>
                            <?php elseif ($_GET['erro'] == 3): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">USUÁRIO E SENHA NÃO INFORMADOS!</h5>
                            <?php elseif ($_GET['erro'] == 4): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">USUÁRIO INATIVADO!</h5>
                            <?php elseif ($_GET['erro'] == 5): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ERRO AO ENVIAR E-MAIL!</h5>
                            <?php elseif ($_GET['erro'] == 6): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ERRO AO ALTERAR A SENHA, TOKEN INVÁLIDO!</h5>                                                                   
                            <?php elseif ($_GET['erro'] == 7): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ERRO AO ALTERAR A SENHA, PALAVRA PASSE INVÁLIDA!</h5>                                                                   
                            <?php elseif ($_GET['erro'] == 8): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ERRO, USUÁRIO NÃO AUTENTICADO!</h5>                                                                   
                            <?php elseif ($_GET['erro'] == 9): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ERRO, AS SENHAS NÃO COINCIDEM!</h5>                                                                   
                            <?php elseif ($_GET['erro'] == 10): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ERRO, COMPRIMENTO DA SENHA INVÁLIDO!</h5>                                                                   
                            <?php elseif ($_GET['erro'] == 11): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ERRO AO ATUALIZAR A SENHA!</h5>                                                                   
                            <?php elseif ($_GET['erro'] == 12): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ERRO AO ALTERAR OS DADOS CADASTRAIS!</h5>                                                                   
                            <?php elseif ($_GET['erro'] == 13): ?>
                                <h5 class="modal-title w-100" id="mensagensModalLabel">ERRO DE CONEXÃO COM O BANCO DE DADOS</h5>                                                                   
                            <?php endif; ?>
                        <?php endif; ?>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="window.location='index.php';"></button>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
    <?php
        include 'components/footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>      
    <!-- Script para mostrar o modal automaticamente -->
    <script>
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
</html>
