<?php

class Crud_Teste
{	
	private $pdo;
	//CONEXAO COM O BANCO DE DADOS
	public function __construct()
	{
		$dbname  = "crud_teste";
		$host = "localhost";
		$user = "root";
		$pass = "";
		try {
			$this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $pass);
		} catch (PDOException $e) {
			echo 'ERRO RELACIONADO AO BANCO DE DADOS: ' . $e->getMessage();
			exit();
		} catch (Exception $e) {
			echo 'ERRO RELACIONADO A PROGRAMAÇÃO: ' . $e->getMessage();
		}
	}

	//CADASTRAR CONTAINER.
	public function cadastrarContainer(
		$cliente_container,
		$num_container,
		$tipo_container,
		$status_container,
		$categoria_container
	) {
		$cmd = $this->pdo->prepare("INSERT INTO tbl_container (
				cliente_container, 
				num_container,
				tipo_container,
				status_container,
				categoria_container
				) 
				VALUES
				(:cliente,
				:numero,
				:tipo,
				:stat,
				:categoria)");
		$cmd->bindValue(':cliente', $cliente_container);
		$cmd->bindValue(':numero',$num_container);
		$cmd->bindValue(':tipo', $tipo_container);
		$cmd->bindValue(':stat', $status_container);
		$cmd->bindValue(':categoria', $categoria_container);
		$cmd->execute();
		return true;
	}

	//CADASTRAR MOVIMENTAÇÃO DE CONTAINER
	public function cadastrarMovimento(		
		$num_container_mov,
		$tipo_mov,
		$dt_inicio_mov,
		$dt_fim_mov
	) {
		$cmd = $this->pdo->prepare("INSERT INTO tbl_mov (
			num_container,
			tipo_mov,
			data_inicio_mov,
			data_termino_mov
			)
			VALUES 
			(:numero, 
			:tipo, 
			:dt_inicio,
			:dt_fim)");	
		$cmd->bindValue(':numero', $num_container_mov);
		$cmd->bindValue(':tipo', $tipo_mov);
		$cmd->bindValue(':dt_inicio', $dt_inicio_mov);
		$cmd->bindValue(':dt_fim',$dt_fim_mov);
		$cmd->execute();
		return true;
		echo "<div>passei aqui</div>";
	}

	//SELECIONAR TODOS OS REGISTROS DE CONTAINERS
	public function buscarContainers()
	{
		$res = array();
		$cmd = $this->pdo->query("SELECT * FROM tbl_container ORDER BY num_container DESC");
		$res = $cmd->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	//SELECIONAR TODOS OS REGISTROS DE MOVIMENTAÇÕES
	public function buscarMovimentos()
	{
		$res = array();
		$cmd = $this->pdo->query("SELECT * FROM tbl_mov ORDER BY data_inicio_mov DESC");
		$res = $cmd->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	//SELECIONAR UM CONTAINER ESPECIFICO
	public function buscarContainer($id_container)
	{
		$res = array();
		$cmd = $this->pdo->prepare("SELECT * FROM tbl_container WHERE id_container = :id_container");
		$cmd->bindValue(':id_container', $id_container);
		$cmd->execute();
		$res = $cmd->fetch(PDO::FETCH_ASSOC);
		return $res;
	}

	//SELECIONAR UMA MOVIMENTAÇÃO ESPECIFICA
	public function buscarMovimento($id_mov)
	{
		$res = array();
		$cmd = $this->pdo->prepare("SELECT * FROM tbl_mov WHERE id_mov = :id_mov");
		$cmd->bindValue(':id_mov', $id_mov);
		$cmd->execute();
		$res = $cmd->fetch(PDO::FETCH_ASSOC);
		return $res;		
	}
	//VERIFICAR MOVIMENTAÇÃO DE CONTAINER PARA ALTERAÇÃO NO CADASTRO DO CONTAINER
	private function verificarMovContainer($num_container)
	{
		$cmd = $this->pdo->prepare("SELECT id_mov FROM tbl_mov WHERE num_container = :numero");
		$cmd->bindValue(':numero', $num_container);		
		$cmd->execute();

		if ($cmd->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	//ATUALIZAR CONTAINER
	public function atualizarContainer(
		$id_container, 
		$cliente_container, 
		$num_container, 
		$tipo_container, 
		$status_container, 
		$categoria_container)
	{
		$cmd = $this->pdo->prepare("UPDATE tbl_container 
		SET 
		cliente_container = :cliente, 
		num_container = :num_container,		
		tipo_container = :tipo, 
		status_container = :stat, 
		categoria_container = :categ 
		WHERE id_container = :id_container");				
		$cmd->bindValue(':cliente', $cliente_container);		
		$cmd->bindValue(':num_container', $num_container);		
		$cmd->bindValue(':tipo', $tipo_container);
		$cmd->bindValue(':stat',$status_container);
		$cmd->bindValue(':categ',$categoria_container);			
		$cmd->bindValue(':id_container',$id_container);		
		$cmd->execute();
	}

	//ATUALIZAR MOVIMENTO
	public function atualizarMovimento($id_mov, $num_container_mov, $tipo_mov, $dt_inicio_mov, $dt_fim_mov)
	{
		$cmd = $this->pdo->prepare("UPDATE tbl_mov SET num_container = :numero, tipo= :tipo, data_inicio_mov = :dt_inicio_mov, data_termino_mov = :dt_fim_mov WHERE id_mov = :id_mov");
		$cmd->bindValue(':id_mov', $id_mov);
		$cmd->bindValue(':numero', $num_container_mov);
		$cmd->bindValue(':tipo', $tipo_mov);
		$cmd->bindValue(':dt_inicio_mov', $dt_inicio_mov);
		$cmd->bindValue(':dt_fim_mov', $dt_fim_mov);		
		$cmd->execute();
		
	}

	//EXCLUIR CONTAINER - ANTES VERIFICA SE EXISTE MOVIMENTAÇÃO PARA ESTE CONTAINER	
	public function excluirContainer($id_container,$num_container)
	{
		$cmd = $this->pdo->prepare("SELECT id_mov FROM tbl_mov WHERE num_container = :numero");		
		$cmd->bindValue(':numero', $num_container);		
		$cmd->execute();

		if ($cmd->rowCount() > 0) 
		{
			return false;			
		} 
		if ($cmd->rowCount() == 0)		
		{
			$cmd = $this->pdo->prepare("DELETE FROM tbl_container WHERE id_container = :id_container");
			$cmd->bindValue(':id_container', $id_container);			
			$cmd->execute();
			return true;			
		}
	}

	//EXCLUIR MOVIMENTAÇÃO DE CONTAINER
	public function excluirMovimento($id_mov_del)
	{
		$cmd = $this->pdo->prepare("DELETE FROM tbl_mov WHERE id_mov = :id_mov");
		$cmd->bindValue(':id_mov', $id_mov_del);
		$cmd->execute();
	}	
	
}