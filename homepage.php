<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php
        include 'config/database.php';
        include 'components/header.php';
        // Verifica se o usuário está logado
        $isLoggedIn = isset($_SESSION['user_id']); // Altere 'user_id' para o nome da sua sessão
        $redirectLoggedIn = 'pagina_logada.php'; // URL para usuários logados
        $redirectNotLoggedIn = 'login/registro.php'; // URL para usuários não logados
    ?>
</head>
    <body>
        </html> <!-- Imagens do banner-->
        <section class="banner">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/novembro_azul.png" class="d-block w-100" alt="..."  style="height: 500px; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="img/dezembro_vermelho.png" class="d-block w-100" alt="..." style="height: 500px; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="img/quem_e_sias.png" class="d-block w-100" alt="..." style="height: 500px; object-fit: cover;">
            </div>
        </div>
    </div>
    <br>
</section>

<br> <!-- Cards coloridos -->
        <section class="agendamento_container__bgxHc" data-testid="secaoCTAsAgendamentoContainer">
    <div class="container">
        <div class="row">
        <div class="col-md-4" style="width: 18rem;">
    <a href="login/registro.php" style="text-decoration: none;">
        <div class="cards_container__JQY2v cards_containerEstilo1__KJ3Pr rounded" role="button" data-testid="cardCTAAgendamentoConsultasPresenciais" style="background-color: rgb(226, 223, 250);">
            <div class="cards_imagemContainer__f3va_ cards_imagemContainerEstilo1__eHxsx">
                <img src="https://cdn.buttercms.com/EpuAgHGDTmuA4SAgXXUh" alt="">
            </div>
            <div class="cards_contentContainer__7NNx_">
                <p class="cards_titulo__qXDAi cards_tituloEstilo1__EDQQa" style="color: rgb(58, 16, 224);">Agendar Presenciais</p>
            </div>
        </div>
    </a>
</div>

            <div class="col-md-4"style="width: 18rem;">
            <a href="login/registro.php" style="text-decoration: none;">
                <div class="cards_container__JQY2v cards_containerEstilo1__KJ3Pr rounded" role="button" data-testid="cardCTAAgendamentoConsultasOnline" style="background-color: rgb(230, 247, 251);">
                    <div class="cards_imagemContainer__f3va_ cards_imagemContainerEstilo1__eHxsx">
                        <img src="https://cdn.buttercms.com/qHvuSQ3OTyWo2zmuXcVd" alt="">
                    </div>
                    <div class="cards_contentContainer__7NNx_">
                        <p class="cards_titulo__qXDAi cards_tituloEstilo1__EDQQa" style="color: rgb(23, 123, 143);">Agendar Consultas Online</p>
                    </div>
                </div>
    </a>
