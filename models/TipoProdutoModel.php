<?php
class TipoProdutoModel
{
	protected $db;

	public function __construct(PDO $db){
		$this->db = $db;
	}

	public function getAllTiposProduto(){
		return $this->db->query('SELECT * FROM tipos');
	}

	public function cadastrarTipoProduto($tipoProduto){
		$insercao = $this->db->prepare("INSERT INTO tipos (nome, imposto) VALUES (:nome, :imposto)");
		$insercao->bindParam(':nome', $nome);
		$insercao->bindParam(':imposto', $imposto);

		// insert one row
		$nome = $tipoProduto['nome'];
		$imposto = $tipoProduto['imposto'];
		return $insercao->execute();
	}

	public function removerTipoProduto($id){
		$remocao = $this->db->prepare("DELETE FROM tipos  WHERE id = :id");
		$remocao->bindParam(':id', $id);
		$id = $id;
		$remocao->execute();	
		return $remocao->errorInfo();
	}
}