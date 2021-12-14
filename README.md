### Hexlet tests and linter status:
[![Actions Status](https://github.com/yulia633/php-project-lvl4/workflows/hexlet-check/badge.svg)](https://github.com/yulia633/php-project-lvl4/actions)


[![Maintainability](https://api.codeclimate.com/v1/badges/e8f6eafa501c2c3f3290/maintainability)](https://codeclimate.com/github/yulia633/php-project-lvl4/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/e8f6eafa501c2c3f3290/test_coverage)](https://codeclimate.com/github/yulia633/php-project-lvl4/test_coverage)
![linter and tests](https://github.com/yulia633/php-project-lvl4/workflows/linter%20and%20tests/badge.svg)


### Установка в Docker

1. Подготовить файл *.env*

    ```sh
    make env-prepare
    ```

2. Указать параметры подключения к БД в файле *.env*

    ```dotenv
    DB_CONNECTION=pgsql
    DB_HOST=database
    DB_PORT=5432
    DB_DATABASE=postgres
    DB_USERNAME=postgres
    DB_PASSWORD=secret
    ```

3. Собрать и запустить приложение

    ```sh
    make compose-setup # собрать проект
    make compose-start # запустить сервер http://127.0.0.1:8000/
    make compose-bash  # запустить сессию bash в docker-контейнере
    make test          # запустить тесты в docker-контейнере
    make db-prepare    # накатить миграции в docker-контейнере
    ```

### Ссылка на приложение

https://julbel-task-manager.herokuapp.com/
