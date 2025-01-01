# api-michelin-restaurants

Nome: Caio Eduardo Furtado Leite Lanceta Ramos

API com intuito de buscar/armazenar/deletar dados relacionados a restaurants que já ganharam estralas Michelin. 

As rotas são feitas seguindo o padrão RESTful.

## Ferramentas e frameworks utilizados
- PHP
- Laravel 10.3.3
- ORM Eloquent
- MySQL
- JWT

## Observações
- As Rotas se encontram no arquivo: <a href="https://github.com/CaioLr/api-michelin-restaurants/blob/main/api-app/routes/api.php">/api-app/routes/api.php</a>
- Os Controllers se encontram na pasta: <a href="https://github.com/CaioLr/api-michelin-restaurants/tree/main/api-app/app/Http/Controllers">/api-app/app/Http/Controllers/</a>
- Os Assets (JSON prontos para testar a API) se encontram na pasta: <a href="https://github.com/CaioLr/api-michelin-restaurants/tree/main/api-app/resources/jsons">/api-app/resources/jsons/</a>
- As Migrations para o BD se encontram na pasta: <a href="https://github.com/CaioLr/api-michelin-restaurants/tree/main/api-app/database/migrations">/api-app/database/migrations/</a>



## Instalação
Obs: Necessita do PHP e Composer(https://getcomposer.org) instalados e um banco de dados MySQL.

### Clone o repositório
    $ git clone https://github.com/CaioLr/api-michelin-restaurants.git
### Acesse a pasta do projeto (api-app)
    $ cd api-michelin-restaurants/api-app 
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
DB_DATABASE=michelin_restaurants
DB_USERNAME=root
DB_PASSWORD=
```
### Insira no Banco de Dados as tabelas e colunas necessárias:
    $ php artisan migrate
#### Note que existe Seeder para gerar automaticamente usuários:
Localizados em: <a href="https://github.com/CaioLr/api-michelin-restaurants/blob/main/api-app/database/seeders/DatabaseSeeder.php">/api-app/database/seeders/DatabaseSeeder.php</a>
Caso não esteja no seu BD:
    $  php artisan migrate:fresh --seed
### Gere a chave para a aplicação
    $ php artisan key:generate
### Gere a chave para o JWT
    $ php artisan jwt:secret
### Aplicação instalada, para iniciar o servidor pode utilizar:
    $ php artisan serve

## Documentação
Para utilizar os endpoints siga a documentação no Swagger abaixo:
    $ php artisan l5-swagger:generate
Depois entrar pela url: http://127.0.0.1:8000/api/documentation
#### Obs: Existem JSONs prontos para testar a API na pasta:
<a href="https://github.com/CaioLr/api-michelin-restaurants/tree/main/api-app/resources/jsons">/api-app/resources/jsons/</a> 
