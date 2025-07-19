document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);
  const chamadoId = params.get("chamado");
  if (chamadoId) {
    const h1 = document.querySelector("h1");
    h1.textContent = `Tarefas do Chamado #${chamadoId}`;
  }

  const tarefas = [
    { descricao: "Verificar login do usuário", responsavel: "João", status: 1 },
    {
      descricao: "Trocar papel da impressora",
      responsavel: "Maria",
      status: 2,
    },
    {
      descricao: "Liberar acesso ao sistema",
      responsavel: "Carlos",
      status: 3,
    },
  ];
  const tbody = document.getElementById("lista-chamados");
  const form = document.getElementById("form-tarefa");

  let editIdx = null;

  function renderTarefas() {
    tbody.innerHTML = "";
    tarefas.forEach((tarefa, idx) => {
      const statusClass =
        tarefa.status === 1
          ? "status-aberto"
          : tarefa.status === 2
          ? "status-andamento"
          : "status-finalizado";
      const statusText =
        tarefa.status === 1
          ? "Pendente"
          : tarefa.status === 2
          ? "Em Andamento"
          : "Concluída";

      if (editIdx === idx) {
        tbody.innerHTML += `
          <tr>
            <td>${idx + 1}</td>
            <td><input type="text" id="edit-descricao" class="input-edit" value="${
              tarefa.descricao
            }" /></td>
            <td><input type="text" id="edit-responsavel" class="input-edit" value="${
              tarefa.responsavel
            }" /></td>
            <td>
              <select id="edit-status" class="input-edit">
                <option value="1" ${
                  tarefa.status === 1 ? "selected" : ""
                }>Pendente</option>
                <option value="2" ${
                  tarefa.status === 2 ? "selected" : ""
                }>Em Andamento</option>
                <option value="3" ${
                  tarefa.status === 3 ? "selected" : ""
                }>Concluída</option>
              </select>
            </td>
            <td >
              <button class="action-btn btn-small save-btn">Salvar</button>
              <button class="action-btn btn-small cancel-btn">Cancelar</button>
            </td>
          </tr>
        `;
      } else {
        tbody.innerHTML += `
          <tr>
            <td>${idx + 1}</td>
            <td>${tarefa.descricao}</td>
            <td>${tarefa.responsavel}</td>
            <td><span class="pill ${statusClass}">${statusText}</span></td>
            <td>
              <span class="action-icon edit-icon" data-idx="${idx}" title="Editar">
                <svg width="20" height="20" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12.3 3.7l4 4M3 17v-4.24a2 2 0 0 1 .59-1.41l8.72-8.72a2 2 0 0 1 2.83 0l2.83 2.83a2 2 0 0 1 0 2.83l-8.72 8.72A2 2 0 0 1 7.24 17H3z"/>
                </svg>
              </span>
              <span class="action-icon delete-icon" data-idx="${idx}" title="Excluir">
                <svg width="20" height="20" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="6" width="14" height="11" rx="2"/>
                  <path d="M8 10v4M12 10v4"/>
                  <path d="M5 6V4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2"/>
                  <line x1="1" y1="6" x2="19" y2="6"/>
                </svg>
              </span>
            </td>
          </tr>
        `;
      }
    });

    // Adiciona eventos de clique
    document.querySelectorAll(".edit-icon").forEach((icon) => {
      icon.onclick = function () {
        editIdx = parseInt(this.getAttribute("data-idx"));
        renderTarefas();
      };
    });

    document.querySelectorAll(".delete-icon").forEach((icon) => {
      icon.onclick = function () {
        const idx = parseInt(this.getAttribute("data-idx"));
        tarefas.splice(idx, 1);
        if (editIdx === idx) editIdx = null;
        renderTarefas();
      };
    });

    // Botão salvar
    const saveBtn = document.querySelector(".save-btn");
    if (saveBtn) {
      saveBtn.onclick = function () {
        const descricao = document
          .getElementById("edit-descricao")
          .value.trim();
        const responsavel = document
          .getElementById("edit-responsavel")
          .value.trim();
        const status = parseInt(document.getElementById("edit-status").value);
        if (descricao && responsavel) {
          tarefas[editIdx] = { descricao, responsavel, status };
          editIdx = null;
          renderTarefas();
        }
      };
    }

    // Botão cancelar
    const cancelBtn = document.querySelector(".cancel-btn");
    if (cancelBtn) {
      cancelBtn.onclick = function () {
        editIdx = null;
        renderTarefas();
      };
    }
  }

  renderTarefas();

  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      const descricao = document.getElementById("descricao").value.trim();
      const responsavel = document.getElementById("responsavel").value.trim();
      if (descricao && responsavel) {
        tarefas.push({ descricao, responsavel, status: 1 });
        renderTarefas();
        form.reset();
      }
    });
  }
});
