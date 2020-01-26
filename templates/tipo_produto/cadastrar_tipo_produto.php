<?php $this->layout('template', ['title' => 'Tipos de produto']) ?>

<form method="post" action="tipoProduto.php?acao=cadastrar">
  <h3>Cadastrar tipo produto</h3>
  <div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" id="inputNome" name="nome">
  </div>
  <div class="form-group">
    <label for="inputImposto">Imposto</label>
    <input type="text" class="form-control" id="inputImposto" name="imposto">
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>