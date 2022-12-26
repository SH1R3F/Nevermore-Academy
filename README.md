# Nevermore academy

A simple school system based on Laravel.

---

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/9.x/installation)

Clone the repository

    git clone https://github.com/SH1R3F/Nevermore-Academy.git

Switch to the repo folder

    cd nevermore-academy

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations with seeders (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/SH1R3F/Nevermore-Academy.git
    cd nevermore-academy
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate --seed
