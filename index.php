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

    <title>CRUD TESTE</title>
</head>

<body>

    <?php
    if (isset($_POST['num_container'])) 
    {
        if (isset($_GET['id_up']) && !empty($_GET['id_up'])) 
        {
            $cliente_container = addslashes($_POST['cliente_container']);
            $num_container_upd = addslashes($_GET['num_container']);
            $tipo_container = addslashes($_POST['tipo_container']);
            $status_container = addslashes($_POST['status_container']);
            $categoria_container = addslashes($_POST['categoria_container']);

            $crud_teste->atualizarContainer($cliente_container, $num_container_upd, $tipo_container, $status_container, $categoria_container);
            header("location index.php");
            
        } else {
            $cliente_container = addslashes($_POST['cliente_container']);
            $num_container_ins = addslashes($_POST['num_container']);
            $tipo_container = addslashes($_POST['tipo_container']);
            $status_container = addslashes($_POST['status_container']);
            $categoria_container = addslashes($_POST['categoria_container']);
            $crud_teste->cadastrarContainer($cliente_container, $num_container_ins, $tipo_container, $status_container, $categoria_container);
            header("location index.php");
        }
    }    
    ?>
    <?php
     if (isset($_GET['id_up'])) 
     {
         $id_update = addslashes($_GET['id_up']);
         $result_container = $crud_teste->buscarContainer($id_update);
     }
    ?>

    <div class="container-fluid p-2">
        <div class="container w-50 p-2 h4 bg-primary text-white text-center">Cadastro e Movimentação de Containers</div>
    </div>
    <div class="container-fluid table-responsive" id="div_list_containers">
        <table class="table table-striped table-bordered table-hover">
            <div class="container w-25 p-2 h4 text-dark text-center">Containers</div>
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
                <?php
                $dados = $crud_teste->buscarContainers();
                if (count($dados) > 0) {
                    for ($i = 0; $i < count($dados); $i++) {
                        echo '<tr>';
                        foreach ($dados[$i] as $k => $v) {

                            echo '<td>' . utf8_encode($v) . '</td>';
                        }
                ?>
                        <td id="acoes_container"><a href="index.php?id_up=<?php echo $dados[$i]["num_container"]; ?>" class="btn_editar_container btn btn-warning">Editar</a><a href="index.php?id_del=<?php echo $dados[$i]["num_container"]; ?>" class="btn btn-danger">Excluir</a></td>

                    <?php
                        echo '</tr>';
                    }

                    ?>
                <?php
                } else {
                ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center text-danger">
            <h4>SEM CONTAINERS CADASTRADOS</h4>
        </div>
    <?php
                }
    ?>
    <caption>
        <a href="#" class="btn btn-success">Novo</a>
    </caption>
    </div>
    <br>
    <div class="container-fluid table-responsive" id="div_list_mov">
        <table class="table table-striped table-bordered table-hover">
            <div class="container w-25 p-2 h4 text-dark text-center">Movimentações</div>
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
                <?php
                $dados = $crud_teste->buscarMovimentos();
                if (count($dados) > 0) {
                    for ($i = 0; $i < count($dados); $i++) {
                        echo '<tr>';
                        foreach ($dados[$i] as $k => $v) {

                            echo '<td>' . utf8_encode($v) . '</td>';
                        }
                ?>
                        <?php
                        $paginaEditar = 'index.php?id_up=' . $dados[$i]['num_container'];
                        ?>
                        <td id="acoes_container"><a href="index.php?id_up=<?php echo $dados[$i]["num_container"]; ?>" class="btn_editar_container btn btn-warning">Editar</a><a href="index.php?id_del=<?php echo $dados[$i]["num_container"]; ?>" class="btn btn-danger">Excluir</a></td>

                    <?php
                        echo '</tr>';
                    }

                    ?>
                <?php
                } else {
                ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center text-danger">
            <h4>SEM MOVIMENTAÇÕES</h4>
        </div>
    <?php
                }
    ?>
    <caption>
        <a href="#" class="btn btn btn-success">Novo</a>
    </caption>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div id="cadastro" class="container table-bordered d-flex justify-content-center">
        <form method="POST" class="form_novo_container was-validated form-horizontal col-10" id="form_containers">
            <div class="container col-12 h2 text-center text-primary">Cadastrar Container</div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label id="label_cli_container" class="col-3 control-label">Cliente</label>
                <div class="col-8">
                    <input type="textarea" class="form-control" id="form_cli_container" placeholder="Cliente" value="<?php if ( isset($result_container) ) { echo utf8_encode($result_container['cliente_container']); } ?>" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Número do Container</label>
                <div class="col-5">
                    <input type="textarea" class="form-control" id="form_num_container" data-mask="SSSS-0000000" placeholder="Número do Container" value="<?php if ( isset($result_container) ) { echo utf8_encode($result_container['num_container']); } ?>" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Tipo</label>
                <div class="col-3">
                    <select class="form-group custom-select" id="form_tipo_container" name="option_tipo_container" required>
                        <option value="">Selecione</option>
                        <option value="20"                        
                        <?php 
                        if ( isset($result_container) ) 
                        { echo utf8_encode($result_container['tipo_container'] == '20') ? 'selected':''; } 
                        ?>>20</option>
                        <option value="40"                        
                        <?php 
                        if ( isset($result_container) ) 
                        { echo utf8_encode($result_container['tipo_container'] == '40') ? 'selected':''; } 
                        ?>>40</option>
                    </select>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Status</label>
                <div class="col-3">
                    <select class="form-group custom-select" id="form_status_container" value="<?php if ( isset($result_container) ) { echo utf8_encode($result_container['status_container']); } ?>"required>
                        <option value="">Selecione</option>
                        <option value="Cheio"
                        <?php 
                        if ( isset($result_container) ) 
                        { echo utf8_encode($result_container['status_container'] == 'Cheio') ? 'selected':''; } 
                        ?>>Cheio</option>

                        <option value="Vazio"
                        <?php
                        if ( isset($result_container) ) 
                        { echo utf8_encode($result_container['status_container'] == 'Vazio') ? 'selected':''; } 
                        ?>>Vazio</option>
                    </select>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Categoria</label>
                <div class="col-3">
                    <select class="form-group custom-select" id="form_categ_container" required>
                        <option value="">Selecione</option>
                        <option value="Importação" 
                        <?php 
                        if ( isset($result_container) ) 
                        { echo utf8_encode($result_container['categoria_container'] == 'Importacao') ? 'selected':''; } 
                        ?>>Importação</option>

                        <option value="Exportação"
                        <?php
                        if ( isset($result_container) ) 
                        { echo utf8_encode($result_container['categoria_container'] == 'Exportacao') ? 'selected':''; } 
                        ?>>Exportação</option>
                    </select>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-center text-center">
                <div class="col-3">
                    <button type="submit" class="col-6 btn btn-success" id="btn_salvar_container">Salvar</button>
                </div>
                <div class="col-3">
                    <a href="#div_list_containers" class="btn btn-danger col-6">Cancelar</a>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
        </form>       
    </div>
    <br>    
    <div id="movimentacao" class="container table-bordered d-flex justify-content-center">
        <form method="POST" class="form_nova_mov was-validated form-horizontal col-10" id="form_movimentacoes">
            <div class="container col-12 h2 text-center text-primary">Cadastrar Movimentações</div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Código</label>
                <div class="col-5">
                    <input type="textarea" class="form-control" id="form_cod_mov" placeholder="Código" value="<?php if ( isset($res) ) { echo utf8_encode($res['id_mov']); } ?>" required >
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Número Container</label>
                <div class="col-8">
                    <input type="textarea" class="form-control" id="form_numero_container_mov" data-mask="SSSS-0000000" placeholder="Número Container" value="<?php if ( isset($res) ) { echo utf8_encode($res['num_container']); } ?>"required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Tipo</label>
                <div class="col-3">
                    <select class="form-control" id="form_tipo_mov" value="<?php if ( isset($res) ) { echo utf8_encode($res['tipo_mov']); } ?>"required>
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
                    <input type="textarea" class="form-control" id="form_dt_inicio_mov" data-mask="00/00/0000 - 00:00" placeholder="Data e Hora de Inicio" value="<?php if ( isset($res) ) { echo utf8_encode($res['dt_inicio_mov']); } ?>"required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Data e Hora Fim</label>
                <div class="col-3">
                    <input type="textarea" class="form-control" id="form_dt_fim_mov" data-mask="00/00/0000 - 00:00" placeholder="Data e Hora de Fim" value="<?php if ( isset($res) ) { echo utf8_encode($res['cliente_dt_fim_mov']); } ?>"required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-center text-center">
                <div class="col-3">
                    <button type="submit" class="col-6 btn btn-success" id="btn_salvar_mov">Salvar</button>
                </div>
                <div class="col-3">
                    <a href="#div_list_containers" class="btn btn-danger col-6">Cancelar</a>
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