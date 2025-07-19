<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="/Project/public/css/estilo.css">
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
        </a></h2>
        <h2>Editar Tarefa</h2>
        <a class="action-btn btn-small" href="index.php?controller=tarefas&action=index&id_chamado=<?= $chamado['id'] ?>">Voltar</a>
    </header>
    <div class="container">
        <section id="abrir-chamado">
            <form method="POST" action="index.php?controller=tarefas&action=atualizar">
                <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
                <input type="hidden" name="id_chamado" value="<?= $tarefa['id_chamado'] ?>">

                <br><label>Descrição:</label>
                <input type="text" name="descricao" value="<?= htmlspecialchars($tarefa['descricao']) ?>" required></br>

                <br><label>Responsável:</label>
                <input type="text" name="nome_responsavel" value="<?= htmlspecialchars($tarefa['nome_responsavel']) ?>"
                    required></br>

                <br><label>Status:</label>
                <select name="status">
                    <option value="1" <?= $tarefa['status'] == 1 ? 'selected' : '' ?>>Pendente</option>
                    <option value="2" <?= $tarefa['status'] == 2 ? 'selected' : '' ?>>Fazendo</option>
                    <option value="3" <?= $tarefa['status'] == 3 ? 'selected' : '' ?>>Concluída</option>
                </select></br>
            </form>

            <br><button type="submit" class="action-btn">Atualizar</button></br>
            </form>
        </section>
    </div>
</body>

</html>