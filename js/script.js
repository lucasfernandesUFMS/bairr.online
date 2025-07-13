// Aguarda envio do formulário de busca
document.querySelector(".pesquisa-form").addEventListener("submit", function (e) {
  e.preventDefault();
  carregarServicos(1);
});

// Carrega serviços ao abrir a página
window.addEventListener("load", function () {
  carregarServicos(1);
});

// Função principal para carregar serviços da página atual
function carregarServicos(pagina) {
  const campoBusca = document.getElementById("busca");
  const termo = campoBusca ? campoBusca.value.trim() : "";

  fetch(`listar.php?pagina=${pagina}&busca=${encodeURIComponent(termo)}`)
    .then(function (resposta) {
      return resposta.text();
    })
    .then(function (html) {
      const areaServicos = document.getElementById("servicos");
      if (areaServicos) {
        areaServicos.innerHTML = html;
      }
      atualizarPaginacao(pagina, termo);
    })
    .catch(function (erro) {
      console.error("Erro ao carregar serviços:", erro);
    });
}

// Atualiza os botões de paginação com base no total de páginas
function atualizarPaginacao(paginaAtual, termo) {
  fetch(`listar.php?total=1&busca=${encodeURIComponent(termo)}`)
    .then(function (resposta) {
      return resposta.json();
    })
    .then(function (dados) {
      const totalPaginas = dados.total;
      const areaPaginacao = document.getElementById("paginacao");
      if (areaPaginacao) {
        areaPaginacao.innerHTML = "";

        for (let i = 1; i <= totalPaginas; i++) {
          const botao = document.createElement("button");
          botao.innerText = i;
          botao.className = "btn btn-outline-success m-1";
          botao.disabled = i === paginaAtual;
          adicionarEventoPaginacao(botao, i);
          areaPaginacao.appendChild(botao);
        }
      }
    })
    .catch(function (erro) {
      console.error("Erro ao gerar paginação:", erro);
    });
}

// Função separada para evitar função inline no loop
function adicionarEventoPaginacao(botao, numeroPagina) {
  botao.addEventListener("click", function () {
    carregarServicos(numeroPagina);
  });
}
