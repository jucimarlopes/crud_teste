<?php

require_once 'crud_teste.php';
$crud_teste = new Crud_Teste();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <!-- CSS Customizado -->
    <link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <title>Cadastro e Movimentação de Containers</title>
    <?php
    //Cadastrar Container
    if (isset($_POST['num_container']) && !empty($_POST['num_container'])) {
        $cliente_container_ins = addslashes($_POST['cliente_container']);
        $num_container_ins = addslashes($_POST['num_container']);
        $tipo_container_ins = addslashes($_POST['tipo_container']);
        $status_container_ins = addslashes($_POST['status_container']);
        $categoria_container_ins = addslashes($_POST['categoria_container']);
        $crud_teste->cadastrarContainer($cliente_container_ins, $num_container_ins, $tipo_container_ins, $status_container_ins, $categoria_container_ins);
    }

    //Cadastrar Movimento
    {
        if (isset($_POST['num_container']) && empty($_POST['num_container'])) {
            $num_container_ins = addslashes($_POST['num_container']);
            $tipo_mov_ins = addslashes($_POST['tipo_mov']);
            $data_inicio_mov = addslashes($_POST['data_inicio_mov']);
            $data_fim_mov = addslashes($_POST['data_fim_mov']);
            $crud_teste->cadastrarMovimento($num_container_ins, $tipo_mov_ins, $data_inicio_mov, $data_fim_mov);
        }
    }
    ?>
    <?php
    // Atualizar Container
    if (isset($_GET['id_container_udp']) && !empty($_GET['id_container_udp'])) {
        $id_container_udp = addslashes($_GET['id_container']);
        $cliente_container_upd = addslashes($_POST['cliente_container']);
        $num_container_udp = addslashes($_POST['num_container']);
        $tipo_container_udp = addslashes($_POST['tipo_container']);
        $status_container_udp = addslashes($_POST['status_container']);
        $categoria_container_udp = addslashes($_POST['categoria_container']);
        $crud_teste->atualizarContainer($id_container_udp, $cliente_container_udp, $num_container_udp, $tipo_container_udp, $status_container_udp, $categoria_container_udp);
    }
    // Atualizar Movimento
    if (isset($_GET['id_mov_udp']) && !empty($_GET['id_mov_udp'])) {
        $id_mov_udp = addslashes($_GET['id_mov_udp']);
        $num_container_udp = addslashes($_POST['num_container']);
        $tipo_mov_udp = addslashes($_POST['tipo_mov']);
        $data_inicio_udp = addslashes($_POST['data_inicio_mov']);
        $data_fim_udp = addslashes($_POST['data_fim_mov']);
        $crud_teste->atualizarMovimento($id_mov_udp, $num_container_udp, $tipo_mov_udp, $data_inicio_udp, $data_fim_udp);
    }
    ?>
</head>

