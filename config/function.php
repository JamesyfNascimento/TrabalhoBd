<?php 
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

function validar_cnpj($cnpj)
{
  $cnpj = preg_replace('/[^0-9]/', '', (string)$cnpj);
    // Valida tamanho
  if (strlen($cnpj) != 14)
    return false;
    // Valida primeiro dígito verificador
  for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
    $soma += $cnpj {
      $i} * $j;
    $j = ($j == 2) ? 9 : $j - 1;
  }
  $resto = $soma % 11;
  if ($cnpj {
    12} != ($resto < 2 ? 0 : 11 - $resto))
    return false;
    // Valida segundo dígito verificador
  for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
    $soma += $cnpj {
      $i} * $j;
    $j = ($j == 2) ? 9 : $j - 1;
  }
  $resto = $soma % 11;
  return $cnpj {
    13} == ($resto < 2 ? 0 : 11 - $resto);
}

// A função abaixo demonstra o uso de uma expressão regular que identifica, de forma simples, telefones válidos no Brasil.
// Nenhum DDD iniciado por 0 é aceito, e nenhum número de telefone pode iniciar com 0 ou 1.
// Exemplos válidos: +55 (11) 98888-8888 / 9999-9999 / 21 98888-8888 / 5511988888888

function phoneValidate($phone)
{
  $regex = '/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/';
  if (preg_match($regex, $phone) == false) {
            // O número não foi validado.
    return false;
  } else {
            // Telefone válido.
    return true;
  }
}
?>