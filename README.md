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
    ![name-of-you-image](https://raw.githubusercontent.com/RafaelGCampi/btz-transportes/master/modelagem-btz.PNG)
