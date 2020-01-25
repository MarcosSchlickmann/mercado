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
}