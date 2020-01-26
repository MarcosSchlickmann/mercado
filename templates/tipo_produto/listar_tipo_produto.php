<?php $this->layout('template', ['title' => 'Tipos de produto']) ?>
	
<div class="row justify-content-between">
    <div class="col">
      	<h3>Tipos de produto</h3>
    </div>
    <div class="col-2">
		<a href="tipoProduto.php?acao=cadastrar" class="btn btn-primary stretched-link float-right">Cadastrar</a>
    </div>
</div>
<table class="table table-hover">
	<thead>
    	<tr>
			<th scope="col">#</th>
			<th scope="col">Nome</th>
			<th scope="col">Imposto</th>
			<th scope="col">
			</th>
    	</tr>
  	</thead>
  	<tbody>
		<?php foreach ($listaTiposProduto as $row): ?>
	    <tr>
	      	<th scope="row"><?= $this->e($row['id']) ?></th>
	      	<td><?= $this->e($row['nome']) ?></td>
	      	<td><?= $this->e($row['imposto']) ?>%</td>
	      	<td>
	      		<form method="post" action="tipoProduto.php?acao=remover" class="m-0">
	      			<input type="hidden" name="id" value="<?= $this->e($row['id']) ?>">
	      			<button type="submit" class="btn btn-danger btn-sm">Remover</button>
	      		</form>
	      	</td>
	    </tr>
		<?php endforeach ?>
	</tbody>
</table>

