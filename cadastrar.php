<?php
include("conexao.php");

function limpar($conn, $texto) {
  return mysqli_real_escape_string($conn, trim($texto));
}

$nome     = limpar($conn, $_POST['nome']);
$telefone = limpar($conn, $_POST['telefone']);
$endereco = limpar($conn, $_POST['endereco']);
$servico  = limpar($conn, $_POST['servico']);

if(strlen($telefone) !== 11 || !is_numeric($telefone)) {
  die("Telefone inválido.");
}

$sql_usuario = "INSERT INTO usuarios (nome, telefone, endereco) VALUES ('$nome', '$telefone', '$endereco')";
mysqli_query($conn, $sql_usuario);
$usuario_id = mysqli_insert_id($conn);

$sql_servico = "INSERT INTO servicos (usuario_id, nome_servico) VALUES ('$usuario_id', '$servico')";
mysqli_query($conn, $sql_servico);

mysqli_close($conn);
header("Location: index.html?sucesso=1");
exit;
?>
