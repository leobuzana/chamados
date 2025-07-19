<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Detalhes do Chamado</title>
    <link rel="stylesheet" href="/Project/public/css/estilo.css" />
</head>

<body>
    <header>
        <a href="/Project/home.html" class="home-icon" title="Início">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                <path d="M3 11.5L12 4L21 11.5V20A1.5 1.5 0 0 1 19.5 21.5H4.5A1.5 1.5 0 0 1 3 20V11.5Z" stroke="#fff"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9 21V14H15V21" stroke="#fff" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        <h1>Detalhes do Chamado #<?= $chamado['id'] ?></h1>
        <a class="action-btn btn-small" href="index.php?controller=chamados&action=index">Voltar</a>
    </header>

    <div class='container'>
        <section>
            <h2>Informações do Chamado</h2>
            <p><strong>Título:</strong> <?= htmlspecialchars($chamado['titulo']) ?></p>
            <p><strong>Descrição:</strong> <?= nl2br(htmlspecialchars($chamado['descricao'])) ?></p>
            <p><strong>Situação:</strong>
                <?php
                echo match ((int) $chamado['status']) {
                    1 => 'Aberto',
                    2 => 'Em Andamento',
                    3 => 'Finalizado'
                };
                ?>
            </p>
            <?php if ($chamado['status'] == 1): // Exibir apenas se tiver em aberto ?>
                <form method="POST" action="index.php?controller=chamados&action=executar&id=<?= $chamado['id'] ?>">
                    <button type="submit">Executar Chamado</button>
                </form>
            <?php endif; ?>
            <?php if ($chamado['status'] == 2): // Exibir apenas se tiver em andamento ?>
                <form method="POST" action="index.php?controller=chamados&action=concluir&id=<?= $chamado['id'] ?>">
                    <button type="submit">Concluir Chamado</button>
                </form>
            <?php endif; ?>
        </section>
    </div>
    <section>
        <h2>Tarefas Relacionadas</h2>
        <?php if (!empty($tarefas)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Responsável</th>
                        <th>Status</th>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Este chamado ainda não possui tarefas.</p>
        <?php endif; ?>
    </section>
</body>

</html>