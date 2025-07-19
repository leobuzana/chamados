<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Aplicação de Abertura de Chamados</title>
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

  <div class="list-container">
    <section id="listar-chamados">
      <div class="btn-wrapper">
        <a class="action-btn btn-small" href="index.php?controller=chamados&action=abrir">Abrir Chamado</a>
      </div>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($chamados as $chamado): ?>
            <tr>
              <td><?= $chamado['id'] ?></td>
              <td><?= htmlspecialchars($chamado['titulo']) ?></td>
              <td><?= htmlspecialchars($chamado['descricao']) ?></td>
              <td>
                <?php
                $status = (int) $chamado['status'];
                $statusTexto = match ($status) {
                  1 => 'Aberto',
                  2 => 'Em Andamento',
                  3 => 'Finalizado',
                };

                echo $statusTexto;
                ?>
              </td>
              <td>
                <a href="index.php?controller=tarefas&action=index&id_chamado=<?= $chamado['id'] ?>">Ver Tarefas</a>
                <a href="index.php?controller=chamados&action=visualizar&id=<?= $chamado['id'] ?>">Visualizar</a>
                <a href="index.php?controller=chamados&action=excluir&id=<?= $chamado['id'] ?>"
                  onclick="return confirm('Deseja realmente excluir este chamado?');">Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
  </div>
</body>

</html>