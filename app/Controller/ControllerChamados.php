<?php
require_once 'app/Model/ModelChamados.php';
require_once 'app/Model/ModelTarefas.php';

class ControllerChamados
{
  public function index()
  {
    $chamadoModel = new ModelChamados();
    $chamados = $chamadoModel->listarChamados();

    require 'app/View/Chamados/chamados.php';
  }

  //Função para salvar chamado
  public function salvar()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $titulo = $_POST['titulo'] ?? '';
      $descricao = $_POST['descricao'] ?? '';

      if (!empty($titulo) && !empty($descricao)) {
        $model = new ModelChamados();
        $model->criarChamado($titulo, $descricao);

        header("Location: index.php?controller=chamados&action=index");
        exit;
      } else {
        echo "Por favor, preencha todos os campos.";
      }
    } else {
      echo "Método não permitido.";
    }
  }
  public function abrir()
  {
    require 'app/View/Chamados/abrircham.php';
  }

  //Função para chamar tela de visualização detalhada
  public function visualizar()
  {
    $id = $_GET['id'] ?? null;

    if ($id) {
      $chamadoModel = new ModelChamados();
      $tarefaModel = new ModelTarefas();

      $chamado = $chamadoModel->buscarPorId($id);
      $tarefas = $tarefaModel->listarPorChamado($id);

      if ($chamado) {
        require 'app/View/Chamados/visualizarcham.php';
      } else {
        echo "Chamado não encontrado.";
      }
    } else {
      echo "ID do chamado não informado.";
    }
  }

  public function executar()
  {
    $id = $_GET['id'] ?? null;

    if ($id) {
      $chamadoModel = new ModelChamados();
      $chamado = $chamadoModel->buscarPorId($id);

      if (!$chamado) {
        echo "Chamado não encontrado.";
        return;
      }

      if ((int) $chamado['status'] !== 1) {
        echo "⚠️ Este chamado já foi executado ou concluído.";
        return;
      }

      $chamadoModel->executarChamado($id);
      header("Location: index.php?controller=chamados&action=visualizar&id=$id");
      exit;
    } else {
      echo "ID do chamado não informado.";
    }
  }


  public function concluir()
  {
    $id = $_GET['id'] ?? null;

    if ($id) {
      $tarefaModel = new ModelTarefas();
      $chamadoModel = new ModelChamados();

      $tarefasIncompletas = $tarefaModel->contarTarefasIncompletas($id);
      $chamado = $chamadoModel->buscarPorId($id);

      if (!$chamado) {
        echo "Chamado não encontrado.";
        return;
      }

      if ((int) $chamado['status'] !== 2) {
        echo "Este chamado não está em andamento.";
        return;
      }

      if ($tarefasIncompletas == 0) {
        $chamadoModel->concluirChamado($id);
        header("Location: index.php?controller=chamados&action=visualizar&id=$id");
        exit;
      } else {
        echo "Não é possível concluir o chamado: ainda existem $tarefasIncompletas tarefa(s) pendente(s).";
        echo "<br><a href='index.php?controller=chamados&action=visualizar&id=$id'>← Voltar</a>";
      }
    } else {
      echo "ID do chamado não informado.";
    }
  }

  public function excluir()
  {
    $id = $_GET['id'] ?? null;

    if ($id) {
      $tarefaModel = new ModelTarefas();
      $temTarefas = $tarefaModel->temTarefasVinculadas($id);

      if ($temTarefas) {
        echo "<p>Não é possível excluir o chamado #$id: existem tarefas vinculadas a ele.</p>";
        echo "<a href='index.php?controller=chamados&action=index'>← Voltar</a>";
      } else {
        $chamadoModel = new ModelChamados();
        $chamadoModel->excluirChamado($id);
        header("Location: index.php?controller=chamados&action=index");
        exit;
      }
    } else {
      echo "ID do chamado não informado.";
    }
  }



}
