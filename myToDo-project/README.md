# MyToDo

<img src="/img/MyToDo.jpg">

Nome: Caio Eduardo Furtado Leite Lanceta Ramos

Sistema Web para criação de listas to-do, permitindo o cadastro de usuários para criação/edição/remoção/visualização (CRUD) de Quadros (permitindo separação de tarefas entre si) e tarefas. 

As tarefas podem ser marcadas e essa escolha é guardada automaticamente no Banco de Dados.

As rotas são feitas seguindo o padrão RESTful.

Sistema armazena os dados por meio de requisições utilizando o JavaScript com AJAX e/ou Controllers do Laravel.

## Ferramentas e frameworks utilizados
- HTML
- CSS
- PHP
- JavaScript
- AJAX
- Laravel 10.3.3
- ORM Eloquent
- Bootstrap
- MySQL

## Observações
- As Rotas se encontram no arquivo: <a href="https://github.com/CaioLr/myToDo-project/blob/main/myToDo-app/routes/web.php">/mytodo-app/routes/web.php</a>
- Os Controllers se encontram na pasta: <a href="https://github.com/CaioLr/myToDo-project/tree/main/myToDo-app/app/Http/Controllers">/mytodo-app/app/http/controllers/</a>
- As Views se encontram na pasta: <a href="https://github.com/CaioLr/myToDo-project/tree/main/myToDo-app/resources/views">/mytodo-app/resorces/views/</a>
- Os Assets (arquivos CSS e JavaScript) se encontram na pasta: <a href="https://github.com/CaioLr/myToDo-project/tree/main/myToDo-app/public/assets">/mytodo-app/public/assets/</a>
- As Migrations para o BD se encontram na pasta: <a href="https://github.com/CaioLr/myToDo-project/tree/main/myToDo-app/database/migrations">/mytodo-app/database/migrations/</a>

## Instalação
Obs: Necessita do PHP e Composer(https://getcomposer.org) instalados e um banco de dados MySQL.

### Clone o repositório
    $ git clone https://github.com/CaioLr/myToDo-project.git
### Acesse a pasta do projeto (myToDo-app)
    $ cd myToDo-project/myToDo-app 
### Instale as dependências
    $ composer install
### Copie o arquivo .env-example para um arquivo .env
    $ cp .env.example .env
### Verifique os dados para conexão com o DB no arquivo .env
Obs: Coloque os dados correspondente ao seu BD.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mytodo
DB_USERNAME=root
DB_PASSWORD=
```
### Insira no Banco de Dados as tabelas e colunas necessárias:
    $ php artisan migrate
### Gere a chave para a aplicação
    $ php artisan key:generate
### Aplicação instalada, para iniciar o servidor pode utilizar:
    $ php artisan serve

