<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro de Profissional de Saúde</title>
</head>
<body class="container mt-5">

    <h2 class="text-center">Cadastro de Profissional de Saúde</h2>
    
    <div class="bg-white rounded p-4 shadow-sm mb-4">
        <div class="row mb-3">
            <div class="col">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" placeholder="Nome">
            </div>
            <div class="col">
                <label for="sobrenome" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="sobrenome" placeholder="Sobrenome">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" placeholder="CPF">
            </div>
            <div class="col">
                <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="dataNascimento">
            </div>
            <div class="col">
                <label for="conselho" class="form-label">Conselho Regional</label>
                <input type="text" class="form-control" id="conselho" placeholder="Conselho Regional">
            </div>
            <div class="col">
                <label for="uf" class="form-label">UF</label>
                <select class="form-select" id="uf">
                    <option selected>Escolha...</option>
                    <option value="SP">PR</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="prefixo" class="form-label">Prefixo</label>
                <select class="form-select" id="prefixo">
                    <option selected>+55</option>
                </select>
            </div>
            <div class="col">
                <label for="telefone" class="form-label">Número de Celular</label>
                <input type="text" class="form-control" id="telefone" placeholder="(DD) + Número">
            </div>
            <div class="col">
                <label for="cidade" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="cidade" placeholder="Cidade">
            </div>
            <div class="col">
                <label for="ufCidade" class="form-label">UF da Cidade</label>
                <input type="text" class="form-control" id="ufCidade" placeholder="UF">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email">
            </div>
        </div>
    </div>

    <div class="bg-white rounded p-4 shadow-sm mb-4">
        <div class="d-flex justify-content-between mb-3">
            <h5>Especialização</h5>
            <div>
                <button class="btn btn-secondary">Inserir</button>
                <button class="btn btn-secondary">Alterar</button>
                <button class="btn btn-secondary">Excluir</button>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Especialização</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cardiologista</td>
                </tr>
                <tr>
                    <td>Clínico Geral</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="bg-white rounded p-4 shadow-sm mb-4">
        <div class="d-flex justify-content-between mb-3">
            <h5>Clínicas</h5>
            <div>
                <button class="btn btn-secondary">Inserir</button>
                <button class="btn btn-secondary">Alterar</button>
                <button class="btn btn-secondary">Excluir</button>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Telefone</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Carel Clínica Médica</td>
                    <td>Rua Jacinto pinto, 123</td>
                    <td>Rebosta</td>
                    <td>PR</td>
                    <td>Curitiba</td>
                    <td>(41) 99999-0001</td>
                </tr>
                <tr>
                    <td>Clínica Perotta</td>
                    <td>Rua Camaro amarelo, 676</td>
                    <td>Sitio Louco</td>
                    <td>PR</td>
                    <td>Curitiba</td>
                    <td>(41) 98888-0002</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="bg-white rounded p-4 shadow-sm mb-4">
        <div class="d-flex justify-content-between mb-3">
            <h5>Planos de Saúde Associados</h5>
            <div>
                <button class="btn btn-secondary">Inserir</button>
                <button class="btn btn-secondary">Alterar</button>
                <button class="btn btn-secondary">Excluir</button>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">N° ANS</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Telefone</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>UNIMED</td>
                    <td>123456</td>
                    <td>12.345.678/0001-90</td>
                    <td>Ativo</td>
                    <td>(11) 4000-0000</td>
                </tr>
                <tr>
                    <td>AMIL</td>
                    <td>654321</td>
                    <td>98.765.432/0001-01</td>
                    <td>Ativo</td>
                    <td>(21) 3000-0000</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="bg-white rounded p-4 shadow-sm mb-4">
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="termos">
            <label class="form-check-label" for="termos">
                Eu aceito os termos e condições, e confirmo que li e entendi a política de privacidade.*
            </label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="normas">
            <label class="form-check-label" for="normas">
                Declaro estar ciente das normas profissionais que deve seguir e da necessidade de inclusão do(s) número de registro profissional e de especialidade (quando cabível).*
            </label>
        </div>
        <button type="submit" class="btn btn-secondary">Cadastrar-se</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>