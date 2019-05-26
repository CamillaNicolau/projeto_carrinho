
        <main class="container py-5">
            <div class="row">
                <div class="col-12 d-flex justify-content-center mb-5">
                    <button class="btn btn-secondary mx-3" data-toggle="modal" data-target="#cadastroPromocao" >Cadastrar promoção</button>
                </div>
            </div>
            <div class="row">
                <table id="promocao" class="table table-striped table-hover table-boder-secondary text-center col-12">
                    <thead>
                        <tr class="text-left">
                            <th scope="col h4">Promoção</th>
                            <th scope="col h4">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="listaPromocao"></tbody>
                </table>
            </div>
        </main>
        <!-- Modal Cadastro Promoção-->
        <div class="modal fade" id="cadastroPromocao" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
                <div class="modal-content shadow-lg">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Cadastro de promoção</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="promocao" method="post" name="form_cadastra_promocao" id="form_cadastra_promocao">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="nomePromocao">Nome da promoção*</label>
                                    <input type="text" class="form-control" id="nomePromocao" required="" name="nomePromocao" placeholder="Ex.: Pague 1 e Leve 2">
                                </div>
                            </div>
                            <h5>Parâmetros</h5>
                            <div class="form-row">
                                <div class="form-group col-m-12 col-sm-3">
                                    <label for="campoCondicionado">Campo condicionado*</label>
                                    <select class="custom-select" id="campoCondicionado" required="" name="campoCondicionado">
                                        <option value="" selected>Escolha o campo</option>
                                        <option value="quantidade">Quantidade do produto</option>
                                        <option value="subtotal">Valor subtotal</option>
                                    </select>
                                </div>
                                <div class="form-group col-m-12 col-sm-3">
                                    <label for="condicao">Condição*</label>
                                    <select class="custom-select" id="condicao" required="" name="condicao">
                                        <option value="" selected>Escolha o campo</option>
                                        <option value="igual">Igual</option>
                                        <option value="maior_igual">Igual ou maior</option>
                                    </select>
                                </div>
                                <div class="form-group col-m-12 col-sm-2">
                                    <label for="valorAvaliado">Valor avaliado*</label>
                                    <input type="text" class="form-control" required="" id="valorAvaliado" name="valorAvaliado" placeholder="Ex.: 12,00 ou 3">
                                </div>
                                <div class="form-group col-m-12 col-sm-4">
                                    <label for="acaoAplicada">Ação aplicada</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend col-7 p-0">
                                            <select class="custom-select" id="acaoPromocao" required="" name="acaoPromocao">
                                                <option value="" selected>Ação</option>
                                                <option value="vlFixo">Valor fixo</option>
                                                <option value="DescFixo">Desc. fixo</option>
                                                <option value="DescPercent">Desc. percentual</option>
                                            </select>
                                        </div>
                                        <input type="text" name="acaoAplicada" required="" id="acaoAplicada" class="form-control col-5 p-0" aria-label="Text input with dropdown button">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input name="id_promocao" value="" id="id_promocao" type="hidden" />
                                <input name="acao" value="adicionar" id="acao" type="hidden" />
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </form>
                    </div>     
                </div>
            </div>
        </div>