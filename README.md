# Sistema de Gestão de Itens do Serviço de Assistência Técnica

## Dependências

- Docker
- Docker Compose

ou

- Apache 2 (com rewrite modo habilitado);
- PHP 8.0 (com PDO);
- Mysql 8;
- Composer 2.0;


## Configuração

1. Fazer uma cópia do arquivo '.env-example' e renomear para '.env' e editar dados;
2. Baixar as dependências com o comando `docker-compose run --rm composer update`;


## Levantar Servidor

É necessário checar se a porta 8000 já não está sendo usada por outro recurso.

`docker-compose up -d www`


## Derrubar Servidor

`docker-compose down`


## Como acessar

Através do http://localhost:8000/


## Mais informações

- [API](doc/api.md)
- [Sobre o Desenvolvimento do Projeto](doc/about.md)
