<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Gerenciamento de Chamados</title>
  <link rel="stylesheet" href="/Project/public/css/estilo.css">
</head>

<body>
  <header>
    <a href="/Project/home.html" class="home-icon" title="Início">
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
        <path d="M3 11.5L12 4L21 11.5V20A1.5 1.5 0 0 1 19.5 21.5H4.5A1.5 1.5 0 0 1 3 20V11.5Z" stroke="#fff"
          stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M9 21V14H15V21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </a>
    <h1>Gerenciamento de Chamados</h1>
  </header>

  <div class="container">
    <section id="abrir-chamado">
      <h2>Abrir Novo Chamado</h2>
      <form id="form-chamado" method="POST" action="index.php?controller=chamados&action=salvar">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" required />

        <label for="descricao">Descrição do Problema</label>
        <textarea id="descricao" name="descricao" required></textarea>

        <button type="submit" class="action-btn">Abrir Chamado</button>
      </form>
    </section>
  </div>

  <footer>
    <p>&copy; 2025 - Leonardo Sandner Buzana</p>
  </footer>

  <script src="../../fontend/js/script.js"></script>
</body>

</html>