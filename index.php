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
    $acao  = (isset($_POST['acao'])) ? $_POST['acao'] : '';

    //OPERAÇÕES CRUD CONTAINER
    if ($acao == 'incluirContainer') {
        $cliente_container = addslashes($_POST['cliente_container']);
        $num_container_ins = addslashes($_POST['num_container']);
        $tipo_container = addslashes($_POST['tipo_container']);
        $status_container = addslashes($_POST['status_container']);
        $categoria_container = addslashes($_POST['categoria_container']);
        $crud_teste->cadastrarContainer($cliente_container, $num_container_ins, $tipo_container, $status_container, $categoria_container);
        $acao == '';
        header('location:index.php?#div_list_containers');
        die();
    }

    if ($acao == 'editarContainer') {

        if (isset($_GET['id_container_up']) && !empty($_GET['id_container_up'])) {
            echo 'PASSEI AQUI';
            echo $_GET['id_container_up'];
            $id_container_up = addslashes($_GET['id_container_up']);
            $cliente_container = addslashes($_POST['cliente_container']);
            $num_container = addslashes($_POST['num_container']);
            $tipo_container = addslashes($_POST['tipo_container']);
            $status_container = addslashes($_POST['status_container']);
            $categoria_container = addslashes($_POST['categoria_container']);
            $crud_teste->atualizarContainer(
                $id_container_up,
                $cliente_container,
                $num_container,
                $tipo_container,
                $status_container,
                $categoria_container
            );
            $acao == '';
            header('location:index.php?#div_list_containers');
            die();
        }
    }
    ?>
    <?php
    if (isset($_GET['id_container_up']) && !empty($_GET['id_container_up'])) {
        $id_container_v = addslashes($_GET['id_container_up']);
        $result_container = $crud_teste->buscarContainer($id_container_v);
        $acao == '';
    }
    ?>

    <?php
    //OPERAÇÕES CRUD MOVIMENTAÇÕES
    if ($acao == 'incluirMov') {
        $num_mov = addslashes($_POST['num_mov']);
        $tipo_mov = addslashes($_POST['tipo_mov']);
        $dt_inicio_mov = addslashes($_POST['dt_inicio_mov']);
        $dt_fim_mov = addslashes($_POST['dt_fim_mov']);
        $crud_teste->cadastrarMovimento($num_mov, $tipo_mov, $dt_inicio_mov, $dt_fim_mov);
        $acao == '';
        header('location:index.php?#div_list_mov');
        die();
    }

    if ($acao == 'editarMov') {
        if (isset($_GET['id_mov_up']) && !empty($_GET['id_mov_up'])) {
            $id_mov = addslashes($_POST['id_mov']);
            $num_mov = addslashes($_GET['num_mov']);
            $tipo_mov = addslashes($_POST['tipo_mov']);
            $dt_inicio_mov = addslashes($_POST['dt_inicio_mov']);
            $dt_fim_mov = addslashes($_POST['dt_fim_mov']);
            $crud_teste->atualizarMovimento($id_mov, $num_mov, $tipo_mov, $dt_inicio_mov, $dt_fim_mov);
            $acao == '';
            header('location:index.php?#div_list_mov');
            die();
        }
    }
    ?>
    <?php
    if (isset($_GET['id_mov_up']) && !empty($_GET['id_mov_up'])) {
        $id_mov_v = addslashes($_GET['id_mov_up']);
        $result_mov = $crud_teste->buscarMovimento($id_mov_v);
        $acao == '';
    }
    ?>
    <p class="container w-50 p-2 h4 bg-primary text-white text-center">Cadastro e Movimentação de Containers</p>
       
        <table id="div_list_containers" class="table table-striped table-bordered table-hover">
            <div class="container w-25 p-2 h4 text-dark text-center">Containers</div>
            <thead class="bg-info text-white text-center">
                <tr>
                    <th scope="col">ID Container</th>
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
                        <td id="acoes_container container-fluid">
                            <a href="index.php?id_container_up=<?php echo $dados[$i]["id_container"]; ?>&#cadastro" class="btn btn-warning">
                                Editar</a>
                            <a id="btn-remover-estado" href="index.php?id_container_del=<?php echo $dados[$i]["id_container"]; ?>&num_container_del=<?php echo $dados[$i]["num_container"]; ?>" class="btn btn-danger">
                                Excluir</a>
                            <a href="index.php?id_container_mov=<?php echo $dados[$i]["id_container"]; ?>&num_container_mov=<?php echo $dados[$i]["num_container"]; ?>&#movimento" class="btn btn-success">
                                Movimentar</a>
                        </td>
                    <?php
                        echo '</tr>';
                    }
                    ?>
                <?php
                } else {
                ?>
            </tbody>
        </table>
        <div id="cabecalho" class="d-flex justify-content-center text-danger">
            <h4>SEM CONTAINERS CADASTRADOS</h4>
        </div>
    <?php
                }
    ?>
    <caption>
        <a href="#cadastro" class="btn btn-success">Novo</a>
    </caption>
    
    <!--<div id="div_list_mov" class="table table-striped table-bordered table-hover"> -->
        <table class="table table-striped table-bordered table-hover">
            <div class="container w-25 p-2 h4 text-dark text-center">Movimentações</div>
            <thead class="table bg-info text-white text-center">
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
                        <td id="acoes_mov" class="container-fluid">
                            <a href="index.php?id_mov_up=<?php echo $dados[$i]["id_mov_up"]; ?>" class="btn btn-warning">
                                Editar</a>
                            <a href="index.php?id_mov_del=<?php echo $dados[$i]["id_mov"]; ?>" class="btn btn-danger">
                                Excluir</a>
                        </td>
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
    <!--</div> -->
    <div id="cadastro" class="container-fluid">
        <form method="POST" class="form_novo_container was-validated form-horizontal col-10">
            <div class="h2 text-center text-primary">Cadastrar Container</div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Cliente</label>
                <div class="form-group col-8">
                    <input type="textarea" readonly class="form-control" placeholder="ID Container" name="id_container" value="<?php if (isset($result_container)) {
                                                                                                                                    echo utf8_encode($result_container['id_container']);
                                                                                                                                } ?>">
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Cliente</label>
                <div class="form-group col-8">
                    <input type="textarea" class="form-control" placeholder="Cliente" name="cliente_container" value="<?php if (isset($result_container)) {
                                                                                                                            echo utf8_encode($result_container['cliente_container']);
                                                                                                                        } ?>" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Número do Container</label>
                <div class="form-group col-5">
                    <input type="textarea" class="form-control" data-mask="SSSS0000000" name="num_container" placeholder="Número do Container" value="<?php if (isset($result_container)) {
                                                                                                                                                            echo utf8_encode($result_container['num_container']);
                                                                                                                                                        } ?>" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Tipo</label>
                <div class="form-group col-3">
                    <select class="form-group custom-select" name="tipo_container" required>
                        <option value="">Selecione</option>
                        <option value="20" <?php
                                            if (isset($result_container)) {
                                                echo utf8_encode($result_container['tipo_container'] == '20') ? 'selected' : '';
                                            }
                                            ?>>20</option>
                        <option value="40" <?php
                                            if (isset($result_container)) {
                                                echo utf8_encode($result_container['tipo_container'] == '40') ? 'selected' : '';
                                            }
                                            ?>>40</option>
                    </select>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Status</label>
                <div class="form-group col-3">
                    <select class="form-group custom-select" name="status_container" required>
                        <option value="">Selecione</option>
                        <option value="Cheio" <?php
                                                if (isset($result_container)) {
                                                    echo utf8_encode($result_container['status_container'] == 'Cheio') ? 'selected' : '';
                                                }
                                                ?>>Cheio</option>

                        <option value="Vazio" <?php
                                                if (isset($result_container)) {
                                                    echo utf8_encode($result_container['status_container'] == 'Vazio') ? 'selected' : '';
                                                }
                                                ?>>Vazio</option>
                    </select>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Categoria</label>
                <div class="form-group col-3">
                    <select class="form-group custom-select" name="categoria_container" required>
                        <option value="">Selecione</option>
                        <option value="Importacao" <?php
                                                    if (isset($result_container)) {
                                                        echo utf8_encode($result_container['categoria_container'] == 'Importacao') ? 'selected' : '';
                                                    }
                                                    ?>>Importação</option>

                        <option value="Exportacao" <?php
                                                    if (isset($result_container)) {
                                                        echo utf8_encode($result_container['categoria_container'] == 'Exportacao') ? 'selected' : '';
                                                    }
                                                    ?>>Exportação</option>
                    </select>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-center text-center">
                <div class="form-group col-3">
                    <button type="submit" name="submit" value="submit" class="col-6 btn btn-success">Salvar</button>
                    <?php if (isset($result_container)) {
                        echo '<input type="hidden" name="acao" value="editarContainer">';
                    } else {
                        echo '<input type="hidden" name="acao" value="incluirContainer">';
                    } ?>
                </div>
                <div class="form-group col-3">
                    <a name="cancelarCad" href="#div_list_containers" class="col-6 btn btn-danger">Cancelar</a>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
        </form>
    </div>    
    <div id="movimento" class="container-fluid">
        <form method="POST" class="form_novo_container was-validated form-horizontal col-10">
            <div class="h2 text-center text-primary">Cadastrar Movimentação</div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Código</label>
                <div class="form-group col-8">
                    <input type="textarea" readonly class="form-control" placeholder="Código" name="id_mov" value="<?php if (isset($result_mov)) {
                                                                                                                        echo utf8_encode($result_mov['id_mov']);
                                                                                                                    } ?>" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Número do Container</label>
                <div class="form-group col-5">
                    <input type="textarea" class="form-control" data-mask="SSSS0000000" name="num_container" placeholder="Número Container" value="<?php if (isset($result_mov)) {
                                                                                                                                                        echo utf8_encode($result_mov['num_container']);
                                                                                                                                                    } else {
                                                                                                                                                        echo utf8_encode($_GET['num_container_mov']);
                                                                                                                                                    }
                                                                                                                                                    ?>" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Tipo</label>
                <div class="form-group col-3">
                    <select class="form-group custom-select" name="tipo_mov" required>
                        <option value="">Selecione</option>
                        <option value="Embarque" <?php
                                                    if (isset($result_mov)) {
                                                        echo utf8_encode($result_mov['tipo_mov'] == 'Embarque') ? 'selected' : '';
                                                    }
                                                    ?>>Embarque</option>
                        <option value="Descarga" <?php
                                                    if (isset($result_mov)) {
                                                        echo utf8_encode($result_mov['tipo_mov'] == 'Descarga') ? 'selected' : '';
                                                    }
                                                    ?>>Descarga</option>
                        <option value="GateIN" <?php
                                                if (isset($result_mov)) {
                                                    echo utf8_encode($result_mov['tipo_mov'] == 'GateIN') ? 'selected' : '';
                                                }
                                                ?>>GateIN</option>
                        <option value="GateOUT" <?php
                                                if (isset($result_mov)) {
                                                    echo utf8_encode($result_mov['tipo_mov'] == 'GateOUT') ? 'selected' : '';
                                                }
                                                ?>>GateOUT</option>
                        <option value="Reposicionamento" <?php
                                                            if (isset($result_mov)) {
                                                                echo utf8_encode($result_mov['tipo_mov'] == 'Reposicionamento') ? 'selected' : '';
                                                            }
                                                            ?>>Reposicionamento</option>
                        <option value="Pesagem" <?php
                                                if (isset($result_mov)) {
                                                    echo utf8_encode($result_mov['tipo_mov'] == 'Pesagem') ? 'selected' : '';
                                                }
                                                ?>>Pesagem</option>
                        <option value="Scanner" <?php
                                                if (isset($result_mov)) {
                                                    echo utf8_encode($result_mov['tipo_mov'] == 'Scanner') ? 'selected' : '';
                                                }
                                                ?>>Pesagem</option>
                    </select>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Data de Inicio</label>
                <div class="form-group col-5">
                    <input type="textarea" class="form-control" data-mask="00/00/0000 - 00:00" name="dt_inicio_mov" placeholder="Data Inicio" value="<?php if (isset($result_mov)) {
                                                                                                                                                            echo utf8_encode($result_mov['dt_inicio_mov']);
                                                                                                                                                        } ?>" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-left">
                <label class="col-3 control-label">Data de Inicio</label>
                <div class="form-group col-5">
                    <input type="textarea" class="form-control" data-mask="00/00/0000 - 00:00" name="dt_fim_mov" placeholder="Data Término" value="<?php if (isset($result_mov)) {
                                                                                                                                                        echo utf8_encode($result_mov['dt_fim_mov']);
                                                                                                                                                    } ?>" required>
                </div>
            </div>
            <div class="form-group p-2 d-flex justify-content-center text-center">
                <div class="form-group col-3">
                    <button type="submit" name="submit" value="submit" class="col-6 btn btn-success">Salvar</button>
                    <?php if (isset($result_mov)) {
                        echo '<input type="hidden" name="acao" value="editarMov">';
                    } else {
                        echo '<input type="hidden" name="acao" value="incluirMov">';
                    } ?>
                </div>
                <div class="form-group col-3">
                    <a name="cancelarCad" href="#div_list_mov" class="col-6 btn btn-danger">Cancelar</a>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
        </form>
    </div> 
    
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!--<script>
        function recarregarPagina() {
            var count = 0;

            function removerEstado() {
                console.log('removerEstado()');

                /// ; Pega o elemento pelo ID e adiciona um evento de `onclick`
                $('#btn-remover-estado').click(function() {
                    console.log(++count);
                });

            }
        }
    </script> -->
</body>
</html>

<?php
$acao  = (isset($_POST['acao'])) ? $_POST['acao'] : '';
if (empty($acao)) {
    if (isset($_GET['id_container_del']) && isset($_GET['num_container_del'])) {
        $id_container_del = addslashes($_GET['id_container_del']);
        $num_container_del = addslashes($_GET['num_container_del']);
        $crud_teste->excluirContainer($id_container_del, $num_container_del);
    }
}
?>
<?php
if (isset($_GET['id_mov_del'])) {
    $num_container_del = addslashes($_GET['id_mov_del']);
    $crud_teste->excluirMovimento($num_container_del);
}
?>