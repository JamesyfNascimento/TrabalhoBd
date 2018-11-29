 <?php 
 // configurações do banco
include("../config/db.php");

// $sql = "SELECT * FROM BUFFET WHERE 1 ORDER BY BUFFET.nome ASC";
$sql = "SELECT B.nome, B.cnpj, T.numero FROM `BUFFET` B JOIN `BUFFET_TELEFONES` T ON(B.cnpj = T.BUFFET_cnpj) WHERE 1 ORDER BY B.nome ASC";

// $data = $obj->dataNascimento;
$mensagem_retorno = "";

if ($result = mysqli_query($mysqli, $sql)) {
  while ($obj = mysqli_fetch_object($result)) {
    $mensagem_retorno .= "<tr>";
    $mensagem_retorno .= "  <td>$obj->nome </td>";
    $mensagem_retorno .= "  <td>$obj->cnpj</td>";
    $mensagem_retorno .= "  <td>$obj->numero</td>";
    $mensagem_retorno .= "  <td class='text-center'> <a href='#' class='edita' cod='$obj->cnpj' ><i class='fas fa-user-edit'></i></a> </td>";
    $mensagem_retorno .= "  <td class='text-center'> <a href='#' class='remove' cod='$obj->cnpj' ><i class='fas fa-user-minus'></i></a> </td>";
    $mensagem_retorno .= "</tr>";
  }
  // Free result set
  mysqli_free_result($result);

  echo json_encode(
    array(
      'success' => true,
      'message' => $mensagem_retorno
    )
  );
} else {
  echo json_encode(
    array(
      'success' => false,
      'message' => "Erro consulta sql"
    )
  );
}


?> 