<?php $this->layout('template', ['title' => 'Vendas']) ?>
	
<div class="row justify-content-between">
    <div class="col">
      	<h3>Vendas</h3>
    </div>
    <div class="col-2">
		<a href="venda.php?acao=cadastrar" class="btn btn-primary stretched-link float-right">Cadastrar</a>
    </div>
</div>
<table class="table table-hover">
	<thead>
    	<tr>
			<th scope="col">#</th>
			<th scope="col">Data</th>
			<th scope="col">Imposto</th>
			<th scope="col">Total</th>
			<th scope="col">
			</th>
    	</tr>
  	</thead>
  	<tbody>
		<?php foreach ($listaVendas as $row): ?>
	    <tr>
	      	<th scope="row"><?= $this->e($row['id']) ?></th>
	      	<td><?= $this->e($row['data_criacao']) ?></td>
	      	<td>R$ <?= $this->e($row['imposto_total']) ?></td>
	      	<td>R$ <?= $this->e($row['total']) ?></td>
	      	<td>
	      		<form method="post" action="venda.php?acao=remover" class="m-0">
	      			<input type="hidden" name="id" value="<?= $this->e($row['id']) ?>">
	      			<button type="submit" class="btn btn-danger btn-sm">Remover</button>
	      		</form>
	      	</td>
	    </tr>
		<?php endforeach ?>
	</tbody>
</table>

