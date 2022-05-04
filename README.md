# test_else

[![Run in Insomnia}](https://insomnia.rest/images/run.svg)](https://insomnia.rest/run/?label=Else%20Teste&uri=https%3A%2F%2Fgithub.com%2Fmicaelcc%2Ftest_else%2Fblob%2Fmain%2FInsomnia_2022-05-04.json)

## Base de dados

![](.github/diagram.png)


## Tecnologias

- [Symfony5](https://symfony.com/5)
- [DoctrineORM](https://www.doctrine-project.org/projects/orm.html)
- [PostgreSQL](https://www.postgresql.org/)
- [PHP8](https://www.php.net/releases/8.0/en.php)

## Rodando com Docker

### Criando .env ###

    Duplique o arquivo .env.example como .env
    
### Buildar e subir containers ###
    docker-compose -f docker-compose.yml up -d --build

### Documentação da Api no navegador
    http://localhost:8000/api/doc

### Rodando testes
    composer tests