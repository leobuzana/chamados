# 📋 Sistema de Chamados

Sistema web para gerenciamento de chamados com controle de tarefas, feito em **PHP puro (MVC)** com **PostgreSQL**.

## 🧠 Funcionalidades

- ✅ Criar, editar e excluir chamados
- 📄 Visualizar detalhes do chamado
- 🚀 Executar chamado (muda status para "Em andamento")
- ✅ Concluir chamado (somente se todas as tarefas estiverem concluídas)
- 📌 Adicionar, editar, avançar status e excluir tarefas
- ⛔ Impede exclusão de chamado com tarefas vinculadas

## 🗂️ Estrutura
Project/
├── app/
│ ├── Controller/
│ ├── Model/
│ └── View/
├── public/
│ └── css/
├── index.php
└── README.md


## 💾 Banco de Dados

### Tabela `chamado`

| Campo     | Tipo         |
|-----------|--------------|
| id        | SERIAL (PK)  |
| titulo    | VARCHAR(40)  |
| descricao | TEXT         |
| situacao  | SMALLINT     |

### Tabela `tarefas`

| Campo           | Tipo         |
|-----------------|--------------|
| id              | SERIAL (PK)  |
| descricao       | TEXT         |
| nome_responsavel| VARCHAR(40)  |
| status          | SMALLINT     |
| id_chamado      | INT (FK)     |

## Query das tabelas

    CREATE TABLE chamado (
        id serial PRIMARY KEY,
        titulo VARCHAR(40) not null,
        descricao text not null,
        status smallint not null
    );

    CREATE TABLE tarefas (
        id serial PRIMARY KEY,
        descricao text,
        nome_responsavel VARCHAR(40),
        status smallint,
        id_chamado int,
        FOREIGN KEY (id_chamado) REFERENCES chamado(id)
    );

## 🚀 Executar localmente

1. Clone o projeto:
   ```bash
   git clone https://github.com/leobuzana/seu-repo.git

2. Configure o banco PostgreSQL:

3. Crie um banco chamado chamados

4. Atualize as credenciais em ModelChamados.php e ModelTarefas.php

5. Rode no XAMPP (coloque a pasta em htdocs)

🛠️ Tecnologias utilizadas
1. PHP puro (MVC manual)

2. PostgreSQL

3. HTML/CSS

4. XAMPP / Apache

👨‍💻 Autor
Leonardo Buzana
