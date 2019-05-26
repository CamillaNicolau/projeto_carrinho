
    <main class="container py-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-5">
                <button class="btn btn-secondary mx-3" data-toggle="modal" data-target="#cadastroProduto" >Cadastrar produto</button>
                <button id="editar-produto" class="btn btn-secondary mx-3"  >Editar produto</button>
            </div>
        </div>
        <div class="row" id="listaProduto"></div>
    </main>
    <!-- Modal Cadastro Produto-->
    <div class="modal fade" id="cadastroProduto" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h4 class="modal-title" id="labelModal">Cadastro de produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body col-12">
                    <form action="index" method="post" name="form_cadastra_produto" id="form_cadastra_produto">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="nomeProduto">Nome do produto*</label>
                                <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" required="" placeholder="Ex.: Meia">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="precoProduto">Preço*</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">R$</div>
                                    </div>
                                    <input type="text" class="form-control" id="precoProduto" name="precoProduto" required="" placeholder="10,00">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="promocao">Promoção</label>
                                <select class="custom-select" id="promocao" name="promocao">
                                    <option value="" selected>Escolha a promoção</option>
                                </select>
                            </div>
                        </div>
                        <input name="id_produto" value="" id="id_produto" type="hidden" />
                        <input name="acao" value="adicionar" id="acao" type="hidden" />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success"  id ="botao-salvar">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>