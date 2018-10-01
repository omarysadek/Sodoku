# Sodoku plus - Documentation

## Summary

- [*About*](#about)
- [*Instruction*](#instruction)
- [*Unit test*](#unit-test)
- [*Configurations*](#configurations)
- [*QuickSheets*](#quicksheets)
- [*Dev-ops*](#dev-ops)

## About

What is Sudoku Plus?

Sudoku Plus is a game which follows all the same rules of Sudoku but has a grid of
variable size. A Sudoku Plus board might be 4x4, 9x9, etc. All valid grids will have the following
characteristics:
1. The grid will be square (same number of rows and columns). The length of a side should have a integer
value square root. Valid side lengths would include: 4, 9,16, etc.
2. The grid can be divided into square regions of equal size where the size of a region is equal to the
square root of a side of the entire grid. Each region will have the same number of cells as rows in the grid.
On a 16x16 grid there would be 16 regions of size 4x4.
3. The numbers that can be used are in the range from 1 to N where N is the length of a side.

Input should be in the form of a CSV (comma-separated value) text file
with columns separated by commas and rows separated by ‘\n’ return characters.

## Instruction

#### Using Docker-compose

```
git clone git@github.com:omarysadek/Sodoku.git
cd Sodoku
sudo docker-compose up;
```

> "init_api exited with code 0"

#### Using Vagrant

```
git clone git@github.com:omarysadek/Sodoku.git
cd Sodoku
vagrant up;
```
> "init_api exited with code 0"

## Unit test

```
sudo docker exec -it api /bin/bash
./vendor/bin/simple-phpunit
```

#### Code Coverage

[http://127.0.0.1:8100/coverage/index.html](http://127.0.0.1:8100/coverage/index.html)

#### Fixing PSR-2 Issue

```
sudo docker exec -it api /bin/bash
./vendor/bin/php-cs-fixer fix src --rules=@Symfony
./vendor/bin/php-cs-fixer fix tests --rules=@Symfony
```

## Configurations

#### Ports

| Application     | Port | Internal Port | URL                               |
|-----------------|------|---------------|-----------------------------------|
| api             | 8100 | 80            | http://127.0.0.1:8100/            |
| db              | 8200 | 5432          |                                   |

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
sudo docker stop $(sudo docker ps -a -q) ;sudo docker rm $(sudo docker ps -a -q); #kill all containers
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
