<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['usu_id']); 
$username = $isLoggedIn ? $_SESSION['cid_nome'] : ''; 
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand fs-4 fw-bold" href="/">SIAS</a> 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Links de navegação -->
      <ul class="navbar-nav me-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Usuário
            </a>
            <ul class="dropdown-menu" aria-labelledby="usuarioDropdown">
                <li><a class="dropdown-item" href="/model/login/atualizar-usuario.php">Alterar Dados Cadastrais</a></li>
                <li><a class="dropdown-item" href="/model/login/alterar-senha.php">Alterar Senha</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/model/login/excluir-usuario.php">Excluir Usuário</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pacienteDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Paciente
            </a>
            <ul class="dropdown-menu" aria-labelledby="pacienteDropdown">
                <li><a class="dropdown-item" href="/model/paciente/index.php">Paciente</a></li>
                <li><a class="dropdown-item" href="#">Meus Planos de Saúde</a></li>
                <li><a class="dropdown-item" href="#">Meus Prontuários Clínicos</a></li>
                <li><a class="dropdown-item" href="#">Avaliar minhas consultas</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="profissionalDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Profissional da Saúde
            </a>
            <ul class="dropdown-menu" aria-labelledby="profissionalDropdown">
                <li><a class="dropdown-item" href="/model/profissional/cadastrar.php">Cadastrar Profissional</a></li>
                <li><a class="dropdown-item" href="/model/profissional/lista.php">Lista de Profissionais</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/model/agendar/especialistas.php">Agendamento e consulta</a> 
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/model/plano-de-saude/">Plano de Saúde</a> 
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/model/especialidade/">Especialidade</a> 
        </li>
    </ul>
      
      <?php if ($isLoggedIn): ?>
          <span class="navbar-text ms-2">Bem-vindo, <?php echo htmlspecialchars($username); ?>!</span>
          <a href="/controller/login/controller-desconectar-login.php" class="btn btn-outline-danger ms-2">Sair</a>
      <?php else: ?>
          <a href="/model/login/"><button class="btn btn-outline-primary ms-2">Entrar</button></a>
      <?php endif; ?>
    </div>
  </div>
</nav>
