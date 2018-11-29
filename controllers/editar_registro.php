<?php 
// configurações do banco
include("../config/db.php");

// valores do formulario recebidos via post
$nome = $_POST["inputNomeEdit"];
$cnpj = $_POST['inputCnpjEdit'];

$cnpj_para_editar = $_POST['cnpjParaEditar'];



// Campos obrigatórios

if (!empty($_POST)) {
  if (isset($_POST['inputCnpjEdit']) || isset($_POST['inputNomeEdit'])) {
    if (empty($_POST['inputCnpjEdit']) || empty($_POST['inputCnpjEdit'])) {
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




$sql = "UPDATE BUFFET SET BUFFET.nome = '$nome', BUFFET.cnpj = '$cnpj' WHERE BUFFET.cnpj = '$cnpj_para_editar'";

if ($mysqli->query($sql) === true) {
  echo json_encode(
    array(
      'success' => true,
      'message' => 'Editado com sucesso'
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





?>