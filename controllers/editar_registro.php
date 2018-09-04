 <?php 
 // configurações do banco
include("../config/db.php");

header('Content-Type: application/json');

echo json_encode(
  array(
    'success' => true,
    'message' => "Os campos marcados com ( * ) são obrigatórios"
  )
);

?> 