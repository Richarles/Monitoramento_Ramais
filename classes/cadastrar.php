<?php
   require_once '../BancoDeDados/bd.php';
   require_once '../Repositories/crud.php';

   foreach ($_POST as $key => $value) {
      $obj = new Crud();

      $sql="SELECT id FROM ramal WHERE numero = :numero";
      $stmt=Banco::prepare($sql);
      $stmt->bindParam(':numero',$value['nome'],PDO::PARAM_INT);
      $stmt->execute();
         
      $id = $stmt->fetchAll();
            
      if ($stmt->rowCount() > 0 ) {
         echo 'Dados já cadastrados';
         
         $obj->Editar($value);
            
         continue;
      }
      $obj->cadastrar($value);

   }
?>