<?php $this->layout('template', ['title' => 'Tipos de produto']) ?>
<?php foreach ($listaTiposProduto as $row): ?>
	<li>#<?= $this->e($row['id']) ?>. <?= $this->e($row['nome']) ?>: <?= $this->e($row['imposto']) ?>%</li>
<?php endforeach ?>

