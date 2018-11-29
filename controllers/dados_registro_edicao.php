 <?php 
 // configurações do banco
include("../config/db.php");

$cnpj = $_POST['cnpj'];
if (!empty($_POST)) {
  if (isset($_POST['cnpj'])) {
    if (!empty($_POST['cnpj'])) {
      // Query para verificar se tem o cnpj no banco
      //$sql = "SELECT * FROM BUFFET WHERE cnpj = '$cnpj'";

      $sql = "SELECT B.nome, B.cnpj, T.numero FROM `BUFFET` B JOIN `BUFFET_TELEFONES` T ON(B.cnpj = T.BUFFET_cnpj) ORDER BY B.nome ASC";
      if ($result = mysqli_query($mysqli, $sql)) {

        while ($obj = mysqli_fetch_object($result)) {
          $list[] = array(
            'success' => true,
            'nome' => $obj->nome,
            'cnpj' => $obj->cnpj,
            'telefone' => $obj->numero
          );
        }


        echo json_encode(
          array(
            'success' => true,
            'listaDeBuffets' => $list
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
    } else {
      echo json_encode(
        array(
          'success' => false,
          'message' => "cnpj não definido"
        )
      );
    }

  }

}


?> 