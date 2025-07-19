<?php
function conectar()
{
  return new PDO("pgsql:host=localhost;dbname=chamados", "postgres", "admin");
}