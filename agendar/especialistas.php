<?php
    include '../config/database.php';
    
    
    $stmt = $conn->prepare("SELECT c.cid_nome AS prof_nome, p.prof_especialidade AS prof_esp FROM profissional p 
                            JOIN usuario u ON p.usuario_usu_id = u.usu_id
                            JOIN cidadao c ON u.cidadao_cid_id = c.cid_id;
                        ");
    

    if (isset($_GET['especialidade'])) {
        $especialidade = $_GET['especialidade'];

        $stmt = $conn->prepare("SELECT c.cid_nome AS prof_nome, p.prof_especialidade AS prof_esp FROM profissional p 
                            JOIN usuario u ON p.usuario_usu_id = u.usu_id
                            JOIN cidadao c ON u.cidadao_cid_id = c.cid_id
                            WHERE p.prof_especialidade LIKE :busca;
                        ");
        
        $stmt->bindValue(':busca', '%' . $especialidade . '%');
    }
    
    $stmt->execute();

    $especialistas = $stmt->fetchAll();
?>

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
    <?php
      include '../components/header.php';
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row pt-4 pb-4">
                <form class="d-flex" method="GET">
                    <input class="form-control me-2" type="form-select" name="especialidade"  placeholder="Buscar por profissionais" aria-label="from-select">
                    <input class="form-control me-2" type="search" placeholder="Localidade" aria-label="Search">
                    <input class="form-control me-2" type="search" placeholder="Convenio" aria-label="Search">
                    <input class="form-control me-2" type="date" placeholder="Data" aria-label="date">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
                <div class="mt-4">
                    <?php foreach($especialistas as $especialista): ?>
                        <div class="d-flex align-items-start border p-3 mb-2 bg-white rounded">
                            <img src="https://igpamt.com.br/wp-content/uploads/2023/06/Dr.-Marcondes-Costa-Marques-500x500-1.jpg" alt="Imagem do usuário" width="100" height="100" class="img-fluid me-3 img-shadow"></img>
                            <div class="text-start">
                                <label class="d-block mb-1">Nome: <strong><?php echo $especialista['prof_nome'] ?></strong></label>
                                <label class="d-block mb-1">Especialidade: <strong><?php echo $especialista['prof_esp'] ?></strong></label>
                                <label class="d-block">Data de Atendimento: <strong>03/10/2024</strong></label>
                                <span data-value="1">★ ★ ★ ★ ★</span>  
                            </div>
                        </div>                         
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script>
        const stars = document.querySelectorAll('.estrela');
        let selectedRating = 0;

        stars.forEach(star => {
            star.addEventListener('click', () => {
                selectedRating = star.getAttribute('data-value');
                stars.forEach(s => {
                    s.style.color = 'gray';
                });
                for (let i = 0; i < selectedRating; i++) {
                    stars[i].style.color = 'gold';
                }
            });
        });
    </script>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/079c8de8d4.js" crossorigin="anonymous"></script>
</html>
