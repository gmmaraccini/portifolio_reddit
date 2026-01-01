Entendido. Aqui está o mesmo texto, mas formatado como texto simples (sem os códigos do Markdown), pronto para você copiar e colar onde precisar (no corpo do LinkedIn, na descrição do YouTube ou em um arquivo de texto comum):

---

TITULO DO PROJETO: Reddit Clone - Laravel 12

RESUMO
Este é um projeto de portfólio desenvolvido para demonstrar habilidades avançadas em modelagem de dados e recursividade utilizando o framework Laravel 12. O objetivo foi criar uma plataforma de discussões onde os comentários podem ter "n" níveis de profundidade (respostas de respostas), similar ao funcionamento do Reddit.

LINKS DO PROJETO
Código Fonte (GitHub): [https://github.com/gmmaraccini/portifolio_reddit](https://www.google.com/search?q=https://github.com/gmmaraccini/portifolio_reddit)
Demonstração em Vídeo: [https://youtu.be/ylr3MXc2DvA](https://youtu.be/ylr3MXc2DvA)

TECNOLOGIAS UTILIZADAS

* Backend: Laravel 12 (PHP 8.2+)
* Banco de Dados: MySQL
* Frontend: Blade Templates + Tailwind CSS
* Interatividade: Alpine.js (para gestão de estado nos formulários de resposta)
* Autenticação: Laravel Breeze (Customizado)

PRINCIPAIS DESAFIOS E SOLUÇÕES

1. Comentários Recursivos (Nested Comments)
   O Desafio: Criar um sistema onde um comentário pode responder a outro infinitamente, sem causar problemas de performance ou complexidade excessiva no código.

A Solução:

* Database: Utilização de auto-relacionamento na tabela 'comments' (coluna parent_id).
* Backend: Uso de Eager Loading aninhado para otimizar as consultas e carregar a árvore de uma vez.
* Frontend: Criação de um Componente Blade Recursivo. O componente verifica se há respostas e "chama a si mesmo", gerando a visualização em escada automaticamente.

2. Customização do Fluxo de Autenticação
   O Desafio: O Laravel Breeze redireciona nativamente para um Dashboard fechado, o que quebra a experiência de um fórum público.

A Solução:

* Refatoração dos Controllers de Auth para redirecionar o usuário diretamente para a Timeline (Home) após login ou registro.
* Adaptação do layout para ocupar a largura total da tela (Desktop).
* Substituição do link "Dashboard" por um botão de "Sair" direto no cabeçalho.

ESTRUTURA DO BANCO DE DADOS (Tabela Comments)

* id: Identificador único
* user_id: Quem fez o comentário
* post_id: A qual post pertence
* parent_id: O Segredo (Aponta para o ID de outro comentário Pai, permitindo a recursividade)
* body: Conteúdo do texto

COMO RODAR O PROJETO LOCALMENTE

1. Clone o repositório:
   git clone [https://github.com/gmmaraccini/portifolio_reddit.git](https://github.com/gmmaraccini/portifolio_reddit.git)
2. Instale as dependências:
   composer install
   npm install && npm run build
3. Configure o ambiente:
   Copie o arquivo .env.example para .env e configure suas credenciais de banco de dados (MySQL).
4. Gere a chave e rode as migrations com seeds:
   (Este comando cria o banco, as tabelas e popula com dados falsos e hierarquia de comentários para teste)
   php artisan key:generate
   php artisan migrate:fresh --seed
5. Inicie o servidor:
   php artisan serve

---

Desenvolvido por Gabriel Maraccini.
