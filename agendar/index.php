<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include '../components/header.php'
    ?>

    <div class="container">
        <div class="row">
            <div class="col-6 p-5">
                <div class="d-flex gap-4">
                    <div class="card" style="width: 10rem; height: 10rem;">
                        <img src="..." class="card-img-top" alt="...">
                    </div>
                    <div>
                        <p>Nome do Médico</p>
                        <p>Rua do fulano</p>
                        <p>Especialidade</p>
                    </div>
                </div>
                <div class="row d-flex mt-4">
                    <div class="col-6">
                        <h3>Consultorios</h3>
                        <p>Endereco</p>
                        <span>Rua do fulano</span>
                        <p>Tipo de plano aceitos</p>
                        <span>Nenhum</span>
                    </div>
                    <div class="col-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3602.8725298927175!2d-49.26385702428613!3d-25.442524833387946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94dce45e866e499d%3A0x82faf99d26503617!2sRua%20Engenheiros%20Rebou%C3%A7as%2C%20Curitiba%20-%20PR%2C%2082590-300!5e0!3m2!1spt-BR!2sbr!4v1727829557709!5m2!1spt-BR!2sbr" width="200" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-6 p-5">
                <div class="d-flex gap-4">
                    <div class="d-flex flex-column align-items-center">
                        <span>Hoje</span>
                        <span>2 out</span>
                        <a href="/agendar/escolher-data.php">9:00</a>
                        <span> - </span>
                        <span> - </span>
                        <span> - </span>
                        <span> - </span>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <span>Amanhã</span>
                        <span>3 out</span>
                        <span> 9:00 </span>
                        <span> - </span>
                        <span> - </span>
                        <span> - </span>
                        <span> - </span>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <span>Quarta</span>
                        <span>4 out</span>
                        <span> 9:00 </span>
                        <span> - </span>
                        <span> - </span>
                        <span> - </span>
                        <span> - </span>
                        
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <span>Quinta</span>
                        <span>5 out</span>
                         <span> 9:00 </span>
                        <span> - </span>
                        <span> - </span>
                        <span> - </span>
                        <span> - </span>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <span>Sexta</span>
                        <span>6 out</span>
                         <span> 9:00 </span>
                        <span> - </span>
                        <span> - </span>
                        <span> - </span>
                        <span> - </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getMonthName(monthIndex) {
            const monthNames = [
                'jan', 'fev', 'mar', 'abr', 'mai', 'jun',
                'jul', 'ago', 'set', 'out', 'nov', 'dez'
            ];
            return monthNames[monthIndex];
        }

        function formatDate(date) {
            const day = date.getDate();
            const month = getMonthName(date.getMonth());
            return `${day} ${month}`;
        }

        // TODO GET DATES BY FETCH
        // const enabledDays = fetch(script.php)

        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);
        const tuesday = new Date(today);
        tuesday.setDate(today.getDate() + 2);

        const todayFormatted = `Hoje: ${formatDate(today)}`;
        const tomorrowFormatted = `Amanhã: ${formatDate(tomorrow)}`;
        const tuesdayFormatted = `Terça: ${formatDate(tuesday)}`;

        const datesDiv = document.getElementById('dates');

        datesDiv.innerHTML = `<p>${todayFormatted}</p><p>${tomorrowFormatted}</p><p>${tuesdayFormatted}</p>`;
    </script>
</body>
</html>