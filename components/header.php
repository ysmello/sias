<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand fs-4 fw-bold" href="#">SIAS</a> <!-- Tamanho maior e em negrito -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Links de navegação -->
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Início</a> <!-- Texto em negrito -->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/login/registro.php">Cadastro do Usuário</a> <!-- Texto em negrito -->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/profissional">Cadastro do Profissional da Saúde</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/agendar/especialistas.php">Agendamento e consulta</a> <!-- Texto em negrito -->
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
      <a href="/login"><button class="btn btn-outline-primary ms-2">Entrar</button></a>
    </div>
  </div>
</nav>
