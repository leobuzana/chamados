<?php

class ModelTarefas
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("pgsql:host=localhost;dbname=chamados", "postgres", "admin");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //Criar tarefa
    public function salvarTarefa($descricao, $nomeresponsavel, $id_chamado)
    {
        $stmt = $this->pdo->prepare("
      INSERT INTO tarefas (descricao, nome_responsavel, status, id_chamado)
      VALUES (:descricao, :nomeresponsavel, 1, :id_chamado)
    ");
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':nomeresponsavel', $nomeresponsavel);
        $stmt->bindParam(':id_chamado', $id_chamado, PDO::PARAM_INT);
        $stmt->execute();
    }

    //Listar tarefas apenas do Chamado selecionado
    public function listarPorChamado($idChamado)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tarefas WHERE id_chamado = :id ORDER BY id DESC");
        $stmt->bindParam(':id', $idChamado, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarTarefas()
    {
        $stmt = $this->pdo->query("SELECT * FROM tarefas ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Muda status da tarefa/Apenas as que não estiverem como concluídas
    public function avancarStatus($id)
    {
        // Pega o status atual
        $stmt = $this->pdo->prepare("SELECT status FROM tarefas WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $statusAtual = $stmt->fetchColumn();

        if ($statusAtual !== false && $statusAtual < 3) {
            $novoStatus = $statusAtual + 1;
            $stmtUpdate = $this->pdo->prepare("UPDATE tarefas SET status = :novoStatus WHERE id = :id");
            $stmtUpdate->bindParam(':novoStatus', $novoStatus, PDO::PARAM_INT);
            $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtUpdate->execute();
        }
    }

    //Busca Tarefa pelo ID da mesma
    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tarefas WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Alterar tarefa
    public function atualizarTarefa($id, $descricao, $responsavel, $status)
    {
        $stmt = $this->pdo->prepare("
        UPDATE tarefas
        SET descricao = :descricao,
            nome_responsavel = :nome_responsavel,
            status = :status
        WHERE id = :id
    ");
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':nome_responsavel', $responsavel);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function excluirTarefa($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tarefas WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    //VERIFICA SE TEM TAREFAS VINCULADAS NO CHAMADO
    public function temTarefasVinculadas($idChamado)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM tarefas WHERE id_chamado = :id_chamado");
        $stmt->bindParam(':id_chamado', $idChamado, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] > 0;
    }

    //FUNÇÃO PARA VERIFICAR SE TODAS AS TAREFAS ESTAO COMPLETAS - PARA PODER CONCLUIR CHAMADO
    public function contarTarefasIncompletas($idChamado)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM tarefas WHERE id_chamado = :id AND status < 3");
        $stmt->bindParam(':id', $idChamado, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $resultado['total'];
    }



}
