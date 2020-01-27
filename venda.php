<?php
include 'loadenv.php';
$db = new PDO( 
	env('DB_CONNECTION') 
	. ':host=' . env('DB_HOST') 
	. ';dbname=' . env('DB_NAME') . ';', 
	env('DB_USERNAME'), 
	env('DB_PASSWORD'));

require 'vendor/autoload.php';
include 'models/VendaModel.php';
include 'models/ProdutoModel.php';
include 'models/TipoProdutoModel.php';


$templates = new League\Plates\Engine('templates');

$venda = new VendaModel($db);

if(isset($_POST['acao']) && $_POST['acao'] == 'adicionar_produto'){
	$formulario = $_POST;
	if(!$formulario['venda_id']){
		$formulario['venda_id'] = $venda->iniciarVenda();
	}
	$venda->adicionarProduto($formulario);
	$listaVendaProdutos = $venda->getAllVendaProdutos($formulario['venda_id']);
	
	$calculo = 0;
	$total = 0;
	$imposto_total = 0;
	$desc = '';
	foreach ($venda->getAllVendaProdutos($formulario['venda_id']) as $row) {
		$calculo = $row['preco'] * $row['quantidade'];
		$total += $calculo;
		$imposto_total += ($calculo * ($row['imposto'] / 100));
	}


	$produtos = new ProdutoModel($db);
	$listaProdutos = $produtos->getAllProdutos();
	echo $templates->render('venda/cadastrar_venda', [
		'listaProdutos' => $listaProdutos,
		'listaVendaProdutos' => $listaVendaProdutos,
		'venda_id' => $formulario['venda_id'],
		'total' => $total,
		'imposto_total' => $imposto_total,
		'desc' => $desc
	]);
	exit;
}

if(isset($_GET['acao']) && $_GET['acao'] == 'cadastrar'){
	if(!$_POST){
		$produtos = new ProdutoModel($db);
		$listaProdutos = $produtos->getAllProdutos();
		echo $templates->render('venda/cadastrar_venda', [
			'listaProdutos' => $listaProdutos,
			'venda_id' => '',
			'total' => 0,
			'imposto_total' => 0
		]);
	}else{
		$cadastrou = $venda->cadastrarVenda($_POST);
		if(!$cadastrou){
			print_r($cadastrou);
		}else{
			header('location: ' . $_SERVER['PHP_SELF']);
		}
	}
}

if(isset($_GET['acao']) && $_GET['acao'] == 'remover' && $_POST['id']){
	$removeu = $venda->removerVenda($_POST['id']);
	if($removeu){
		header('location: ' . $_SERVER['PHP_SELF']);
	}
}

if(!isset($_GET['acao'])){
	$listaVendas = $venda->getAllVendas();
	echo $templates->render('venda/listar_vendas', [
		'listaVendas' => $listaVendas
	]);
}
?>