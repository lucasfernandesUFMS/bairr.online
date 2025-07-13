<?php
include("conexao.php");

// Busca e paginação
$busca   = isset($_GET['busca'])   ? mysqli_real_escape_string($conn, trim($_GET['busca'])) : '';
$pagina  = isset($_GET['pagina'])  ? max(1, intval($_GET['pagina'])) : 1;
$limite  = 10;
$offset  = ($pagina - 1) * $limite;

// Retorno total de páginas (chamado pelo script.js)
if (isset($_GET['total']) && $_GET['total'] == 1) {
  $sql_total = "SELECT COUNT(*) AS total FROM servicos s 
                JOIN usuarios u ON s.usuario_id = u.id";

  if ($busca !== '') {
    $sql_total .= " WHERE s.nome_servico LIKE '%$busca%'";
  }

  $res = mysqli_query($conn, $sql_total);
  $row = mysqli_fetch_assoc($res);
  $total_paginas = ceil($row['total'] / $limite);

  echo json_encode(['total' => $total_paginas]);
  exit;
}

// Consulta para listar os serviços com filtro e limite
$sql = "SELECT s.nome_servico, u.nome, u.telefone, u.endereco 
        FROM servicos s 
        JOIN usuarios u ON s.usuario_id = u.id";

if ($busca !== '') {
  $sql .= " WHERE s.nome_servico LIKE '%$busca%'";
}

$sql .= " ORDER BY s.id DESC LIMIT $limite OFFSET $offset";

$res = mysqli_query($conn, $sql);

// Geração dos cards em HTML para exibição dinâmica
while ($row = mysqli_fetch_assoc($res)) {
  $nome         = htmlspecialchars($row['nome']);
  $servico      = htmlspecialchars($row['nome_servico']);
  $endereco     = htmlspecialchars($row['endereco']);
  $telefone_raw = htmlspecialchars($row['telefone']);

  $zap = "https://wa.me/55$telefone_raw";
  $telFormatado = "(" . substr($telefone_raw, 0, 2) . ") " . substr($telefone_raw, 2, 5) . "-" . substr($telefone_raw, 7);

  echo "<div class='col-md-4'>";
  echo "  <div class='card card-servico p-3 shadow-sm'>";
  echo "    <h5>$nome</h5>";
  echo "    <p><strong>$servico</strong></p>";
  echo "    <p>$endereco</p>";
  echo "    <p>Telefone: $telFormatado 
            <a href='$zap' target='_blank' class='btn btn-sm btn-success ms-2'>WhatsApp</a></p>";
  echo "  </div>";
  echo "</div>";
}
?>
