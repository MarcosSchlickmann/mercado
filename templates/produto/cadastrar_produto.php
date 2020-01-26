<?php $this->layout('template', ['title' => 'Produtos']) ?>

<form method="post" action="produto.php?acao=cadastrar">
  <h3>Cadastrar produto</h3>
  <div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" id="inputNome" name="nome">
  </div>
  <div class="form-group">
    <label for="inputPreco">Preço</label>
    <input type="text" class="form-control" id="inputPreco" name="preco">
  </div>
  <div class="form-group">
    <label for="selectTipoProduto">Tipo de produto</label>
    <select class="form-control" id="selectTipoProduto" name="tipo_id">
        <option hidden>Selecione</option>
        <?php foreach ($listaTiposProduto as $row): ?>
            <option value="<?= $this->e($row['id']) ?>"><?= $this->e($row['nome']) ?></option>
        <?php endforeach; ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>