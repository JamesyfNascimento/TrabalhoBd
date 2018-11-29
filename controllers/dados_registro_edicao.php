 <?php 
 // configurações do banco
include("../config/db.php");

$cnpj = $_POST['cnpj'];
if (!empty($_POST)) {
  if (isset($_POST['cnpj'])) {
    if (!empty($_POST['cnpj'])) {
      // Query para verificar se tem o cnpj no banco
      $sql = "SELECT * FROM BUFFET WHERE cnpj = '$cnpj'";
      if ($result = mysqli_query($mysqli, $sql)) {
        $obj = mysqli_fetch_object($result);

        echo json_encode(
          array(
            'success' => true,
            'nome' => $obj->nome,
            'cnpj' => $obj->cnpj
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