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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
    <link rel="https://cdn.datatables.net/fixedcolumns/4.0.2/css/fixedColumns.dataTables.min.css"/>

    <title>CRUD TESTE</title>
</head>

<body>
    <!--OPERAÇÕES CRUD CONTAINER -->
    <?php
    if (isset($_POST['num_container'])) {
        if (isset($_GET['id_container_up']) && !empty($_GET['id_container_up'])) {
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
            header('location: index.php?#lista_containers');
        } else {
            $cliente_container = addslashes($_POST['cliente_container']);
            $num_container = addslashes($_POST['num_container']);
            $tipo_container = addslashes($_POST['tipo_container']);
            $status_container = addslashes($_POST['status_container']);
            $categoria_container = addslashes($_POST['categoria_container']);
            $crud_teste->cadastrarContainer(
                $cliente_container,
                $num_container,
                $tipo_container,
                $status_container,
                $categoria_container
            );
            header('location: index.php?#lista_containers');
        }
    }
    ?>
    <?php
    if (isset($_GET['id_container_up']) && !empty($_GET['id_container_up'])) {
        $id_container_up = addslashes($_GET['id_container_up']);
        $result_container_up = $crud_teste->buscarContainer($id_container_up);
    }
    ?>

    <!-- OPERAÇÕES CRUD MOVIMENTAÇÕES -->
    <?php
    if (isset($_POST['num_container_mov'])) {
        if (isset($_GET['id_mov_up']) && !empty($_GET['id_mov_up'])) {
            $id_mov_up = addslashes($_GET['id_mov_up']);
            $num_container_mov = addslashes($_POST['num_container_mov']);
            $tipo_mov = addslashes($_POST['tipo_mov']);
            $dt_inicio_mov = addslashes($_POST['dt_inicio_mov']);
            $datei = implode('-', array_reverse(explode('/', $dt_inicio_mov)));
            $dt_fim_mov = addslashes($_POST['dt_fim_mov']);
            $datef = implode('-', array_reverse(explode('/', $dt_fim_mov)));
            $crud_teste->atualizarMovimento(
                $id_mov_up,
                $num_container_mov,
                $tipo_mov,
                $datei,
                $datef
            );
            header('location: index.php?#lista_movs');
        } else {
            $num_container_mov = addslashes($_GET['num_container_mov']);
            $tipo_mov = addslashes($_POST['tipo_mov']);
            $dt_inicio_mov = addslashes($_POST['dt_inicio_mov']);
            $datei = implode('-', array_reverse(explode('/', $dt_inicio_mov)));
            $dt_fim_mov = addslashes($_POST['dt_fim_mov']);
            $datef = implode('-', array_reverse(explode('/', $dt_fim_mov)));
            $crud_teste->cadastrarMovimento(
                $num_container_mov,
                $tipo_mov,
                $datei,
                $datef
            );
            header('location: index.php?#lista_movs');
        }
    }
    ?>
    <?php
    if (isset($_GET['id_mov_up']) && !empty($_GET['id_mov_up'])) {
        $id_mov_up = addslashes($_GET['id_mov_up']);
        $result_mov_up = $crud_teste->buscarMovimento($id_mov_up);
    }
    ?>

    <div class="container" id="lista_containers">
        <table class="table-striped table-bordered table-hover">
            <thead>
                <h4 class=" text-primary">Cadastro de Containers</h4>
                <tr class="bg-primary" id="titulo_container">
                    <th>Código</th>
                    <th>Cliente</th>
                    <th>Número Container</th>
                    <th>Tipo Container</th>
                    <th>Status</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $dados = $crud_teste->buscarContainers();
                if (count($dados) > 0) {
                    for ($i = 0; $i < count($dados); $i++) {
                        echo '<tr>';
                        foreach ($dados[$i] as $k => $v) {
                            if ($k != 'id') {
                                echo '<td>' . utf8_encode($v) . '</td>';
                            }
                        }
                ?>
                        <td>
                            <a class="btn btn-warning" href="index.php?id_container_up=<?php echo $dados[$i]['id_container']; ?>#cadastro">Editar</a>
                            <a class="btn btn-danger" href="index.php?id_container_del=<?php echo $dados[$i]['id_container']; ?>&num_container_del=<?php echo $dados[$i]['num_container']; ?>">Excluir</a>
                            <a class="btn btn-success" href="index.php?num_container_mov=<?php echo $dados[$i]['num_container']; ?>#movimento">Movimentar</a>
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
        <div class="aviso">
            <h4>NÃO EXISTE CONTAINERS CADASTRADOS!</h4>
        </div>
    <?php
                }
    ?>
    </div>

    <div class="container" id="lista_movs">
        <table class="table-striped table-bordered table-hover">
            <thead>
                <h4 class="text-primary">Cadastro de Movimentações</h4>
                <tr class="bg-success" id="titulo_mov">
                    <th>Código</th>
                    <th>Número Container</th>
                    <th>Tipo</th>
                    <th>Data Inicio</th>
                    <th>Data Término</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php                
                $dados = $crud_teste->buscarMovimentos();
                if (count($dados) > 0) {
                    for ($i = 0; $i < count($dados); $i++) {
                        echo '<tr>';  
                        $datai = implode('/', array_reverse(explode('-', $dados[$i]['data_inicio_mov'])));                        
                        $dados[$i]['data_inicio_mov'] = $datai;
                        $dataf = implode('/', array_reverse(explode('-', $dados[$i]['data_termino_mov'])));                        
                        $dados[$i]['data_termino_mov'] = $dataf;

                        foreach ($dados[$i] as $k => $v) {                              
                            
                            
                            
                            echo '<td>' . utf8_encode($v) . '</td>';
                        }
                ?>
                        <td>
                            <a class="btn btn-warning" href="index.php?id_mov_up=<?php echo $dados[$i]['id_mov']; ?>#movimento">Editar</a>
                            <a class="btn btn-danger" href="index.php?id_mov_del=<?php echo $dados[$i]['id_mov']; ?>">Excluir</a>
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
        <div class="aviso">
            <h4>NÃO EXISTE MOVIMENTAÇÕES CADASTRADAS!</h4>
        </div>
    <?php
                }
    ?>
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
    <br>            
    <br>            
    <br>            
    
    <div class="container" id="cadastro">
        <form method="POST">
            <h2>
                <?php
                if (isset($result_container_up)) {
                    echo 'Atualizar Container';
                } else {
                    echo 'Cadastrar Novo Container';
                }
                ?>
            </h2>
            <label for="id_container">Código</label>
            <input disabled type="text" name="id_container" id="id_container" value="<?php if (isset($result_container_up)) {
                                                                                            echo utf8_encode($result_container_up['id_container']);
                                                                                        } ?>">

            <label for="cliente_container">Cliente</label>
            <input required type="text" name="cliente_container" id="cliente_container" value="<?php if (isset($result_container_up)) {
                                                                                            echo $result_container_up['cliente_container'];
                                                                                        } ?>">

            <label for="num_container">Número</label>
            <input required data-mask="SSSS-0000000" type="num_container" name="num_container" id="num_container" value="<?php if (isset($result_container_up)) {
                                                                                                                    echo $result_container_up['num_container'];
                                                                                                                } ?>">

            <label for="tipo_container">Tipo</label>
            <select required class="form-select" name="tipo_container" id="tipo_container">
                <option selected>Selecione</option>
                <option value="20" <?php if (isset($result_container_up)) {
                                        echo $result_container_up['tipo_container'] == "20" ? 'selected' : '';
                                    } ?>>20</option>
                <option value="40" <?php if (isset($result_container_up)) {
                                        echo $result_container_up['tipo_container'] == "40" ? 'selected' : '';
                                    } ?>>40</option>
            </select>

            <label for="status_container">Status</label>
            <select required class="form-select" name="status_container" id="status_container">
                <option selected>Selecione</option>
                <option value="Cheio" <?php if (isset($result_container_up)) {
                                            echo $result_container_up['status_container'] == "Cheio" ? 'selected' : '';
                                        } ?>>Cheio</option>
                <option value="Vazio" <?php if (isset($result_container_up)) {
                                            echo $result_container_up['status_container'] == "Vazio" ? 'selected' : '';
                                        } ?>>Vazio</option>
            </select>

            <label for="categoria_container">Categoria</label>
            <select required class="form-select" name="categoria_container" id="categoria_container">
                <option selected>Selecione</option>
                <option value="Importacao" <?php if (isset($result_container_up)) {
                                                echo $result_container_up['categoria_container'] == "Importacao" ? 'selected' : '';
                                            } ?>>Importação</option>
                <option value="Exportacao" <?php if (isset($result_container_up)) {
                                                echo $result_container_up['categoria_container'] == "Exportacao" ? 'selected' : '';
                                            } ?>>Exportação</option>
            </select>

            <input class="botao btn btn-primary" type="submit" value="<?php if (isset($result_container_up)) {
                                                                            echo 'Atualizar';
                                                                        } else {
                                                                            echo 'Cadastrar';
                                                                        } ?>">
        </form>
    </div>
    <hr>
    <div class="container" id="movimento">
        <form method="POST" enctype="multipart/form-data">
            <h2>
                <?php
                if (isset($result_mov_up)) {
                    echo 'Atualizar Movimentação';
                } else {
                    echo 'Cadastrar Nova Movimentação';
                }
                ?>
            </h2>
            <label for="id_mov">Código</label>
            <input readonly type="text" name="id_mov" id="id_mov" value="
            <?php
            if (isset($result_mov_up)) {
                echo utf8_encode($result_mov_up['id_mov']);
            }
            ?>
            ">
            <label for="num_container_mov">Container</label>
            <input readonly type="text" name="num_container_mov" id="num_container_mov" value="
            <?php
            if (isset($result_mov_up)) {
                echo utf8_encode($result_mov_up['num_container']);
            } else {
                if (isset($_GET['num_container_mov']) && !empty($_GET['num_container_mov'])) {
                    echo $_GET['num_container_mov'];
                }
            }
            ?>
            ">
            <label for="tipo_mov">Tipo</label>
            <select required class="form-select" name="tipo_mov" id="tipo_mov" >
                <option selected>Selecione</option>
                <option value="Embarque" <?php if (isset($result_mov_up)) {
                                                echo $result_mov_up['tipo_mov'] == "Embarque" ? 'selected' : '';
                                            } ?>>Embarque</option>
                <option value="Descarga" <?php if (isset($result_mov_up)) {
                                                echo $result_mov_up['tipo_mov'] == "Descarga" ? 'selected' : '';
                                            } ?>>Descarga</option>
                <option value="GateIN" <?php if (isset($result_mov_up)) {
                                            echo $result_mov_up['tipo_mov'] == "GateIN" ? 'selected' : '';
                                        } ?>>GateIN</option>
                <option value="GateOUT" <?php if (isset($result_mov_up)) {
                                            echo $result_mov_up['tipo_mov'] == "GateOUT" ? 'selected' : '';
                                        } ?>>GateOUT</option>
                <option value="Reposiciona" <?php if (isset($result_mov_up)) {
                                                echo $result_mov_up['tipo_mov'] == "Reposiciona" ? 'selected' : '';
                                            } ?>>Reposicionamento</option>
                <option value="Pesagem" <?php if (isset($result_mov_up)) {
                                            echo $result_mov_up['tipo_mov'] == "Pesagem" ? 'selected' : '';
                                        } ?>>Pesagem</option>
                <option value="Scanner" <?php if (isset($$result_mov_up)) {
                                            echo $result_mov_up['tipo_mov'] == "Scanner" ? 'selected' : '';
                                        } ?>>Scanner</option>
            </select>

            <label for="dt_inicio_mov">Data Inicio</label>
            <input required data-mask="00/00/0000" type="text" name="dt_inicio_mov" id="dt_inicio_mov" value="
            <?php
            if (isset($result_mov_up)) {
                $data_i = implode('/', array_reverse(explode('-', $result_mov_up['dt_inicio_mov'])));
                echo utf8_encode($data_i);
            }
            ?>
            ">
            <label for="dt_fim_mov">Data Término</label>
            <input required data-mask="00/00/0000" type="text" name="dt_fim_mov" id="dt_fim_mov" value="
            <?php
            if (isset($result_mov_up)) {
                $data_f = implode('/', array_reverse(explode('-', $result_mov_up['dt_fim_mov'])));
                echo utf8_encode($data_f);
            }
            ?>
            ">
            <input class="botao btn btn-primary" type="submit" name="submit" value="<?php if (isset($result_mov_up)) {
                                                                                        echo 'Atualizar';
                                                                                    } else {
                                                                                        echo 'Cadastrar';
                                                                                    } ?>">
        </form>
    </div>

    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.0.2/js/dataTables.fixedColumns.min.js"></script>
</body>

</html>

<?php
if (isset($_GET['id_container_del']) && isset($_GET['num_container_del'])) {
    $id_container_del = addslashes($_GET['id_container_del']);
    $num_container_del = addslashes($_GET['num_container_del']);
    $crud_teste->excluirContainer($id_container_del, $num_container_del);
}
?>
<?php
if (isset($_GET['id_mov_del'])) {
    echo 'Passei aqui';
    $id_mov_del = addslashes($_GET['id_mov_del']);
    $crud_teste->excluirMovimento($id_mov_del);
}
?>