# Binance Monitor API

[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

This API is a simple portfolio monitoring API for the [Binance](https://www.binance.com/) trading platform that utilizes the existing [Binance API](https://github.com/binance-exchange/binance-official-api-docs).
User just has to provide his Binance API keys through the environment file and the API endpoints are good to go.

#### Pre-requisites
- Have docker and docker-compose installed in your machine

## Installation(ubuntu)

1. Setup the uid of the php-fpm container to match the the host machine's user uid
- Determine your uid
  ```sh
    $ id
    uid=1001(john) gid=1001(john) groups=1001(john),999(docker)
    
  ```
- update the docker-compose.yml uid variable, i.e:
  ```yaml
  app:
    build:
      args:
        user: admin
        uid: 1001 # <-- john uid
  ```
- create .env file by copying .env.example and set .env file with Binance API keys.
  ```sh
    $ cp .env.example .env
    $ vim .env
  ```
  ```
  BINANCE_KEY=e05f5f5d-78be-4beb-bff3-4bc00c242c78
  BINANCE_SECRET=48ea37d7-3e44-4abd-9ac9-f3b344cb7587
  ```

2. Run the containers
  ```sh
    $ docker-compose up
    
  ```
3. Install composer packages in app container
  ```sh
    $ docker-compose exec app composer install
  ```
  
## Installation(Windows 10)

1. create .env file by copying .env.example-win and set .env file with Binance API keys.
  ```sh
    binance-monitor> copy .env.example-win .env
    binance-monitor> notepad .env
  ```
  ```
  BINANCE_KEY="e05f5f5d-78be-4beb-bff3-4bc00c242c78"
  BINANCE_SECRET="48ea37d7-3e44-4abd-9ac9-f3b344cb7587"
  ```
<em>Pls. note that in Windows, .env variables need to be enclosed in double quotes(")  to avoid errors</em>.  

2. Run the containers using the windows docker compose file
  ```sh
    binance-monitor> docker-compose -f docker-compose-win.yml up
  ```

## Usage
After installation and docker initialization is successful, the API can be accessed through the url: http://localhost:8080


## Installing composer packages

  ```sh
    $ docker-compose exec app composer install
  ```
### Endpoint docs: [ENDPOINTS.md](ENDPOINTS.md)