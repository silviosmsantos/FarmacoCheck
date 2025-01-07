<p align="center"><a href="https://orca-app-9k2ie.ondigitalocean.app/" target="_blank"><img src="https://github.com/silviosmsantos/FarmacoCheck/blob/main/farmacocheckSVG.svg" width="450" alt="Laravel Logo"></a></p>

<p align="center">
  <a href="https://github.com/silviosmsantos/FarmacoCheck/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://pestphp.com">
    <img src="https://img.shields.io/badge/Tested_with-Pest-7b42bc" alt="Tested with Pest">
  </a>
    <a href="https://github.com/silviosmsantos/FarmacoCheck/runs/34810727501">
    <img src="https://sonarcloud.io/api/project_badges/measure?project=silviosmsantos_FarmacoCheck&metric=alert_status" alt="Quality Gate Status">
  </a>
  <a href="https://github.com/silviosmsantos/FarmacoCheck/commits/main">
    <img src="https://img.shields.io/github/last-commit/silviosmsantos/FarmacoCheck" alt="Last Commit">
  </a>
  <a href="https://laravel.com/docs/11.x">
    <img src="https://img.shields.io/badge/Laravel-Documentation-orange" alt="Laravel Documentation">
  </a>
  <a href="https://www.php.net/">
    <img src="https://img.shields.io/badge/PHP-8.1-blue" alt="PHP 8.1">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
  </a>
</p>


# FarmacoCheck

Farmaco-Check-App é uma aplicação Laravel construída utilizando Laravel Breeze e TALL Stack (Tailwind, AlphineJS, Laravel e Livewire), banco de dados MySQL e testes configurados com Pest. Este projeto foi criado com o objetivo princiapl de se tornar uma ferramenta para consulta de interações entre medicamentos. A aplicação possui outras funcionalidades importantes como: autenticação de usuários, controle de permissões, gerenciamento de usuários. 
Este guia ensina como rodar o projeto em máquinas com **Linux** e **Windows**.

---

## Requisitos

Antes de começar, verifique se você possui os seguintes requisitos instalados em sua máquina:

- [PHP](https://www.php.net/downloads) >= 8.1
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) >= 16.x
- [NPM](https://www.npmjs.com/) ou [Yarn](https://yarnpkg.com/)
- [MySQL](https://dev.mysql.com/downloads/)
- [Git](https://git-scm.com/)

### Para Windows

Se você estiver no Windows, recomenda-se usar o [Windows Subsystem for Linux (WSL)](https://learn.microsoft.com/en-us/windows/wsl/) para executar o Docker e o Laravel Sail. Certifique-se de instalar o WSL e habilitar a integração com o Docker.

---


## Como configurar e executar o projeto

### 1. Clone o repositório

Abra o terminal e execute:

```bash
git clone https://github.com/silviosmsantos/farmaco-check-app.git
cd farmaco-check-app
```

### 2. Instale as dependências do projeto

Execute o seguinte comando para instalar as dependências PHP:

```bash
composer install
```

Em seguida, instale as dependências JavaScript:

```bash
npm install
```

### 3. Configurar o arquivo .env

Crie o arquivo `.env` a partir do exemplo:

```bash
cp .env.example .env
```

Atualize as informações do banco de dados no arquivo `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

No arquivo .env, configure as variáveis de ambiente como as veriáveis do banco de dados e demais variáveis que julgue necessário.

### 4. Gere a chave da aplicação

```bash
php artisan key:generate
```

### 5. Execute as migrações do banco de dados

Crie as tabelas no banco de dados e execute os seeds:

```bash
php artisan migrate --seed
```

Esse comendo irá realizar a migração do banco e povoar algumas tabelas, se possível faça a verificação nas tabelas do seu banco.

### 6. Compile os assets do frontend

Para compilar os arquivos estáticos:

- **Para desenvolvimento:**
  ```bash
  npm run dev
  ```
- **Para produção:**
  ```bash
  npm run build
  ```

### 7. Inicie o servidor local

Execute o servidor local para acessar a aplicação:

```bash
php artisan serve
```

A aplicação estará disponível em: `http://127.0.0.1:8000`

### 8. Executando os testes

Para rodar os testes (com Pest):

```bash
php artisan test
```

Para saber sobre a cobertura dos testes(test coverage) é preciso ter o Xdebug instalado. Para verificar a cobertura de testes execute:

```bash
php artisan test --coverage
```

## Comandos adicionais para sistemas operacionais diferentes

### Linux/MacOS
- **Criar o arquivo .env:**
  ```bash
  cp .env.example .env
  ```
- **Iniciar servidor local:**
  ```bash
  php artisan serve
  ```

### Windows
- **Criar o arquivo .env:**
  ```cmd
  copy .env.example .env
  ```
- **Iniciar servidor local:**
  ```cmd
  php artisan serve
  ```

## Contribuições

Sinta-se à vontade para abrir issues ou enviar pull requests para melhorias no projeto, toda ajuda é bem-vinda! :D

---

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

### Nota
Na minha máquina roda...(risos)! Mas caso enfrente problemas, verifique os requisitos de versão e se todas as dependências foram instaladas corretamente. Em caso de dúvidas, consulte a [documentação oficial do Laravel](https://laravel.com/docs).
