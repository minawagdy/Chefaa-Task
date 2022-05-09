# Chefaa Task

Chefaa-task is Laravel Task.

## Installation

Use composer laravel

```bash
git clone https://github.com/minawagdy/chefaa-task.git
```

## Usage

```Laravel

# Composer update
composer update

# create database 
create database chefaa-task

# create'seeder and migration'
php artisan migrate:fresh --seed

# returns 'cheapest 5 products in pharmacies'
php artisan products:search-cheapest 1 (id)
```
