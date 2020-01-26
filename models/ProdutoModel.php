<?php
class ProdutoModel
{
	protected $db;

	public function __construct(PDO $db){
		$this->db = $db;
	}

	public function getAllProdutos(){
		return $this->db->query('
			SELECT 
				produtos.id as produto_id,
				produtos.nome as produto_nome,
				produtos.preco as produto_preco,
				tipos.id as tipo_id,
				tipos.nome as tipo_nome,
				tipos.imposto as tipo_imposto
			FROM produtos LEFT JOIN tipos ON tipos.id = produtos.tipo_id
			');
	}

	public function cadastrarProduto($tipoProduto){
		$insercao = $this->db->prepare("INSERT INTO produtos (nome, preco, tipo_id) VALUES (:nome, :preco, :tipo_id)");
		$insercao->bindParam(':nome', $nome);
		$insercao->bindParam(':preco', $preco);
		$insercao->bindParam(':tipo_id', $tipo_id);

		// insert one row
		$nome = $tipoProduto['nome'];
		$preco = $tipoProduto['preco'];
		$tipo_id = $tipoProduto['tipo_id'];
		return $insercao->execute();
	}

	public function removerProduto($produto_id){
		$remocao = $this->db->prepare("DELETE FROM produtos WHERE id = :id");
		$remocao->bindParam(':id', $id);

		// insert one row
		$id = $produto_id;
		return $remocao->execute();	
	}
}