<body>
    <table id="listarContainers" class="table table-striped table-hover table-bordered ">
        <thead text-align="center">Cadastro de Containers</thead>
        <tr>
            <th>Código</th>
            <th>Cliente</th>
            <th>Número</th>
            <th>Tipo</th>
            <th>Status</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>
        <tbody>
        <?php
            $listagem_containers = array();
            $listagem_container = $crud_teste->listarMovimentos();
            if(count($listagem_containers)>0)
            {
                for($i=0;$i<count($listagem_containers);$i++)
                {
                     echo "<tr>";
                     foreach ($listagem_containers[$i] as $l => $v)
                     {
                        echo '<td>' . utf8_encode($v) . '</td>';
                     }
                     echo "<td>
                     <a class='btn-primary'>Editar</a>
                     <a>Excluir</a>
                     <a>Movimentar</a>
                     </td>";
                }
                echo "</tr>";
            }
            ?>  
        </tbody>
    </table>
    <hr>

    <table id="listarMovimentacoes" class="table table-striped table-hover table-bordered">
    <thead>Cadastro de Movimentação</thead>
    
        <tr>
            <th>Código</th>
            <th>Número</th>
            <th>Tipo</th>
            <th>Data Inicio</th>
            <th>Data Fim</th>
            <th>Ações</th>
        </tr>
        <tbody>
            <?php
            $listagem_movs = array();
            $listagem_movs = $crud_teste->listarMovimentos();
            if(count($listagem_movs)>0)
            {
                for($i=0;$i<count($listagem_movs);$i++)
                {
                     echo "<tr>";
                     foreach ($listagem_movs[$i] as $l => $v)
                     {
                        echo '<td>' . utf8_encode($v) . '</td>';
                     }
                     echo "<td><a>Editar</a><a>Excluir</a></td>";
                }
                echo "</tr>";
            }
            ?>  
        </tbody>
    </table>
    <hr>    
    <form method="POST" class="form-control" id="form_container">
        <label for="id_container">CÓDIGO</label>
        <input readonly type="text" id="id_container" name="id_container">

        <label for="cliente_container">CLIENTE</label>
        <input required type="text" id="cliente_container" name="cliente_container">

        <label for="num_container">NÚMERO</label>
        <input required type="text" id="num_container" name="num_container">

        <label for="tipo_container">TIPO</label>
        <select required id="tipo_container" name="tipo_container">
            <option value="">Selecione</option>
            <option value="20">20</option>
            <option value="40">40</option>
        </select>

        <label for="status_container">STATUS</label>
        <select required id="status_container" name="status_container">
            <option value="">Selecione</option>
            <option value="Cheio">Cheio</option>
            <option value="Vazio">Vazio</option>
        </select>

        <label for="categoria_container">CATEGORIA</label>
        <select required id="categoria_container" name="categoria_container">
            <option value="">Selecione</option>
            <option value="Importação">Importação</option>
            <option value="Exportação">Exportação</option>
        </select>
        <hr>
        <input type="submit" value="Atualziar/Cadastrar" name="cadastrar_container">
    </form>    
    <hr>
    <form method="POST" class="form-control" id="form_movimentos">
        <label for="id_mov">NÚMERO</label>
        <input readonly type="text" id="id_mov" name="id_mov">

        <label for="num_container">NÚMERO</label>
        <input readonly type="text" id="num_container" name="num_container">


        <label for="tipo_mov">CÓDIGO</label>
        <select required id="tipo_mov" name="tipo_mov">
            <option value="">Selecione</option>
            <option value="Embarque">Embarque</option>
            <option value="Descarga">Embarque</option>
            <option value="GateIN">Embarque</option>
            <option value="GateOUT">Embarque</option>
            <option value="Reposicionamento">Embarque</option>
            <option value="Pesagem">Embarque</option>
            <option value="Scanner">Embarque</option>
        </select>

        <label for="data_inicio_mov">CÓDIGO</label>
        <input required type="text" id="data_inicio_mov" name="data_inicio_mov">

        <label for="data_fim_mov">CÓDIGO</label>
        <input required type="text" id="data_fim_mov" name="data_fim_mov">

        <hr>
        <input type="submit" value="Atualizar/Cadastrar" name="cadastrar_mov">

    </form>
</body>
<?php
//Excluir Container
if (isset($_GET['id_container_del']) && !empty($_GET['id_container_del'])) {
    if (isset($_GET['num_container_mov_del']) && !empty($_GET['num_container_mov_del'])) {
        $id_container_del = addslashes($_GET['id_container_del']);
        $num_container_mov_del = addslashes($_GET['num_container_mov_del']);
        $crud_teste->deletarContainer($id_mov_del, $id_container_del);
    }
}
// Excluir Movimento
if (isset($_GET['id_mov_del']) && !empty($_GET['id_mov_del'])) {
    $id_mov_del = addslashes($_GET['id_mov_del']);
    $crud_teste->deletarMov($id_mov_del);
}
?>
</html>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>