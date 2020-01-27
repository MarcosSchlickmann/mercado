<?php
class VendaModel
{
	protected $db;

	public function __construct(PDO $db){
		$this->db = $db;
	}

	public function getAllVendas(){
		return $this->db->query('
			SELECT 
				vendas.*
			FROM vendas 
			ORDER BY vendas.id DESC
			');
	}

	public function getAllVendaProdutos($venda_id){
		return $this->db->query("
			SELECT 
				produtos.*,
				vendas_produtos.quantidade,
				tipos.imposto
			FROM produtos 
			LEFT JOIN vendas_produtos ON produtos.id = vendas_produtos.produto_id 
			LEFT JOIN tipos ON produtos.tipo_id = tipos.id 
			WHERE vendas_produtos.venda_id = " . $venda_id . "
			");
	}

	public function cadastrarVenda($venda){
		$insercao = $this->db->prepare("UPDATE vendas SET imposto_total=?, total=? WHERE vendas.id=?");
		$insercao->execute([$venda['imposto_total'], $venda['total'], $venda['id']]);
		return $insercao->errorInfo();
	}

	public function iniciarVenda(){
		$insercao = $this->db->prepare("
			INSERT INTO vendas (
				data_criacao, 
				imposto_total, 
				total
			) VALUES (
				'" . date('Y-m-d H:i:s') . "',
				0,
				0
			)
		");
		if($insercao->execute()){
			return $this->db->lastInsertId('vendas_id_seq');
		}
		return $insercao->errorInfo();	
	}

	public function adicionarProduto($produto){
		$insercao = $this->db->prepare("
			INSERT INTO vendas_produtos (
				venda_id, 
				produto_id, 
				quantidade 
			) VALUES (
				" . $produto['venda_id'] . ",
				" . $produto['produto_id'] . ",
				" . $produto['quantidade'] . "
			)
		");
		$insercao->execute();
		return $insercao->errorInfo();
	}

	public function removerVenda($id){
		$remocao_vendas_produtos = $this->db->prepare("DELETE FROM vendas_produtos WHERE vendas_produtos.venda_id = ?");
		if(!$remocao_vendas_produtos->execute([$id]))
			return $remocao_vendas_produtos->errorInfo();

		$remocao_vendas = $this->db->prepare("DELETE FROM vendas WHERE id = ?");
		$remocao_vendas->execute([$id]);
		
		if(!$remocao_vendas->execute([$id]))
			return $remocao_vendas->errorInfo();

		return true;
	}
}