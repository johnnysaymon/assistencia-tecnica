## Dependências

- Docker
- Docker Compose

ou

- Apache 2 (com rewrite modo habilitado);
- PHP 7.4 (com PDO);
- Mysql;
- Composer 2.0;


## Configuração

1. Fazer uma cópia do arquivo '.env-example' e renomear para '.env' e editar dados;
2. Baixar as dependências com o comando `docker-compose run --rm composer update`;


## Levandar Servidor

docker-compose up -d www


## Derrubar Servidor

docker-compose down