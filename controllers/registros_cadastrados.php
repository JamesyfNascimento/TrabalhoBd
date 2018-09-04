 <?php 
 // configurações do banco
include("../config/db.php");

$sql = "SELECT * FROM pessoa WHERE 1 ORDER BY pessoa.dataCadastro DESC";
// $data = $obj->dataNascimento;
$mensagem_retorno = "";

if ($result = mysqli_query($mysqli, $sql)) {
  while ($obj = mysqli_fetch_object($result)) {
    $data = date("d/m/Y", strtotime($obj->dataNascimento));
    $mensagem_retorno .= "<tr>";
    $mensagem_retorno .= "  <td>$obj->nome </td>";
    $mensagem_retorno .= "  <td>$obj->cpf</td>";
    $mensagem_retorno .= "  <td>$data</td>";
    $mensagem_retorno .= "  <td>$obj->peso</td>";
    $mensagem_retorno .= "  <td>$obj->uf</td>";
    $mensagem_retorno .= "  <td class='text-center'> <a href='#' class='editar' cod='$obj->cpf' ><i class='fas fa-user-edit'></i></a> </td>";
    $mensagem_retorno .= "  <td class='text-center'> <a href='#' class='remove' cod='$obj->cpf' ><i class='fas fa-user-minus'></i></a> </td>";
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
}else{
  echo json_encode(
    array(
      'success' => false,
      'message' => "Erro consulta sql"
    )
  );
}


?> 