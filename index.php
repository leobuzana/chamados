<?php
$controller = $_GET['controller'] ?? 'chamados';
$action = $_GET['action'] ?? 'index';

$controllerName = 'Controller' . ucfirst($controller);
$controllerFile = "app/Controller/{$controllerName}.php";

if (file_exists($controllerFile)) {
  require_once $controllerFile;

  if (class_exists($controllerName)) {
    $obj = new $controllerName();

    if (method_exists($obj, $action)) {
      $obj->$action();
    } else {
      echo "Ação '$action' não encontrada.";
    }
  } else {
    echo "Classe '$controllerName' não encontrada.";
  }
} else {
  echo "Controller '$controllerName' não encontrado.";
}
