# Getting Started

## Installation

Please check the official laravel installation guide for server requirements before you start.[Offical Documentation](https://laravel.com/docs/7.x/installation)

Clone the repository

    SSH: git clone git@github.com:Engjellb/Instagram.git
    
    HTTPS: git clone https://github.com/Engjellb/Instagram.git
    
Switch to the repo folder

    cd Instagram

Install dependencies listed in composer.json

    composer install

Install dependecies listed in package.json

    npm install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000