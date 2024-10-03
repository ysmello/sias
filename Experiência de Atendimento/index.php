<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Avaliação de Experiência</title>
    
</head>
<body>

    <div class="container">
        <h1>Como foi sua experiência?</h1>

        <img src="https://medcorsorocaba.com.br/wp-content/uploads/2022/04/Dr-Jose-Roberto-Pineda-Pietrobon-Redini-Martins-500x500.png" width="150" height="150"><br><br>

        <label for="nome">Nome: Rodolfo Soares da Silva</label><br><br>

        <label for="especialidade">Especialidade: Ginecologista</label><br><br>

        <label for="data">Data de Atendimento: 03/10/2024</label><br><br>
        
        <label>Avaliação:</label><br>
        <span class="estrela" data-value="1">★</span>
        <span class="estrela" data-value="2">★</span>
        <span class="estrela" data-value="3">★</span>
        <span class="estrela" data-value="4">★</span>
        <span class="estrela" data-value="5">★</span><br><br>

        <button type="submit">Avaliar</button>
    </div>

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