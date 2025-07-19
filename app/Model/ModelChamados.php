<?php

class ModelChamados
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = new PDO("pgsql:host=localhost;dbname=chamados", "postgres", "admin");
  }

  //Listagem de Chamados
  public function listarChamados()
  {
    $stmt = $this->pdo->prepare("SELECT * FROM chamado ORDER BY id DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  //Criar chamado
  public function criarChamado($titulo, $descricao)
  {
    $stmt = $this->pdo->prepare("
    INSERT INTO chamado (titulo, descricao, status)
    VALUES (:titulo, :descricao, 1)'
  ");
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->execute();
  }

  //Busca chamado por ID
  public function buscarPorId($id)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM chamado WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function executarChamado($id)
  {
    $stmt = $this->pdo->prepare("UPDATE chamado SET status = 2 WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
  }


  public function concluirChamado($id)
  {
    $stmt = $this->pdo->prepare("UPDATE chamado SET status = 3 WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
  }


  public function excluirChamado($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM chamado WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
  }

}
