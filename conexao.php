<?php
// Configurações de acesso ao banco de dados no servidor UOL Host
$host     = "10.132.36.3";
$usuario  = "bairr1c81f229_lucas";
$senha    = "projetointegrador";
$banco    = "bairr1c81f229_bairro_online";

// Cria conexão com o MySQL
$conn = mysqli_connect($host, $usuario, $senha, $banco);

// Verifica se ocorreu erro de conexão
if (!$conn) {
  // Exibe mensagem personalizada e segura
  die("Falha ao conectar com o banco de dados. Tente novamente mais tarde.");
}
?>
