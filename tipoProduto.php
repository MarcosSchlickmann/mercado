<?php
include 'loadenv.php';
$db = new PDO( 
	env('DB_CONNECTION') 
	. ':host=' . env('DB_HOST') 
	. ';dbname=' . env('DB_NAME') . ';', 
	env('DB_USERNAME'), 
	env('DB_PASSWORD'));

require 'vendor/autoload.php';
include 'models/TipoProdutoModel.php';


$templates = new League\Plates\Engine('templates');

$tipoProduto = new TipoProdutoModel($db);

if(isset($_GET['acao']) && $_GET['acao'] == 'cadastrar'){
	if(!$_POST){
		echo $templates->render('tipo_produto/cadastrar_tipo_produto');
	}elseif($tipoProduto->cadastrarTipoProduto($_POST)){
		$listaTiposProduto = $tipoProduto->getAllTiposProduto();
		echo $templates->render('tipo_produto/listar_tipo_produto', [
			'listaTiposProduto' => $listaTiposProduto
		]);
	}
}

if(isset($_GET['acao']) && $_GET['acao'] == 'remover' && $_POST['id']){
	if($tipoProduto->removerTipoProduto($_POST['id'])){
		$listaTiposProduto = $tipoProduto->getAllTiposProduto();
		echo $templates->render('tipo_produto/listar_tipo_produto', [
			'listaTiposProduto' => $listaTiposProduto
		]);	
	}
}

if(!isset($_GET['acao'])){
	$listaTiposProduto = $tipoProduto->getAllTiposProduto();
	echo $templates->render('tipo_produto/listar_tipo_produto', [
		'listaTiposProduto' => $listaTiposProduto
	]);
}
?>