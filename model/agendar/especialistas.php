<?php
    include '../../config/database.php';

    $stmt = $conn->prepare("SELECT c.cid_nome AS prof_nome, p.prof_especialidade AS prof_esp, prof_id FROM profissional p 
                            JOIN usuario u ON p.usuario_usu_id = u.usu_id
                            JOIN cidadao c ON u.cidadao_cid_id = c.cid_id;");

    if (isset($_GET['especialidade'])) {
        $especialidade = $_GET['especialidade'];

        $stmt = $conn->prepare("SELECT c.cid_nome AS prof_nome, p.prof_especialidade AS prof_esp, prof_id FROM profissional p 
                                JOIN usuario u ON p.usuario_usu_id = u.usu_id
                                JOIN cidadao c ON u.cidadao_cid_id = c.cid_id
                                WHERE p.prof_especialidade LIKE :busca;");
        
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <?php include '../../components/header.php'; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row pt-4 pb-4">
                <form class="d-flex" method="GET">
                    <input class="form-control me-2" type="text" name="especialidade" placeholder="Buscar por profissionais" aria-label="from-select">
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
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#horariosModal" 
                                    data-prof-id="<?php echo $especialista['prof_id'] ?>" 
                                    data-prof-nome="<?php echo $especialista['prof_nome'] ?>">Agendar Consulta</button>
                            </div>
                        </div>                         
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="horariosModal" tabindex="-1" aria-labelledby="horariosModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="horariosModalLabel">Horários Disponíveis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 id="profNome"></h6>
                    <label for="horarioSelect" class="form-label">Selecione um horário</label>
                        <select class="form-select" id="horarioSelect">
                            <option selected>Escolha um horário...</option>
                        </select>
                    <div class="mb-3">
                        <label for="data" class="form-label">Selecione a data</label>
                        <input type="date" class="form-control" id="data" min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Seu email">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="telefone" placeholder="Seu telefone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="agendarBtn">Agendar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $('#horariosModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var profId = button.data('prof-id');
            var profNome = button.data('prof-nome');
            var modal = $(this);
            modal.find('#profNome').text('Horários para ' + profNome);

            function gerarHorarios(horaInicial, horaFinal, intervalo) {
                const horarios = [];
                let horaAtual = new Date('1970-01-01T' + horaInicial);
                const horaLimite = new Date('1970-01-01T' + horaFinal);

                while (horaAtual <= horaLimite) {
                    const horaFormatada = horaAtual.toTimeString().slice(0, 5);
                    horarios.push(horaFormatada);
                    horaAtual.setMinutes(horaAtual.getMinutes() + intervalo);
                }
                return horarios;
            }

            $.ajax({
                url: 'get_horarios.php',
                method: 'GET',
                data: { prof_id: profId },
                success: function (data) {
                    var parsedData = JSON.parse(data)
                    
                    var horarioSelect = modal.find('#horarioSelect');
                    horarioSelect.empty();
                    horarioSelect.append('<option selected>Escolha um horário...</option>');
                    const horariosDisponiveis = gerarHorarios(parsedData.horarios.hora_inicio, parsedData.horarios.hora_fim, parsedData.horarios.intervalo);
                    console.log(horariosDisponiveis);
                    var horarioSelect = modal.find('#horarioSelect');

                    horariosDisponiveis.forEach(function(horario) {
                        horarioSelect.append('<option value="' + horario + '">' + horario + '</option>');
                    });
                }
            });
        });

        $('#agendarBtn').on('click', function() {
            var email = $('#email').val();
            var telefone = $('#telefone').val();
            console.log("Agendar com email: " + email + " e telefone: " + telefone);
        });
    </script>
</body>
</html>
