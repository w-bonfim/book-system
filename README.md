## Book System

Projeto desenvolvido no framework CakePHP na versão 4.4 (Versão mais recente até o momento).

## Requisitos

# Instalar no computador as seguintes tecnologias

```bash
- Composer
- PHP 7.4
- MYSQL
```
Acessar o arquivo php.ini e ativar as extensões abaixo

```bash
extension=curl
extension=mbstring
extension=intl
extension=pdo_mysql
extension=pdo_sqlite
extension=openssl
```

## Configuração

# Instação das dependências do projeto

Rode o seguinte comando na pasta raiz da aplicação:

```bash
composer install
```

# Banco de dados

O dump do banco de dados está no endereço abaixo

```bash
config/schema/secto-teca-database.sql
```

Feito isso, acessar o arquivo `config/app_local.php` e configurar `'Datasources'` com os dados de conexão do seu banco de dados


Por fim, rode o seguinte comando para acessar o projeto

```bash
bin/cake server
```



