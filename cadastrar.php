<?php
include("conexao.php");

// Função de limpeza e segurança dos dados
function limpar($conn, $texto) {
  return mysqli_real_escape_string($conn, trim($texto));
}

// Verifica se os campos foram enviados corretamente
if (
  isset($_POST['nome']) &&
  isset($_POST['telefone']) &&
  isset($_POST['endereco']) &&
  isset($_POST['nome_servico'])
) {
  // Sanitiza os dados recebidos
  $nome     = limpar($conn, $_POST['nome']);
  $telefone = limpar($conn, $_POST['telefone']);
  $endereco = limpar($conn, $_POST['endereco']);
  $servico  = limpar($conn, $_POST['nome_servico']);

  // Validação de telefone (11 dígitos numéricos)
  if (strlen($telefone) !== 11 || !ctype_digit($telefone)) {
    mysqli_close($conn);
    die("Telefone inválido. Certifique-se de digitar DDD + número, sem espaços.");
  }

  // Validação básica dos demais campos
  if ($nome === "" || $endereco === "" || $servico === "") {
    mysqli_close($conn);
    die("Todos os campos são obrigatórios.");
  }

  // Cadastra usuário
  $sql_usuario = "INSERT INTO usuarios (nome, telefone, endereco) VALUES ('$nome', '$telefone', '$endereco')";
  $exec_usuario = mysqli_query($conn, $sql_usuario);

  if ($exec_usuario) {
    $usuario_id = mysqli_insert_id($conn);

    // Cadastra serviço vinculado
    $sql_servico = "INSERT INTO servicos (usuario_id, nome_servico) VALUES ('$usuario_id', '$servico')";
    $exec_servico = mysqli_query($conn, $sql_servico);

    if ($exec_servico) {
      mysqli_close($conn);
      header("Location: index.html?sucesso=1");
      exit;
    } else {
      mysqli_close($conn);
      die("Erro ao cadastrar serviço.");
    }
  } else {
    mysqli_close($conn);
    die("Erro ao cadastrar usuário.");
  }
} else {
  mysqli_close($conn);
  die("Formulário incompleto.");
}
?>
