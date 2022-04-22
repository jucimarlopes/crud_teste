<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    
    <link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />    

    <title>CRUD TESTE</title>
    </head>
    <body>
        <div class="container-fluid p-2"> 
            <div class="container w-50 p-2 h4 bg-primary text-white text-center">Cadastro e Movimentação de Containers</div>
            <br/>             
        </div>
        <div class="table-responsive"> 
            <div class="container w-25 p-2 h4 text-dark text-white text-center">Cadastro</div>        
            <table class="table table-striped table-bordered table-hover">
                <thead class="bg-info text-white text-center">
                    <tr>                        
                        <th scope="col">Número do Container</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Ações</th>
                    </tr>                         
                </thead>        
                <tbody>
                    <tr>                        
                        <td id="num_container" >ABCD1234567</td>
                        <td id="cli_container">Jucimar Alves Lopesaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>
                        <td id="tipo_container">
                            <select class="form-control form-control-sm">
                                <option>20</option>
                                <option>40</option>
                            </select>
                        </td>
                        <td id="status_container">
                            <select class="form-control form-control-sm">
                                <option>Cheio</option>
                                <option>Vazio</option>
                            </select>
                        </td>
                        <td id="categ_container">
                            <select class="form-control form-control-sm">
                                <option>Importação</option>
                                <option>Exportação</option>
                            </select>
                        </td>
                        <td id="acoes_container"><a  href="#" class="btn btn-warning">Editar</a><a href="#" class="btn btn-danger">Excluir</a></td>                                       
                        <caption>
                        <a  href="#" class="btn btn-success">Novo</a>
                        </caption>
                    </tr>            
                </tbody>
            </table>
        </div>
        <hr/>           
        <div class="table-responsive"> 
            <div class="container w-25 p-2 h4 text-dark text-white text-center">Movimentações</div>        
            <table class="table table-striped table-bordered table-hover">
                <thead class="bg-info text-white text-center">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Data e Hora Inicio</th>
                        <th scope="col">Data e Hora Fim</th>                        
                        <th scope="col">Ações</th>
                    </tr>                         
                </thead>        
                <tbody>
                    <tr>
                        <td id="id_mov">000001</td>    
                        <td id="tipo_mov">
                            <select class="form-control form-control-sm">
                                <option>Embarque</option>
                                <option>Descarga</option>
                                <option>Gate IN</option>
                                <option>Gate OUT</option>
                                <option>Reposicionamento</option>
                                <option>Pesagem</option>
                                <option>Scanner</option>
                            </select>
                        </td>
                        <td id="dt_inicio_mov">21/04/2022 - 15:00</td>
                        <td id="dt_fim_mov">
                            <div class="input-group">                            
                                <input type="text" class="date_time" id="date_time"/>
                            </div>
                        </td>                        
                        <td id="acoes_mov"><a  href="#" class="btn btn-warning">Editar</a><a href="#" class="btn btn-danger">Excluir</a></td>                                       
                        <caption>
                        <a  href="#" class="btn btn-success">Novo</a>
                        </caption>
                    </tr>            
                </tbody>
            </table>            
        </div>         

    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>