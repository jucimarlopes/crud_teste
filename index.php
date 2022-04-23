<?php

require_once 'crud.php';
$crud_teste = new Crud_Teste();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />

    <script>
        $(document).ready(function() {
            $('form').hide();
        });
    </script>
    <script>
        $(document).ready(function() {
            var visivel_container = $('.form_novo_container').is(':visible');
            var visivel_mov = $('.form_nova_mov').is(':visible');
            var visivel_list_containers = $('.div_list_containers').is(':visible');
            var visivel_list_mov = $('.div_list_mov').is(':visible');
            $('.btn_novo_container').click(function() {
                $('.div_list_containers').hide();
                $('.div_list_mov').hide();
                if (visivel_mov)
                    $('.form_nova_mov').hide();
                visivel_container = $('.form_novo_container').is(':visible');
                visivel_mov = $('.form_nova_mov').is(':visible');
                if (!visivel_container)
                    $('.form_novo_container').show();
                visivel_container = $('.form_novo_container').is(':visible');
                visivel_mov = $('.form_nova_mov').is(':visible');
            });

            $('.btn_nova_mov').click(function() {
                $('.div_list_containers').hide();
                $('.div_list_mov').hide();
                if (visivel_container)
                    $('.form_novo_container').hide();
                visivel_container = $('.form_novo_container').is(':visible');
                visivel_mov = $('.form_nova_mov').is(':visible');
                if (!visivel_mov)
                    $('.form_nova_mov').show();
                visivel_container = $('.form_novo_container').is(':visible');
                visivel_mov = $('.form_nova_mov').is(':visible');
            });

            $('.btn_cancelar_dados').click(function() {
                $('.form_novo_container').hide();
                $('.form_nova_mov').hide();
                $('.div_list_containers').show();
                $('.div_list_mov').show();
            });
        });
    </script>

    <title>CRUD TESTE</title>
</head>

<body>
    <div class="container-fluid p-2">
        <div class="container w-50 p-2 h4 bg-primary text-white text-center">Cadastro e Movimentação de Containers</div>
    </div>
    <div class="div_list_containers table-responsive">
        <div class="container w-25 p-2 h4 text-dark text-white text-center">Containers</div>
        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-info text-white text-center">
                <tr>
                    <th scope="col">Cliente</th>
                    <th scope="col">Número do Container</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Status</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="cli_container">Jucimar Alves Lopesaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>
                    <td id="num_container">ABCD1234567</td>
                    <td id="tipo_container">20</td>
                    <td id="status_container">Cheio</td>
                    <td id="categ_container">Importação</td>
                    <td id="acoes_container"><a href="#" class="btn btn-warning">Editar</a><a href="#" class="btn btn-danger">Excluir</a></td>
                    <caption>
                        <a href="#" class="btn_novo_container btn btn-success">Novo</a>
                    </caption>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="div_list_mov table-responsive">
        <div class="container w-25 p-2 h4 text-dark text-white text-center">Movimentações</div>
        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-info text-white text-center">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Número Container</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Data e Hora Inicio</th>
                    <th scope="col">Data e Hora Fim</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="id_mov">000001</td>
                    <td id="cod_container">ABCD1234567</td>
                    <td id="tipo_mov">Reposicionamento</td>
                    <td id="dt_inicio_mov">21/04/2022 - 15:00</td>
                    <td id="dt_fim_mov">21/05/2023 - 16:00</td>
                    <td id="acoes_mov"><a href="#" class="btn btn-warning">Editar</a><a href="#" class="btn btn-danger">Excluir</a></td>
                    <caption>
                        <a href="#" class="btn_nova_mov btn btn-success">Novo</a>
                    </caption>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container table-bordered d-flex justify-content-center">
        <form class="form_novo_container was-validated form-horizontal col-10" id="form_containers">
            <div class="container col-12 h2 text-center text-primary">Cadastrar Container</div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Cliente</label>
                <div class="col-8">
                    <input type="textarea" class="form-control" id="form_cli_container" placeholder="Cliente" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Número do Container</label>
                <div class="col-5">
                    <input type="textarea" class="form-control" id="form_num_container" data-mask="SSSS-0000000" placeholder="Número do Container" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Tipo</label>
                <div class="col-3">
                    <select class="form-group custom-select" id="form_tipo_container" required>
                        <option value="">Selecione</option>
                        <option value="20">20</option>
                        <option value="40">40</option>
                    </select>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Status</label>
                <div class="col-3">
                    <select class="form-group custom-select" id="form_status_container" required>
                        <option value="">Selecione</option>
                        <option value="Cheio">Cheio</option>
                        <option value="Vazio">Vazio</option>
                    </select>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Categoria</label>
                <div class="col-3">
                    <select class="form-group custom-select" id="form_categ_container" required>
                        <option value="">Selecione</option>
                        <option value="Importação">Importação</option>
                        <option value="Exportação">Exportação</option>
                    </select>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-center text-center">
                <div class="col-3">
                    <button type="submit" class="col-6 btn btn-success" id="btn_salvar_container">Salvar</button>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn_cancelar_dados col-6 btn btn-danger">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container table-bordered d-flex justify-content-center">
        <form class="form_nova_mov was-validated form-horizontal col-10" id="form_movimentacoes">
            <div class="container col-12 h2 text-center text-primary">Cadastrar Movimentações</div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Código</label>
                <div class="col-5">
                    <input type="textarea" class="form-control" id="form_cod_container" placeholder="Código" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Número Container</label>
                <div class="col-8">
                    <input type="textarea" class="form-control" id="form_cli_mov" data-mask="SSSS-0000000" placeholder="Número Container" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Tipo</label>
                <div class="col-3">
                    <select class="form-control" id="form_tipo_mov" required>
                        <option value="">Selecione</option>
                        <option value="Embarque">Embarque</option>
                        <option value="Descarga">Descarga</option>
                        <option value="GateIN">Gate IN</option>
                        <option value="GateOUT">Gate OUT</option>
                        <option value="Reposionamento">Reposicionamento</option>
                        <option value="Pesagem">Pesagem</option>
                        <option value="Scanner">Scanner</option>
                    </select>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Data e Hora Inicio</label>
                <div class="col-3">
                    <input type="textarea" class="form-control" id="form_dt_inicio_mov" data-mask="00/00/0000 - 00:00" placeholder="Data e Hora de Inicio" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Data e Hora Fim</label>
                <div class="col-3">
                    <input type="textarea" class="form-control" id="form_dt_fim_mov" data-mask="00/00/0000 - 00:00" placeholder="Data e Hora de Fim" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-center text-center">
                <div class="col-3">
                    <button type="submit" class="col-6 btn btn-success" id="btn_salvar_mov">Salvar</button>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn_cancelar_dados col-6 btn btn-danger">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</body>

</html>