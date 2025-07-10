<?php
$host = "10.132.36.3";
$usuario = "bairr1c81f229_lucas";
$senha = "projetointegrador";
$banco = "bairr1c81f229_bairro_online";

$conn = mysqli_connect($host, $usuario, $senha, $banco);
if (!$conn) {
  die("Erro na conexao: " . mysqli_connect_error());
}
?>
