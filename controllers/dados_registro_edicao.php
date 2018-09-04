 <?php 
 // configurações do banco
include("../config/db.php");

$cpf = $_POST['cpf'];
if (!empty($_POST)) {
  if (isset($_POST['cpf'])) {
    if (!empty($_POST['cpf'])) {
      // Query para verificar se tem o cpf no banco
      $sql = "SELECT * FROM pessoa WHERE cpf = '$cpf'";
      if ($result = mysqli_query($mysqli, $sql)) {
        $obj = mysqli_fetch_object($result);

        echo json_encode(
          array(
            'success' => true,
            'nome' => $obj->nome,
            'cpf' => $obj->cpf,
            'dataNascimento' => $obj->dataNascimento,
            'peso' => $obj->peso,
            'uf' => $obj->uf 
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
          'message' => "Cpf não definido"
        )
      );
    }

  }

}


?> 