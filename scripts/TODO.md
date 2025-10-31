# Lista de Tarefas para Implementar o Kanban Completo

1. **Atualizar db.php**: Criar tabelas `usuarios` (id, nome, email) e `tarefas` (id, usuario_id, descricao, setor, prioridade, data_cadastro, status). Exportar script como kanban.sql. ✅
2. **Criar user_register.php**: Tela de cadastro de usuários com campos nome e email (obrigatórios), validação de email, mensagem de sucesso. ✅
3. **Criar task_register.php**: Tela de cadastro de tarefas com campos descricao, setor, prioridade (baixa, média, alta), usuario (select), status padrão 'a fazer', data atual. Suporte a edição com pré-preenchimento. ✅
4. **Atualizar index.html**: Adicionar menu para navegação. Modificar Kanban para mostrar tarefas com detalhes (descricao, setor, prioridade, usuario). Botões para editar (redirecionar para task_register.php), excluir (com confirmação), mover status. ✅
5. **Atualizar read.php**: Buscar tarefas com join para usuarios, retornar dados completos. ✅
6. **Atualizar create.php**: Ajustar para novos campos de tarefas (usado por task_register.php). ✅
7. **Atualizar update.php**: Ajustar para novos campos de tarefas. ✅
8. **Atualizar delete.php**: Ajustar para excluir tarefas. ✅
9. **Atualizar style.css**: Ajustar estilos para navegação, formulários e tarefas. ✅
10. **Testar aplicação**: Verificar funcionalidades de cadastro, edição, exclusão e movimento de status.