</div>
            <div class="col-md-4"style="width: 18rem;">
            <a href="login/registro.php" style="text-decoration: none;">
                <div class="cards_container__JQY2v cards_containerEstilo1__KJ3Pr rounded" role="button" data-testid="cardCTAAgendamentoExames" style="background-color: rgb(254, 239, 236);">
                    <div class="cards_imagemContainer__f3va_ cards_imagemContainerEstilo1__eHxsx">
                        <img src="https://cdn.buttercms.com/wQwk0Nk2SquA486u8MzL" alt="">
                    </div>
                    <div class="cards_contentContainer__7NNx_">
                        <p class="cards_titulo__qXDAi cards_tituloEstilo1__EDQQa" style="color: rgb(166, 74, 55);">Agendar Exames</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-4"style="width: 18rem;">
            <a href="login/registro.php" style="text-decoration: none;">
                <div class="cards_container__JQY2v cards_containerEstilo2__h_UrV rounded" role="button" data-testid="cardCTAAgendamentoVacinas" style="background-color: rgb(229, 250, 244);">
                    <div class="cards_imagemContainer__f3va_ cards_imagemContainerEstilo2__fAK5j">
                        <img src="https://cdn.buttercms.com/p0P6GgotTrKFffu3adzB" alt="">
                    </div>
                    <div class="cards_contentContainer__7NNx_">
                    <a href="login/registro.php" style="text-decoration: none;">
                        <p class="cards_titulo__qXDAi cards_tituloEstilo2__xKTX1" style="color: rgb(20, 62, 71);">Agendar Vacinas</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-4"style="width: 18rem;">
                <div class="cards_container__JQY2v cards_containerEstilo2__h_UrV rounded" role="button" data-testid="cardCTAAgendamentoCheckUps" style="background-color: rgb(254, 239, 236);">
                    <div class="cards_imagemContainer__f3va_ cards_imagemContainerEstilo2__fAK5j">
                        <img src="https://cdn.buttercms.com/8X1TxEaTU6C4wS9Q2tzQ" alt="">
                    </div>
                    <div class="cards_contentContainer__7NNx_">
                    <a href="login/registro.php" style="text-decoration: none;">
                        <p class="cards_titulo__qXDAi cards_tituloEstilo2__xKTX1" style="color: rgb(166, 74, 55);">Agendar Check-Ups</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-4"style="width: 18rem;">
            <a href="login/registro.php" style="text-decoration: none;">
                <div class="cards_container__JQY2v cards_containerEstilo2__h_UrV rounded" role="button" data-testid="cardCTAAgendamentoCirurgias" style="background-color: rgb(253, 247, 228);">
                    <div class="cards_imagemContainer__f3va_ cards_imagemContainerEstilo2__fAK5j">
                        <img src="https://cdn.buttercms.com/z7oJyZ2SoGpoVC5nDGEi" alt="">
                    </div>
                    <div class="cards_contentContainer__7NNx_">
                        <p class="cards_titulo__qXDAi cards_tituloEstilo2__xKTX1" style="color: rgb(160, 124, 6);">Agendar Consultas</p>
                    </div>
                </div>
            </a>
        </div>
                <div class="col-md-4"style="width: 18rem;">
                <div class="cards_container__JQY2v cards_containerEstilo2__h_UrV rounded" role="button" data-testid="cardCTAAgendamentoCheckUps" style="background-color: rgb(205, 247, 217);">
                    <div class="cards_imagemContainer__f3va_ cards_imagemContainerEstilo2__fAK5j">
                        <img src="https://cdn.buttercms.com/8X1TxEaTU6C4wS9Q2tzQ" alt="">
                    </div>
                    <div class="cards_contentContainer__7NNx_">
                    <a href="login/registro.php" style="text-decoration: none;">
                        <p class="cards_titulo__qXDAi cards_tituloEstilo2__xKTX1" style="color: rgb(166, 74, 55);">Avalie o Serviço</p>
                    </div>
                </div>
                </a>
            </div>
            </div>
        </div>
        </a>
    </div>
</section>


<style>
.square-card {
    aspect-ratio: 1; /* Garante que os cartões sejam quadrados */
    overflow: hidden; /* Para evitar que o conteúdo saia do cartão */
}
.cards_imagemContainer__f3va_ img {
    width: 9%; /* Faz com que a imagem ocupe 100% do espaço do cartão */
    height: auto; /* Mantém a proporção da imagem */
}
</style>
<section> <!-- Cards de exames mais procurados-->
<div class="seo_blocoContainer__6bwPX" style="display: flex; flex-direction: column; align-items: center;">
        <div class="seo_contentContainer__0uzQi">
            <div>
            </div><h3 class="seo_titulo__G3cMR">Exames mais procurados <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20.125 20.125L15.1448 15.1448M15.1448 15.1448C16.4455 13.8441 17.25 12.0473 17.25 10.0625C17.25 6.09295 14.032 2.875 10.0625 2.875C6.09295 2.875 2.875 6.09295 2.875 10.0625C2.875 14.032 6.09295 17.25 10.0625 17.25C12.0473 17.25 13.8441 16.4455 15.1448 15.1448Z" stroke="#4F555A" stroke-width="1.59722" stroke-linecap="round" stroke-linejoin="round"/>
