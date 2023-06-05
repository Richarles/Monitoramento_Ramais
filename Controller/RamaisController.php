<?php
  header("Content-type: application/json; charset=utf-8");

  require_once '../service/RamaisService.php';
  require_once '../BancoDeDados/config.php';
  require_once '../BancoDeDados/bd.php';

  $obj = new Ramais();
  echo $obj->ramais();


 ?>