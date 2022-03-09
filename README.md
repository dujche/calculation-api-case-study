# Calculation API case study

This repository contains demonstration of a simple REST API doing 4 basic arithmetic operations. 

API endpoints are designed as [RESTful controller resources](https://restfulapi.net/resource-naming/) (section 2.1.4), as the act as executable functions (arithmetic operations on parameters).

Implementation is done in [Symfony](https://symfony.com/), using PHP 8.0.

## Requirements

*   Docker on the host machine

## Initial setup

1. Run docker-compose in the root folder:

    ```shell
    docker-compose build
    docker-compose up
    ```
   
2. (Optional) To run the unit test suites, go with the following procedure:

   ```shell
    docker-compose -f docker-compose-dev.yml build
    docker-compose -f docker-compose-dev.yml up
    docker exec -it calculation-api-case-study_php-calculation-api_1 bash
    vendor/bin/phpunit (on the container)
    ```

## Available endpoints

Solution contains two show-cases:

1) (API V1) Single action controller, with operation as part of the URL; Contains less code, but has the service container as dependency.

2) (API V2) Multiple action controller, one per operation; Contains more code, but more understandable and gets dependencies injected per route (action).

Please check the OpenAPI specification and [static html documentation](https://htmlpreview.github.io/?https://github.com/dujche/calculation-api-case-study/blob/main/docs/redoc-static.html) in the [docs](https://github.com/dujche/calculation-api-case-study/blob/main/docs) folder.


