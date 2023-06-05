<?php
class Crud
{
    public function cadastrar($data) {
        $sql="INSERT INTO ramal (numero,nome,ip,status) 
        VALUES(:numero,:nome,:ip,:status)";
        $stmt=Banco::prepare($sql);
        $this->campos($stmt,$data);
        
        $stmt->execute();
    }

    public function Editar($data) {
        $sql="UPDATE ramal SET numero = :numero,nome = :nome,ip = :ip,status = :status WHERE numero = :numero "; 
        $stmt=Banco::prepare($sql);
        $this->campos($stmt,$data);
        
        $stmt->execute();
    }

    public function campos($stmt,$data) {
        $stmt->bindParam(':numero',$data['nome'],PDO::PARAM_INT);
        $stmt->bindParam(':nome',$data['call'],PDO::PARAM_STR);
        $stmt->bindParam(':ip',$data['ip'],PDO::PARAM_STR);
        $stmt->bindParam(':status',$data['status'],PDO::PARAM_STR);
    }
}
 ?>