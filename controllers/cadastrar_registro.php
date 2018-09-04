<?php 
// configurações do banco
include("../config/db.php");

// valores do formulario recebidos via post
$nome     = $_POST["inputNome"];
$cpf      = $_POST['inputCpf'];
$dataNasc = $_POST["inputDataNasc"];
$peso     = $_POST["inputPeso"];
$uf       = $_POST["selectUF"];
$dataModificacao = date('Y-m-d h:i:s');


// Campos obrigatórios

if (!empty($_POST)) {
  if (isset($_POST['inputCpf']) || isset($_POST['inputNome'])) {
    if (empty($_POST['inputCpf']) || empty($_POST['inputNome'])) {
      echo json_encode(
        array(
          'success' => false,
          'message' => "Os campos marcados com ( * ) são obrigatórios"
        )
      );
      exit;
    }
  }
}


// verifica se o cpf é um cpf válido
if (!validar_cpf($cpf)) {
  echo json_encode(
    array(
      'success' => false,
      'message' => 'O Cpf fornecido não é um cpf válido'
    )
  );
  exit;
} 


 
// Query para verificar se tem o cpf no banco
$results = $mysqli->query("SELECT COUNT(*) FROM pessoa WHERE cpf = '$cpf'");
$get_total_rows = $results->fetch_row();


if ($get_total_rows[0] >= 1) {
  echo json_encode(
    array(
      'success' => false,
      'message' => 'O Cpf fornecido já existe no banco de dados'
    )
  );
}else{ // Caso não exista insere os dados no banco
  $sql = "INSERT INTO pessoa (nome, cpf, dataNascimento, peso, uf, dataModificacao)
        VALUES ('$nome', '$cpf', '$dataNasc', '$peso', '$uf', '$dataModificacao')";

  if ($mysqli->query($sql) === true) {
    echo json_encode(
      array(
        'success' => true,
        'message' => 'Cadastrado com sucesso'
      )
    );
  } else {
    echo json_encode(
      array(
        'success' => false,
        'message' => "Error: " + $mysqli->error
      )
    );
  }

  $mysqli->close();
}




?>