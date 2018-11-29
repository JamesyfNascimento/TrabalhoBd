
<?php include("./config/db.php"); ?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Trabalho Final - Cadastro de Buffet</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/css/all.css" rel="stylesheet">

    <!-- scripts -->
    <script src="./assets/js/jquery-3.3.1.min.js"></script>
    <script src="./assets/js/jquery.mask.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/script.js"></script>


    
  </head>

  <body class="bg-light">

    <h1 class="text-center titulo">Trabalho Final - Cadastro de Buffet</h1>

    <!-- FORMULARIO DE CADASTRO -->
    <div class="container container-form-cadastro">
      <form id="form-cadastro">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputNome">Nome*</label>
            <input type="text" class="form-control" id="inputNome" name="inputNome" placeholder="Nome">
          </div>
          <div class="form-group col-md-4">
            <label for="inputCnpj">Cnpj*</label>
            <input type="text" class="form-control" id="inputCnpj" name="inputCnpj" placeholder="cnpj">
          </div>
          <div class="form-group col-md-4">
            <label for="inputTel">Telefone/Celular</label>
            <input type="tel" class="form-control" id="inputTel" name="inputTel">
          </div>
        </div>
        
        <button type="submit" class="btn btn-dark float-right">Cadastrar</button>
      </form>
    </div>

    <!-- TABELA PARA MOSTRAR OS REGISTROS DO BANCO -->
    <div class="container">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">CNPJ</th>
            <th scope="col">Contato</th>
            <th class="text-center" scope="col">Editar</th>
            <th class="text-center" scope="col">Deletar</th>
          </tr>
        </thead>
        <tbody>

          <?php 

          $sql = "SELECT B.nome, B.cnpj, T.numero FROM `BUFFET` B JOIN `BUFFET_TELEFONES` T ON(B.cnpj = T.BUFFET_cnpj) WHERE 1 ORDER BY B.nome ASC";

          if ($result = mysqli_query($mysqli, $sql)) {
            while ($obj = mysqli_fetch_object($result)) {; ?>
            
            <tr>
              <td><?php echo $obj->nome; ?></td>
              <td><?php echo $obj->cnpj; ?></td>
              <td><?php echo $obj->numero; ?></td>
              <td class="text-center"><a href="#" class="edita" cod="<?php echo $obj->cnpj; ?>"><i class="fas fa-user-edit"></i></a></td>
              <td class="text-center"><a href="#" class="remove" cod="<?php echo $obj->cnpj; ?>" ><i class="fas fa-user-minus"></i></a></td>
            </tr>
              <?php

            }
            // Free result set
            mysqli_free_result($result);
          }
          ?> 
        </tbody>
      </table>
    </div>

    

    <!-- MODAL EDITAR REGISTRO -->
    <div class="modal fade" id="modalEditarRegistro" tabindex="-1" role="dialog" aria-labelledby="modalEditarRegistroLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-edit"></i> Editar Registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <!-- FORM ATUALIZAR REGISTRO -->
            <form id="form-edita-registro">
              <input type="hidden" id="cnpjParaEditar" name="cnpjParaEditar" value="">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputNomeEdit">Nome*</label>
                  <input type="text" class="form-control" id="inputNomeEdit" name="inputNomeEdit" placeholder="Nome">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputCnpjEdit">cnpj*</label>
                  <input type="text" class="form-control" id="inputCnpjEdit" name="inputCnpjEdit" placeholder="cnpj">
                </div>

                <div class="form-group col-md-4">
                  <label for="inputTelEdit">Telefone/Celular</label>
                  <input type="tel" class="form-control" id="inputTelEdit" name="inputTelEdit">
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-dark float-right">Editar</button>
              </div>
            </form>


          </div>
          
        </div>
      </div>
    </div>


    <!-- MODAL DE CONFIRMAÇÃO DA EXCLUSÃO -->
    <div class="modal fade" id="modalConfirmaExclusao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmaExclusaoLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-minus"></i> Excluir Registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4>Deseja realmente excluir esse registro???</h4>           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" id="removerRegistro" class="btn btn-danger float-right">Excluir</button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-4 retornoForms float-right alert">
        <p class="conteudoRetorno"></p>
    </div>
  </body>
</html>