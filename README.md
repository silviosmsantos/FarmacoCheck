<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=silviosmsantos_FarmacoCheck&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=silviosmsantos_FarmacoCheck)



# FarmacoCheck

Este é um projeto Laravel criado com [Laravel Sail](https://laravel.com/docs/10.x/sail), uma solução Docker para desenvolvimento local. Este guia ensina como rodar o projeto em máquinas com **Linux** e **Windows**.

---

## Requisitos

Certifique-se de ter as seguintes ferramentas instaladas em sua máquina:

- [Docker](https://www.docker.com/) (necessário para rodar o Sail)
- [Git](https://git-scm.com/) (para clonar o repositório)

### Para Windows

Se você estiver no Windows, recomenda-se usar o [Windows Subsystem for Linux (WSL)](https://learn.microsoft.com/en-us/windows/wsl/) para executar o Docker e o Laravel Sail. Certifique-se de instalar o WSL e habilitar a integração com o Docker.

---

## Configuração do Projeto

### 1. Clonar o repositório

Faça o clone deste repositório para sua máquina local:

```bash
git clone https://github.com/silviosmsantos/FarmacoCheck.git
cd FarmacoCheck
```

### 2. Instale as dependências

Execute o composer com o Docker, utilize o comando a seguir para instalar as dependencis do projeto usando a imagem oficial do Laravel Sail:

```bash
docker run --rm \
 -u "$(id -u):$(id -g)" \
 -v "$(pwd):/var/www/html" \
 -w /var/www/html \
 laravelsail/php83-composer:latest \
 composer install --ignore-platform-reqs
```

### 3. Configurar o arquivo .env

crie o arquivo .env com base no exemplo:

```bash
 cp. env.example .env
```

No arquivo .env, configure as variáveis de ambiente necessárias, como o banco de dados, caso seja necessário.

### 4. Subir os conteiners Docker

Inicie o ambiente Docker com o comando:

```bash
./vendor/bin/sail up -d
```

Nota: Se você estiver no Windows usando WSL, execute este comando dentro do terminal Linux.

### 5. Execute as migrações do banco de dados

Aplique as migrações para configurar o banco de dados:

```bash
./vendor/bin/sail artisan migrate
```

# Acesse o projeto

Após configurar, o projeto estará disponível em http://localhost.
Acesse o phpadmin em http://localhost:8001/
