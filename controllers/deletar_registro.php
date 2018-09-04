 <?php 
// configurações do banco
include("../config/db.php");

// cpf a ser deletado
$cpf = $_POST['cpf'];


if(!empty($_POST)) {
  if(isset($_POST['cpf'])) {
    if (!empty($_POST['cpf'])) {
      // Query para verificar se tem o cpf no banco
      $sql = "DELETE FROM pessoa WHERE cpf = '$cpf'";
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
    } else{
      echo json_encode(
        array(
          'success' => false,
          'message' => "Cpf não definido"
        )
      );
    }

  }

}



?> 