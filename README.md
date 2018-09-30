# OSProjectSkeleton - Documentation

## Summary

- [*About*](#about)
- [*Instruction*](#instruction)
- [*Unit test*](#unit-test)
- [*Configurations*](#configurations)
- [*QuickSheets*](#quicksheets)
- [*Dev-ops*](#dev-ops)

## About

## Instruction

#### Using Docker-compose

```
docker-compose up;
```

#### Using Vagrant

```
vagrant up;
```

## Unit test

```
./vendor/bin/simple-phpunit
```

#### Code Coverage

[http://127.0.0.1:8100/coverage/index.html](http://127.0.0.1:8100/coverage/index.html)

#### Fixing PSR-2 Issue

```
./vendor/bin/php-cs-fixer fix src --rules=@Symfony
./vendor/bin/php-cs-fixer fix tests --rules=@Symfony
```

## Configurations

#### Ports

| Application     | Port | Internal Port | URL                               |
|-----------------|------|---------------|-----------------------------------|
| api             | 8100 | 80            | http://127.0.0.1:8100/            |
| db.             | 8200 | 5432          |                                   |

#### Database

| Field       | Value             |
|-------------|-------------------|
| System      | PostgreSQL        |
| Server/IP   | postgres          |
| Username    | dev               |
| Password    | dev               |
| Database    | osprojectskeleton |

## QuickSheets

- Containers managment

```
docker stop $(docker ps -a -q) ;docker rm $(docker ps -a -q);
docker-compose build --no-cache;
```

## Dev-ops

#### Build and push a Docker image (api)

```
docker login
cd docker/api
docker build -t api .
docker tag api omarsadek/osprojectskeleton
docker push omarsadek/osprojectskeleton
```

#### Build and push a Vagrant image

```
vagrant package --output osprojectskeleton.box
```

Then upload it here : https://app.vagrantup.com


- documentation of the controller with the api auto gen and get an url http://127.0.0.1:8100/app_dev.php/api/doc
- documentation of postman https://documenter.getpostman.com/view/316092/RWgjZgij. ferrer.umar@gmail.com
- Functional test