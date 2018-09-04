<?php 
// configurações do banco
include("../config/db.php");

// valores do formulario recebidos via post
$nome = $_POST["inputNomeEdit"];
$cpf = $_POST['inputCpfEdit'];
$dataNasc = $_POST["inputDataNascEdit"];
$peso = $_POST["inputPesoEdit"];
$uf = $_POST["selectUFEdit"];
$dataModificacao = date('Y-m-d h:i:s');

$cpf_para_editar = $_POST['cpfParaEditar'];



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


 

$sql = "UPDATE pessoa SET pessoa.nome = '$nome', pessoa.cpf = '$cpf', pessoa.dataNascimento = '$dataNasc', pessoa.peso = '$peso', pessoa.uf = '$uf', pessoa.dataModificacao = '$dataModificacao' WHERE cpf = '$cpf_para_editar'";

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