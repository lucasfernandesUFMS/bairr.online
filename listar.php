<?php
include("conexao.php");

$sql = "SELECT s.nome_servico, u.nome, u.telefone, u.endereco
        FROM servicos s
        JOIN usuarios u ON s.usuario_id = u.id
        ORDER BY s.id DESC";

$res = mysqli_query($conn, $sql);
$dados = [];

while ($row = mysqli_fetch_assoc($res)) {
  $dados[] = $row;
}

echo json_encode($dados);
?>
