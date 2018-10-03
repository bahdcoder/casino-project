## About Casino project

this is a basic project that gives logged in users the ability to edit and save json settings

## How to run project
 - clone this repository
 - run `composer install` to install all dependencies
 - create a `.env` file using the example template.
 - Run migrations with `php artisan migrate`
 - Run database seeds with `php artisan db:seed`
 - Start application, visit it and log in. 
 - Select any of the games, and edit its settings.

#### Features implemented
 - Json settings validation
 - Display json in json editor
 - Make ajax requests to store json data
 - Display success message
 - Display error messages if settings update process fails
