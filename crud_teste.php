<?php

class Crud_Teste
{
    private $pdo;

    public function __construct()
    {
        $banco = "crud_teste";
        $localhost = "localhost";
        $usuario = "root";
        $senha = "";
        try{
            $this->pdo=new PDO("mysql:dbname=".$banco.";host=".$localhost,$usuario,$senha);
        }
        catch (PDOException $e)
        {
            echo "Erro no Banco de Dados" ;$e ->getMessage();            
        }
        catch (Exception $e)
        {
            echo "Erro na Programação" ;$e ->getMessage();            
        }        

    }
    public function cadastrarContainer ($cliente_container,$num_container,$tipo_container,$status_container,$categoria_container)
    {
        $cmd = $this->pdo ->prepare ("INSERT INTO tbl_container (cliente_container,num_container,tipo_container,status_container_categoria_container) VALUES (:cliente_container,:num_container,:tipo_container,:status_container,:categoria_container)");
        $cmd -> bindValue(':cliente_container',$cliente_container);
        $cmd -> bindValue(':num_container',$num_container);
        $cmd -> bindValue(':tipo_container',$tipo_container);
        $cmd -> bindValue(':status_container',$status_container);
        $cmd -> bindValue(':categoria_container',$categoria_container);
        $cmd ->execute();
        return true;
    }
    public function cadastrarMovimento($num_container_mov, $tipo_mov, $data_inicio_mov, $data_fim_mov)
    {
        $cmd = $this->pdo->prepare("INSERT INTO tbl_mov (num_container,tipo_mov,data_inicio_mov,data_fim_mov) VALUES (:num_container_mov,:tipo_mov,:data_inicio_mov,:data_termino_mov)");
        $cmd->bindValue(':num_container_mov', $num_container_mov);
        $cmd->bindValue(':tipo_mov', $tipo_mov);
        $cmd->bindValue(':data_inicio_mov', $data_inicio_mov);
        $cmd->bindValue(':data_fim_mov', $data_fim_mov);
        $cmd->execute();
        return true;
    }
    public function listarContainers()
    {
        $listagem_container = array();
        $cmd = $this ->pdo ->query("SELECT * FROM tbl_container");
        $listagem_container = $cmd -> fetchAll(PDO::FETCH_ASSOC);
        return $listagem_container;
    }
    public function listarMovimentos()
    {
        $listagem_mov = array();
        $cmd = $this ->pdo ->query("SELECT * FROM tbl_mov");
        $listagem_mov = $cmd -> fetchAll(PDO::FETCH_ASSOC);
        return $listagem_mov;
    }
    public function listarContainer($id_container)
    {
        $listar_container = array();
        $cmd = $this ->pdo ->prepare("SELECT * FROM tbl_container WHERE id_container = :id_container");
        $cmd -> bindValue(':id_container',$id_container);
        $cmd ->execute();
        $listar_container = $cmd -> fetch(PDO::FETCH_ASSOC);
        return $listar_container;
    }
    public function listarMovimento($id_mov)
    {
        $listar_mov = array();
        $cmd = $this ->pdo ->prepare("SELECT * FROM tbl_mov WHERE id_mov = :id_mov");
        $cmd -> bindValue(':id_mov',$id_mov);
        $cmd ->execute();
        $listar_mov = $cmd -> fetch(PDO::FETCH_ASSOC);
        return $listar_mov;
    }
    public function atualizarContainer ($id_container,$cliente_container,$num_container,$tipo_container,$status_container,$categoria_container)
    {
        $cmd = $this->pdo ->prepare ("UPDATE tbm_container SET cliente_container = :cliente_container,num_container = :num_container, tipo_container = :tipo_container, status_container = :status_container, categoria_container = :categoria_container WHERE id_container = $id_container");
        $cmd -> bindValue(':id_container',$id_container);
        $cmd -> bindValue(':cliente_container',$cliente_container);
        $cmd -> bindValue(':num_container',$num_container);
        $cmd -> bindValue(':tipo_container',$tipo_container);
        $cmd -> bindValue(':status_container',$status_container);
        $cmd -> bindValue(':categoria_container',$categoria_container);
        $cmd ->execute();
        return true;
    }
    public function atualizarMovimento ($id_mov,$num_container_mov,$tipo_mov,$data_inicio_mov,$data_fim_mov)
    {
        $cmd = $this->pdo ->prepare ("UPDATE tbl_mov SET num_container = :num_container,tipo_mov = :tipo_mov,data_inicio_mov = :data_inicio_mov,data_fim_mov = :data_fim_mov");        
        $cmd -> bindValue(':id_mov',$id_mov);
        $cmd -> bindValue(':num_container_mov',$num_container_mov);
        $cmd -> bindValue(':tipo_mov',$tipo_mov);
        $cmd -> bindValue(':data_inicio_mov',$data_inicio_mov);
        $cmd -> bindValue(':data_fim_mov',$data_fim_mov);
        $cmd ->execute();
        return true;
    }
    public function deletarContainer ($id_mov, $id_container)
    {
        $cmddel = $this->pdo->prepare("SELECT * FROM tbl_mov WHERE id_mov = :id_mov");
        $cmddel -> bindValue(':id_mov',$id_mov);
        $cmddel ->execute();
        if ($cmddel >= 0){
            return false;
        }
        else
        {
            $cmd = $this->pdo->prepare("DELETE FROM tbl_container WHERE id_container = :id_container");
            $cmd -> bindValue(':id_container',$id_container);
            $cmd ->execute();
            return true;
        }        
    }
    public function deletarMov ($id_mov_del)
    {
        $cmd = $this->pdo->prepare("DELETE FROM tbl_mov WHERE id_mov = :id_mov");
        $cmd -> bindValue(':id_mov',$id_mov_del);
        $cmd ->execute();
        return true;
    }
}
?>