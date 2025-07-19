<?php
require_once 'app/Model/ModelTarefas.php';

class ControllerTarefas
{
    public function index()
    {
        $idChamado = $_GET['id_chamado'] ?? null;

        if ($idChamado) {
            $model = new ModelTarefas();
            $tarefas = $model->listarPorChamado($idChamado);
            require 'app/View/Tarefas/tarefas.php';
        } else {
            echo "ID do chamado não informado.";
        }
    }

    //Função para criar tarefa
    public function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = trim($_POST['descricao'] ?? '');
            $responsavel = trim($_POST['nome_responsavel'] ?? '');
            $idChamado = $_POST['id_chamado'] ?? null;

            if ($descricao !== '' && $responsavel !== '' && $idChamado !== null && $idChamado !== '') {
                $model = new ModelTarefas();
                $model->salvarTarefa($descricao, $responsavel, $idChamado);

                header("Location: index.php?controller=tarefas&action=index&id_chamado=$idChamado");
                exit;
            } else {
                echo "Todos os campos são obrigatórios.";
            }
        } else {
            echo "Requisição inválida.";
        }
    }


    //Função para alterar status da tarefa
    public function alterarStatus()
    {
        $id = $_GET['id'] ?? null;
        $idChamado = $_GET['id_chamado'] ?? null;

        if ($id) {
            $model = new ModelTarefas();
            $model->avancarStatus($id);
        }

        header("Location: index.php?controller=tarefas&action=index&id_chamado=$idChamado");
        exit;
    }

    //Função para chamar tela de Editar Tarefa
    public function editar()
    {
        $id = $_GET['id'] ?? null;
        $idChamado = $_GET['id_chamado'] ?? null;

        if ($id) {
            $model = new ModelTarefas();
            $tarefa = $model->buscarPorId($id);

            if ($tarefa) {
                require 'app/View/Tarefas/editar_tarefa.php';
            } else {
                echo "Tarefa não encontrada.";
            }
        } else {
            echo "ID da tarefa não informado.";
        }
    }

    //Função para alterar tarefa
    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $descricao = $_POST['descricao'];
            $responsavel = $_POST['nome_responsavel'];
            $status = $_POST['status'];
            $idChamado = $_POST['id_chamado'];

            $model = new ModelTarefas();
            $model->atualizarTarefa($id, $descricao, $responsavel, $status);

            header("Location: index.php?controller=tarefas&action=index&id_chamado=$idChamado");
            exit;
        } else {
            echo "Requisição inválida.";
        }
    }
    public function excluir()
    {
        $id = $_GET['id'] ?? null;
        $idChamado = $_GET['id_chamado'] ?? null;

        if ($id) {
            $model = new ModelTarefas();
            $model->excluirTarefa($id);

            // Voltar para a lista de tarefas do chamado
            header("Location: index.php?controller=tarefas&action=index&id_chamado=$idChamado");
            exit;
        } else {
            echo "ID da tarefa não informado.";
        }
    }

}
