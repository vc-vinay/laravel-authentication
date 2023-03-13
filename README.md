# Laravel Authentication

## Minimum requirements

    PHP  >= 8.0
    Composer 2.0
## Check version compatibility
    
	php -v
    composer -v
    This project runs with Laravel version 10.3.3
## Installation

Assuming you've already installed on your machine: PHP (>= 8.0.0), [Laravel](https://laravel.com), [Composer](https://getcomposer.org)

Clone the repository

    git clone https://github.com/vc-vinay/laravel-authentication.git

Switch to the repo folder

    cd laravel-authentication

    git fetch --all

Assuming you've already installed composer on your machine: 2.0.11, [Composer](https://getcomposer.org)

    composer self-update or composer self-update --2

Switch git branch in your local
    
    main - for production
    
    development - for staging

    git checkout development

Create your branch for your work.

    git checkout -b your-branch-name from development branch
    Please follow the GIT standards mentioned in this file

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Start the local development server

    php artisan serve
    
    You can now access the server at http://localhost:8000

Or You can create virtual host and execute the project in your local syste.


Project Setup Command Lists

    git clone https://github.com/vc-vinay/laravel-authentication.git
    cd  laravel-authentication
    git fetch --all
    git checkout development
    git checkout -b your-branch-name from development
    composer install
    cp .env.example .env
    php artisan key:generate 
    php artisan serve

## CODING STANDARD

Please see [CODINGSTANDARD](CODINGSTANDARD.md) for details.

## GIT STANDARD

Please see [GITSTANDARD](GITSTANDARD.md) for details.
