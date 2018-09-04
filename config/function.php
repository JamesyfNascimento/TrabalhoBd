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
?>