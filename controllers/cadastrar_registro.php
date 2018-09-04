<?php 
// configurações do banco
include("../config/db.php");

// valores do formulario recebidos via post
$nome     = $_POST["inputNome"];
$cpf      = $_POST['inputCpf'];
$dataNasc = $_POST["inputDataNasc"];
$peso     = $_POST["inputPeso"];
$uf       = $_POST["inputUf"];
$dataCadastro = date('Y-m-d h:i:s');


// Campos obrigatórios
if ($nome == "" || $cpf == "") {
 
  echo json_encode(
    array(
      'success' => false,
      'message' => "Os campos marcados com ( * ) são obrigatórios"
    )
  );
  exit;
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
  $sql = "INSERT INTO pessoa (nome, cpf, dataNascimento, peso, uf, dataCadastro)
        VALUES ('$nome', '$cpf', '$dataNasc', '$peso', '$uf', '$dataCadastro')";

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


// função que valida o cpf
function validar_cpf($cpf)
{
  $cpf = preg_replace('/[^0-9]/', '', (string)$cpf);
	// Valida tamanho
  if (strlen($cpf) != 11)
    return false;
  if ($cpf == 11111111111 || $cpf == 22222222222 || $cpf == 33333333333 || $cpf == 44444444444 || $cpf == 55555555555 || $cpf == 66666666666 || $cpf == 77777777777 || $cpf == 88888888888 || $cpf == 99999999999) {
    return false;
  }
	// Calcula e confere primeiro dígito verificador
  for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
    $soma += $cpf {
    $i} * $j;
  $resto = $soma % 11;
  if ($cpf {
    9} != ($resto < 2 ? 0 : 11 - $resto))
    return false;
	// Calcula e confere segundo dígito verificador
  for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
    $soma += $cpf {
    $i} * $j;
  $resto = $soma % 11;
  return $cpf {
    10} == ($resto < 2 ? 0 : 11 - $resto);
}

?>