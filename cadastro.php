<?php include "config.php";?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sias</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    

    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Links de navegação -->
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Início</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/login/registro.php">Cadastro do Usuário</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Cadastro do Profissional da Saúde</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Agendamento e consulta</a>
        </li>
      </ul>
      
  
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <title>Cadastrar de Paciente</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Antique&display=swap" rel="stylesheet">
</head>

<style>

    .font-shippori {
        font-family: 'Shippori Antique', sans-serif;
    }
    .font-shippori-bold {
        font-family: 'Shippori Antique', sans-serif;
        font-weight: bold;
    }
</style>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row pt-4 pb-4">
                <div class="card">
                    <h5 class="pt-3 font-shippori-bold">&ensp;Cadastro de Paciente</h5>
                    <form class="p-4" method="POST" action="../exec/cadastrar.php">
                        <div class="mb-3">
                            <i class="fas fa-user-alt"></i>
                            <label class="form-label font-shippori">Nome Completo:</label>
                            <input type="text" class="form-control" name="nome" autofocus required>
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-phone"></i>
                            <label class="form-label font-shippori">Telefone:</label>
                            <input type="number" class="form-control" name="telefone" autofocus required>
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-calendar-alt"></i>
                            <label class="form-label font-shippori">Idade:</label>
                            <input type="number" class="form-control" name="idade" autofocus required>
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-at"></i>
                            <label class="form-label font-shippori">Email:</label>
                            <input type="email" class="form-control" name="email" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword4" class="form-label font-shippori">Crie uma senha:</label>
                            <input type="password" class="form-control" id="inputPassword4">
                        </div>
                        <div class="mb-3">
                            <label for="inputAddress" class="form-label font-shippori">Endereço:</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="Rua, Avenida...">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label font-shippori">Complemento</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Casa, Apartamento, lote...">
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label font-shippori">Cidade:</label>
                            <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="col-md-6">
                            <label for="inputState" class="form-label font-shippori">Estado:</label>
                            <input type="text" class="form-control" id="inputCity">
                            </select>
                        </div>
                        <div class="mb-3">
                            <i class="bi bi-file-medical"></i>
                            <label class="form-label font-shippori">Plano de saúde:</label>
                            <div class="container text-center">
                                <div class="row align-items-start">
                                <div class="col">
                                Nome do Plano
                                <input type="text" class="form-control" name="nome_do_plano" autofocus required>
                                </div>
                                <div class="col">
                                Numero da carterinha
                                <input type="number" class="form-control" name="numero da carterinha" autofocus required>
                                </div>
                                <div class="col">
                                Validade
                                <input type="date" class="form-control" name="validade" autofocus required>
                                </div>
                            </div>
                            </div>
                        </div>
                            <br>
                        <div class="botao">
                            <input type="hidden" name="oculto" value="1"> 
                            <input type="submit" class="btn btn-primary" value="Cadastrar"> 
                        
<?php
//gravar no banco de bados
            if(isset($_POST['grava'])){
                $nome=$_POST['nome'];
                $email=$_POST['email'];
                if($nome=="" || $email==""){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Os campos <strong>Nome</strong> e <strong> E-mail</strong> é obrigatório!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }elseif(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com\.br|br|com)$/",$email)){

                    }else{
                        $consemail=$conn->prepare("SELECT * FROM `usuario` WHERE  `cad_email` = :email  AND `cad_status`= 1");
                        $consemail->bindValue(":email", $email);
                        $consemail->execute();
                        if($consemail->rowCount()>=1){
                        ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        O<strong> E-mail</strong> já está cadastrado!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php

                        }else{
                        $gravar=$conn->prepare("INSERT INTO `usuario` 
                        (`cad_id`, `cad_nome`, `cad_email`, `cad_status`)
                        VALUES (NULL, :nome, :email, '1');");
                        $gravar->bindValue(":nome",$nome);
                        $gravar->bindValue(":email",$email);
                        $gravar->execute();
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Gravado com Sucesso!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } } }  ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/079c8de8d4.js" crossorigin="anonymous"></script>
</html>
