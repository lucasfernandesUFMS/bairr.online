fetch("listar.php")
  .then(res => res.json())
  .then(data => {
    const container = document.getElementById("servicos");
    container.innerHTML = "";
    data.forEach(item => {
      const zap = `https://wa.me/55${item.telefone}`;
      const telFormatado = `(${item.telefone.slice(0,2)}) ${item.telefone.slice(2,7)}-${item.telefone.slice(7)}`;
      const card = document.createElement("div");
      card.className = "col-md-4";
      card.innerHTML = `
        <div class="card card-servico p-3 shadow-sm">
          <h5>${item.nome}</h5>
          <p><strong>${item.nome_servico}</strong></p>
          <p>${item.endereco}</p>
          <p>Telefone: ${telFormatado}
            <a href="${zap}" target="_blank" class="btn btn-sm btn-success ms-2">WhatsApp</a>
          </p>
        </div>
      `;
      container.appendChild(card);
    });
  })
  .catch(error => {
    console.error("Erro ao carregar serviços:", error);
  });
