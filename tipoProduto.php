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

$tipoProduto = new TipoProdutoModel($db);
$listaTiposProduto = $tipoProduto->getAllTiposProduto();

$templates = new League\Plates\Engine('templates');
echo $templates->render('tipo_produto/tipo_produto', [
	'listaTiposProduto' => $listaTiposProduto
]);
?>