</svg></h3>
</div>
<div class="card_container__tzKfr" style="background-color: rgb(173, 216, 230); margin-bottom: 20px; width: 80%; text-align: center;">
            <h4 class="card_titulo__5BA46" style="color: rgb(0,0,0);">Mamografia</h4>
             <p class="card_descricao__3npdI" style="color: rgb(0,0,0);">Agende o preventivo de câncer de mama</p>
            <div class="card_botaoContainer__6oHFk">
            <a href="<?php echo $isLoggedIn ? $redirectLoggedIn : $redirectNotLoggedIn; ?>" class="btn card_botao__gBtjG"> 
            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path d="M9.33398 3.00033L1.91732 10.417C1.76454 10.5698 1.5701 10.6462 1.33398 10.6462C1.09787 10.6462 0.903429 10.5698 0.750651 10.417C0.597873 10.2642 0.521484 10.0698 0.521484 9.83366C0.521484 9.59755 0.597873 9.4031 0.750651 9.25033L8.16732 1.83366H1.83398C1.59787 1.83366 1.39996 1.7538 1.24023 1.59408C1.08051 1.43435 1.00065 1.23644 1.00065 1.00033C1.00065 0.764214 1.08051 0.566298 1.24023 0.406576C1.39996 0.246853 1.59787 0.166992 1.83398 0.166992H10.1673C10.4034 0.166992 10.6013 0.246853 10.7611 0.406576C10.9208 0.566298 11.0007 0.764214 11.0007 1.00033V9.33366C11.0007 9.56977 10.9208 9.76769 10.7611 9.92741C10.6013 10.0871 10.4034 10.167 10.1673 10.167C9.93121 10.167 9.73329 10.0871 9.57357 9.92741C9.41385 9.76769 9.33398 9.56977 9.33398 9.33366V3.00033Z" fill="#A07C06"></path>
            </svg>
        </a>
    </div>
</div>
<div class="card_container__tzKfr" style="background-color: rgb(173, 216, 230);margin-bottom: 20px; width: 80%; text-align: center;">
         <h4 class="card_titulo__5BA46" style="color: rgb(0,0,0);">Ecocardiograma com doppler</h4>
             <p class="card_descricao__3npdI" style="color: rgb(0,0,0);">Faça seus exames com segurança</p>
        <div class="card_botaoContainer__6oHFk">
            <a href="<?php echo $isLoggedIn ? $redirectLoggedIn : $redirectNotLoggedIn; ?>" class="btn card_botao__gBtjG"> 
            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path d="M9.33398 3.00033L1.91732 10.417C1.76454 10.5698 1.5701 10.6462 1.33398 10.6462C1.09787 10.6462 0.903429 10.5698 0.750651 10.417C0.597873 10.2642 0.521484 10.0698 0.521484 9.83366C0.521484 9.59755 0.597873 9.4031 0.750651 9.25033L8.16732 1.83366H1.83398C1.59787 1.83366 1.39996 1.7538 1.24023 1.59408C1.08051 1.43435 1.00065 1.23644 1.00065 1.00033C1.00065 0.764214 1.08051 0.566298 1.24023 0.406576C1.39996 0.246853 1.59787 0.166992 1.83398 0.166992H10.1673C10.4034 0.166992 10.6013 0.246853 10.7611 0.406576C10.9208 0.566298 11.0007 0.764214 11.0007 1.00033V9.33366C11.0007 9.56977 10.9208 9.76769 10.7611 9.92741C10.6013 10.0871 10.4034 10.167 10.1673 10.167C9.93121 10.167 9.73329 10.0871 9.57357 9.92741C9.41385 9.76769 9.33398 9.56977 9.33398 9.33366V3.00033Z" fill="#A07C06"></path>
            </svg>
            </a>
        </div>
