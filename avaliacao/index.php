<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Avaliação de Experiência</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .estrela {
            cursor: pointer;
            font-size: 2rem;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="container text-center">
        <h1 class="mb-4">Como foi sua experiência?</h1>

        <img src="" alt="Imagem do usuário" width="150" height="150" class="img-fluid mb-3"><br>

        <label class="d-block mb-2">Nome: <strong>Rodolfo Soares da Silva</strong></label>
        <label class="d-block mb-2">Especialidade: <strong>Ginecologista</strong></label>
        <label class="d-block mb-4">Data de Atendimento: <strong>03/10/2024</strong></label>
        
        <label>Avaliação:</label><br>
        <span class="estrela" data-value="1">★</span>
        <span class="estrela" data-value="2">★</span>
        <span class="estrela" data-value="3">★</span>
        <span class="estrela" data-value="4">★</span>
        <span class="estrela" data-value="5">★</span><br><br>

        <button type="submit" class="btn btn-primary">Avaliar</button>
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
</html>