# Kanban - Gerenciamento de Tarefas

Este projeto implementa um sistema de gerenciamento de tarefas no formato Kanban para uma indústria alimentícia, permitindo cadastrar usuários e tarefas, visualizar e atualizar tarefas em três colunas: A Fazer, Fazendo e Pronto.

## Funcionalidades

- **Cadastro de Usuários**: Nome e e-mail (com validação).
- **Cadastro de Tarefas**: Descrição, setor, prioridade (Baixa, Média, Alta), usuário responsável.
- **Gerenciamento de Tarefas**: Visualização em Kanban, edição, exclusão e mudança de status.
- **Interface Responsiva**: Layout funcional com CSS.

## Estrutura do Projeto

- `assets/`: Arquivos estáticos (CSS, JS).
- `includes/`: Arquivos de inclusão (db.php).
- `scripts/`: Scripts SQL e documentação (kanban.sql, TODO.md).
- `pages/`: Páginas HTML/PHP (user_register.php, task_register.php, index.html).
- `api/`: Endpoints CRUD (read.php, create.php, update.php, delete.php).
- `index.php`: Página inicial que redireciona para o Kanban.

## Instalação

1. Configure um servidor PHP com MySQL (ex: XAMPP).
2. Importe o script `scripts/kanban.sql` no phpMyAdmin para criar o banco de dados.
3. Acesse `index.php` no navegador.

## Tecnologias

- PHP 7+
- MySQL
- HTML/CSS/JavaScript

## Requisitos

- Todos os campos são obrigatórios.
- E-mail deve ser válido.
- Status padrão para tarefas: "a fazer".
- Data de cadastro é automática.

## Diagramas

- DER e Caso de Uso devem ser criados conforme especificações (não incluídos aqui).

## Autor

Desenvolvido para revisão de CRUD.
