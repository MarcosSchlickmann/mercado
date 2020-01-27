<?php $this->layout('template', ['title' => 'Vendas']) ?>

<h3>Cadastrar venda</h3>
<form class="form-inline" method="post" action="venda.php">
    <input type="hidden" name="venda_id" value="<?= $this->e($venda_id) ?>">
    <input type="hidden" name="acao" value="adicionar_produto">
    
    <label class="my-1 mr-2">Produto</label>
    <select class="custom-select mb-2 mr-sm-2" name="produto_id">
        <option selected>Selecione</option>
            <?php foreach ($listaProdutos as $row): ?>
            <option value="<?= $this->e($row['produto_id']) ?>"><?= $this->e($row['produto_nome']) ?></option>
            <?php endforeach ?>
    </select>

    <label class="my-1 mr-2 sr-only">Quantidade</label>
    <input type="number" name="quantidade" class="form-control mb-2 mr-sm-2" placeholder="Quantidade">

    <button type="submit" class="btn btn-primary mb-2">Adicionar</button>
</form>
<form method="post" action="venda.php?acao=cadastrar">
    <input type="hidden" name="id" value="<?= $this->e($venda_id) ?>">
  <div class="row">
    <div class="col form-group">
        <label>Total</label>
        <input readonly type="text" class="form-control" name="total" value="<?= $this->e($total) ?>">
    </div>
    <div class=" col form-group">
      <label>Imposto</label>
      <input readonly type="text" class="form-control" name="imposto_total" value="<?= $this->e($imposto_total) ?>">
    </div>
    <div class="col form-group">
        <button type="submit" class="btn btn-primary float-right mt-4">Finalizar</button>
    </div>
  </div>
</form>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Preço</th>
            <th scope="col">Imposto</th>
        </tr>
    </thead>
    <tbody>
        <?php if(isset($listaVendaProdutos)): foreach ($listaVendaProdutos as $row): ?>
        <tr>
            <td><?= $this->e($row['nome']) ?></td>
            <td><?= $this->e($row['quantidade']) ?></td>
            <td>R$ <?= $this->e($row['preco'] * $row['quantidade']) ?></td>
            <td>R$ <?= $this->e( ($row['preco'] * $row['quantidade']) * ($row['imposto'] / 100) ) ?></td>
        </tr>
        <?php endforeach; endif; ?>
    </tbody>
</table>