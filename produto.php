<?php
include 'loadenv.php';
$db = new PDO( 
	env('DB_CONNECTION') 
	. ':host=' . env('DB_HOST') 
	. ';dbname=' . env('DB_NAME') . ';', 
	env('DB_USERNAME'), 
	env('DB_PASSWORD'));

require 'vendor/autoload.php';
include 'models/ProdutoModel.php';
include 'models/TipoProdutoModel.php';


$templates = new League\Plates\Engine('templates');

$produto = new ProdutoModel($db);

if(isset($_GET['acao']) && $_GET['acao'] == 'cadastrar'){
	if(!$_POST){
		$tipoProduto = new TipoProdutoModel($db);
		$listaTiposProduto = $tipoProduto->getAllTiposProduto();
		echo $templates->render('produto/cadastrar_produto', [
			'listaTiposProduto' => $listaTiposProduto
		]);
	}else{
		$produto->cadastrarProduto($_POST);
		header('location: ' . $_SERVER['PHP_SELF']);
	}
}

if(isset($_GET['acao']) && $_GET['acao'] == 'remover' && $_POST['id']){
	echo "string1";
	$removeu = $produto->removerProduto($_POST['id']);
	echo "string2";
	if($removeu){
	echo "string3";
		header('location: ' . $_SERVER['PHP_SELF']);
	echo "string4";
	}
	echo "string5";
	print_r($removeu);
}

if(!isset($_GET['acao'])){
	$listaProdutos = $produto->getAllProdutos();
	echo $templates->render('produto/listar_produtos', [
		'listaProdutos' => $listaProdutos
	]);
}
?>