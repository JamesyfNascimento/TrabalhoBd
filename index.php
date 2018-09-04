
<?php include("./config/db.php");?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Processo de seleção - Etapa: avaliação técnica</title>

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

    <h1 class="text-center titulo">Processo de seleção - Etapa: avaliação técnica</h1>

    <!-- FORMULARIO DE CADASTRO -->
    <div class="container container-form-cadastro">
      <form id="form-cadastro">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputNome">Nome*</label>
            <input type="text" class="form-control" id="inputNome" name="inputNome" placeholder="Nome">
          </div>
          <div class="form-group col-md-6">
            <label for="inputCpf">CPF*</label>
            <input type="text" class="form-control" id="inputCpf" name="inputCpf" placeholder="CPF">
          </div>
        </div>
        <div class="form-row">

          <div class="form-group col-md-4">
            <label for="inputDataNasc">Data Nascimento</label>
            <input type="date" class="form-control" id="inputDataNasc" name="inputDataNasc">
          </div>
          <div class="form-group col-md-4">
            <label for="inputPeso">Peso - kg</label>
            <input type="text" class="form-control" id="inputPeso" name="inputPeso" placeholder="Peso em kilograma">
          </div>
          <div class="form-group col-md-4">
            <label for="selectUF">UF</label>
            <select id="selectUF" name="selectUF" class="form-control">
              <option selected>Choose...</option>
              <option>...</option>
              <option value="1">...</option>
            </select>
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
            <th scope="col">CPF</th>
            <th scope="col">Data Nascimento</th>
            <th scope="col">Peso</th>
            <th scope="col">UF</th>
            <th class="text-center" scope="col">Editar</th>
            <th class="text-center" scope="col">Deletar</th>
          </tr>
        </thead>
        <tbody>

          <?php 

          $sql = "SELECT * FROM pessoa WHERE 1 ORDER BY pessoa.dataCadastro DESC";

          if ($result = mysqli_query($mysqli, $sql)) {
            while ($obj = mysqli_fetch_object($result)) {
              ;?>
            <tr>
              <td><?php echo $obj->nome ;?></td>
              <td><?php echo $obj->cpf; ?></td>
              <td><?php echo date("d/m/Y", strtotime($obj->dataNascimento)); ?></td>
              <td><?php echo $obj->peso; ?></td>
              <td><?php echo $obj->uf; ?></td>
              <td class="text-center"><a href="#" class="editar" cod="<?php echo $obj->cpf; ?>"><i class="fas fa-user-edit"></i></a></td>
              <td class="text-center"><a href="#" class="remove" cod="<?php echo $obj->cpf; ?>" ><i class="fas fa-user-minus"></i></a></td>
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

    

    <div class="col-xs-12 col-sm-4 retornoForms float-right alert">
        <p class="conteudoRetorno"></p>
    </div>
  </body>
</html>