 <?php 
// configurações do banco
include("../config/db.php");

// cnpj a ser deletado
$cnpj = $_POST['cnpj'];


if (!empty($_POST)) {
  if (isset($_POST['cnpj'])) {
    if (!empty($_POST['cnpj'])) {
      // Query para verificar se tem o cnpj no banco
      $sql = "DELETE FROM BUFFET WHERE cnpj = '$cnpj'";
      if ($mysqli->query($sql) === true) {
        echo json_encode(
          array(
            'success' => true,
            'message' => 'Removido com sucesso'
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