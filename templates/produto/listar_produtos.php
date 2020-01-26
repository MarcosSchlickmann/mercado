<?php $this->layout('template', ['title' => 'Produtos']) ?>
	
<div class="row justify-content-between">
    <div class="col">
      	<h3>Produtos</h3>
    </div>
    <div class="col-2">
		<a href="produto.php?acao=cadastrar" class="btn btn-primary stretched-link float-right">Cadastrar</a>
    </div>
</div>
<table class="table table-hover">
	<thead>
    	<tr>
			<th scope="col">#</th>
			<th scope="col">Nome</th>
			<th scope="col">Preço</th>
			<th scope="col">Tipo</th>
			<th scope="col">
			</th>
    	</tr>
  	</thead>
  	<tbody>
		<?php foreach ($listaProdutos as $row): ?>
	    <tr>
	      	<th scope="row"><?= $this->e($row['produto_id']) ?></th>
	      	<td><?= $this->e($row['produto_nome']) ?></td>
	      	<td>R$ <?= $this->e($row['produto_preco']) ?></td>
	      	<td><?= $this->e($row['tipo_nome']) ?></td>
	      	<td>
	      		<form method="post" action="produto.php?acao=remover" class="m-0">
	      			<input type="hidden" name="id" value="<?= $this->e($row['produto_id']) ?>">
	      			<button type="submit" class="btn btn-danger btn-sm">Remover</button>
	      		</form>
	      	</td>
	    </tr>
		<?php endforeach ?>
	</tbody>
</table>