</div>
<div class="card_container__tzKfr" style="background-color: rgb(173, 216, 230);margin-bottom: 20px; width: 80%; text-align: center;">
            <h4 class="card_titulo__5BA46" style="color: rgb(0,0,0);">Ultrassom do abdômen</h4>
             <p class="card_descricao__3npdI" style="color: rgb(0,0,0);">Faça seu exame especializado aqui</p>
            <div class="card_botaoContainer__6oHFk">
            <a href="<?php echo $isLoggedIn ? $redirectLoggedIn : $redirectNotLoggedIn; ?>" class="btn card_botao__gBtjG"> 
            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path d="M9.33398 3.00033L1.91732 10.417C1.76454 10.5698 1.5701 10.6462 1.33398 10.6462C1.09787 10.6462 0.903429 10.5698 0.750651 10.417C0.597873 10.2642 0.521484 10.0698 0.521484 9.83366C0.521484 9.59755 0.597873 9.4031 0.750651 9.25033L8.16732 1.83366H1.83398C1.59787 1.83366 1.39996 1.7538 1.24023 1.59408C1.08051 1.43435 1.00065 1.23644 1.00065 1.00033C1.00065 0.764214 1.08051 0.566298 1.24023 0.406576C1.39996 0.246853 1.59787 0.166992 1.83398 0.166992H10.1673C10.4034 0.166992 10.6013 0.246853 10.7611 0.406576C10.9208 0.566298 11.0007 0.764214 11.0007 1.00033V9.33366C11.0007 9.56977 10.9208 9.76769 10.7611 9.92741C10.6013 10.0871 10.4034 10.167 10.1673 10.167C9.93121 10.167 9.73329 10.0871 9.57357 9.92741C9.41385 9.76769 9.33398 9.56977 9.33398 9.33366V3.00033Z" fill="#A07C06"></path>
            </svg>
        </a>
    </div>
</div>
 <div class="card_container__tzKfr" style="background-color: rgb(173, 216, 230);margin-bottom: 20px; width: 80%; text-align: center;">
            <h4 class="card_titulo__5BA46" style="color: rgb(0,0,0);">Endoscopia</h4>
             <p class="card_descricao__3npdI" style="color: rgb(0,0,0);">Atendimento rápido e humanizado</p>
            <div class="card_botaoContainer__6oHFk">
            <a href="<?php echo $isLoggedIn ? $redirectLoggedIn : $redirectNotLoggedIn; ?>" class="btn card_botao__gBtjG"> 
            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path d="M9.33398 3.00033L1.91732 10.417C1.76454 10.5698 1.5701 10.6462 1.33398 10.6462C1.09787 10.6462 0.903429 10.5698 0.750651 10.417C0.597873 10.2642 0.521484 10.0698 0.521484 9.83366C0.521484 9.59755 0.597873 9.4031 0.750651 9.25033L8.16732 1.83366H1.83398C1.59787 1.83366 1.39996 1.7538 1.24023 1.59408C1.08051 1.43435 1.00065 1.23644 1.00065 1.00033C1.00065 0.764214 1.08051 0.566298 1.24023 0.406576C1.39996 0.246853 1.59787 0.166992 1.83398 0.166992H10.1673C10.4034 0.166992 10.6013 0.246853 10.7611 0.406576C10.9208 0.566298 11.0007 0.764214 11.0007 1.00033V9.33366C11.0007 9.56977 10.9208 9.76769 10.7611 9.92741C10.6013 10.0871 10.4034 10.167 10.1673 10.167C9.93121 10.167 9.73329 10.0871 9.57357 9.92741C9.41385 9.76769 9.33398 9.56977 9.33398 9.33366V3.00033Z" fill="#A07C06"></path>
            </svg>
            </a>
            </div>
        </div>
    </div>
 </div>
</section>

</body>
<?php include 'components/footer.php'?>