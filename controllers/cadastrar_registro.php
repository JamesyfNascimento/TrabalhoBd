<?php 
// configurações do banco
include("../config/db.php");

// valores do formulario recebidos via post
$nome = $_POST["inputNome"];
$cnpj = $_POST['inputCnpj'];
$telefone = $_POST["inputTel"];


// Campos obrigatórios

if (!empty($_POST)) {
  if (isset($_POST['inputCnpj']) || isset($_POST['inputNome'])) {
    if (empty($_POST['inputCnpj']) || empty($_POST['inputNome'])) {
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


// verifica se o cnpj é um cnpj válido
if (!validar_cnpj($cnpj)) {
  echo json_encode(
    array(
      'success' => false,
      'message' => 'O cnpj fornecido não é um cnpj válido'
    )
  );
  exit;
} 


// verifica se o cnpj é um cnpj válido
if (!phoneValidate($telefone)) {
  echo json_encode(
    array(
      'success' => false,
      'message' => 'O telefone fornecido não é um telefone válido'
    )
  );
  exit;
} 


 
// Query para verificar se tem o cnpj no banco
$results = $mysqli->query("SELECT COUNT(*) FROM BUFFET WHERE cnpj = '$cnpj'");
$get_total_rows = $results->fetch_row();


if ($get_total_rows[0] >= 1) {
  echo json_encode(
    array(
      'success' => false,
      'message' => 'O cnpj fornecido já existe no banco de dados'
    )
  );
} else { // Caso não exista insere os dados no banco
  $sql = "INSERT INTO BUFFET (cnpj, nome)
        VALUES ('$cnpj', '$nome')";

  $sqlTelBuffet = "INSERT INTO BUFFET_TELEFONES (cnpj, numero)
        VALUES ('$cnpj', '$telefone')";

  if ($mysqli->query($sql) === true) {
    if ($mysqli->query($sqlTelBuffet) === true) {
      echo json_encode(
        array(
          'success' => true,
          'message' => 'Cadastrado com sucesso'
        )
      );
    } else {
      echo json_encode(
        array(
          'success' => true,
          'message' => 'Erro ao inserir o telefone do Buffet'
        )
      );
    }
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