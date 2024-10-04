<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Avaliação de Experiência</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .info-box {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .estrela {
            cursor: pointer;
            font-size: 2rem;
        }
        .img-shadow {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="d-flex align-items-center vh-100">

    <div class="container">
        <h1 class="mb-4 text-start">Como foi sua experiência?</h1>
        <div class="info-box d-flex align-items-start mb-4">
            <img src="https://igpamt.com.br/wp-content/uploads/2023/06/Dr.-Marcondes-Costa-Marques-500x500-1.jpg" alt="Imagem do usuário" width="100" height="100" class="img-fluid me-3 img-shadow">
            <div class="text-start">
                <label class="d-block mb-1">Nome: <strong>Rodolfo Soares da Silva</strong></label>
                <label class="d-block mb-1">Especialidade: <strong>Ginecologista</strong></label>
                <label class="d-block">Data de Atendimento: <strong>03/10/2024</strong></label>
            </div>
        </div>

        <div class="mb-3 text-start">
            <span class="estrela" data-value="1">★</span>
            <span class="estrela" data-value="2">★</span>
            <span class="estrela" data-value="3">★</span>
            <span class="estrela" data-value="4">★</span>
            <span class="estrela" data-value="5">★</span>
        </div>

        <div class="text-start">
            <button type="submit" class="btn btn-secondary">Avaliar</button>
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
</html>