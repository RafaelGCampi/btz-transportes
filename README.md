## Sobre o projeto
    Registro de motoristas e veiculos com abastecimento
   
## Como executar
    -composer install
    -npm install
    
##    Criar SCHEMA
    -CREATE SCHEMA `btz-transportes`;
    -copy .env.example .env
    -php artisan key:generate
    -php artisan migrate --seed
    
##    Iniciar servidor
    -php artisan serve

##  Usuário
    email: admin@btz.com
    senha: btz123456
   
## Banco
    ![Screenshot 2020-02-09 at 5 08 54 PM](https://user-images.githubusercontent.com/33011208/74101378-2ef4e880-4b5f-11ea-8e9d-5ae1d811a35a.png)
