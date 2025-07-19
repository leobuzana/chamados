<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tarefas do Chamado</title>
  <link rel="stylesheet" href="/Project/public/css/estilo.css" />
</head>

<body>
  <header>
    <a href="/Project/home.html" class="home-icon" title="Início">
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
        <path d="M3 11.5L12 4L21 11.5V20A1.5 1.5 0 0 1 19.5 21.5H4.5A1.5 1.5 0 0 1 3 20V11.5Z" stroke="#fff"
          stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M9 21V14H15V21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </a></h2>
    <h1>Tarefas do Chamado #<?= htmlspecialchars($_GET['id_chamado'] ?? '') ?></h1>
    <a class="action-btn btn-small" href="index.php?controller=chamados&action=index">Voltar</a>
  </header>

  <div class='container'>
    <section>
      
      <h2>Nova Tarefa</h2>

      <form method="POST" action="index.php?controller=tarefas&action=salvar">
        <br>
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" id="descricao" required>
</br><br>
        <label for="nomeresponsavel">Responsável:</label>
        <input type="text" name="nome_responsavel" id="nome_responsavel" required>
</br><br>
        <input type="hidden" name="id_chamado" value="<?= htmlspecialchars($_GET['id_chamado'] ?? '') ?>">
</br><br>
        <button type="submit" class="action-btn btn-small">Adicionar Tarefa</button>
</br>
      </form>
    </section>
  </div>

  <section>
    <h2>Lista de Tarefas</h2>
    <?php if (!empty($tarefas)): ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Responsável</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tarefas as $tarefa): ?>
            <tr>
              <td><?= $tarefa['id'] ?></td>
              <td><?= htmlspecialchars($tarefa['descricao']) ?></td>
              <td><?= htmlspecialchars($tarefa['nome_responsavel']) ?></td>
              <td>
                <?php
                echo match ((int) $tarefa['status']) {
                  1 => 'Pendente',
                  2 => 'Fazendo',
                  3 => 'Concluída'
                };
                ?>
              </td>
              <td>
                <!-- Opção de mudar status fica disponível apenas se não estiver concluído -->
                <?php if ($tarefa['status'] < 3): ?>
                  <a
                    href="index.php?controller=tarefas&action=alterarStatus&id=<?= $tarefa['id'] ?>&id_chamado=<?= $tarefa['id_chamado'] ?>">Alterar
                    Status</a>
                <?php endif; ?>
                <a
                  href="index.php?controller=tarefas&action=editar&id=<?= $tarefa['id'] ?>&id_chamado=<?= $tarefa['id_chamado'] ?>">Editar</a>
                <a href="index.php?controller=tarefas&action=excluir&id=<?= $tarefa['id'] ?>&id_chamado=<?= $tarefa['id_chamado'] ?>"
                  onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');">Excluir</a>

              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>Não há tarefas para este chamado.</p>
    <?php endif; ?>
  </section>
</body>

</html>