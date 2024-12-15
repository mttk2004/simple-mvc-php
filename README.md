## Simple MVC PHP Framework
A simple MVC framework designed for simple PHP projects.

### Introduction
This repository, `simple-mvc-php`, is a Simple MVC framework designed for simple PHP projects, created by Mai Trần Tuấn Kiệt. It consists of various components and uses multiple languages such as Twig, CSS, PHP, and JavaScript.

### Getting Started
#### Prerequisites
- Ensure all dependencies are installed using Composer:
  ```bash
  composer install
  ```

#### Installation
1. **Install Dependencies**: Run `composer install` to install the required dependencies.
2. **Set Up Configuration**: Configure the application settings in `Core/config.php`.
3. **Start the Server**: Use a PHP server to run the application, e.g., `php -S localhost:8000 -t public`.

#### Database Migrations and Seeding
- This application uses Phinx for database migrations and seeding. Ensure your database configuration is set correctly in the `phinx.php` file.
- **Create a Migration**:
  ```bash
  vendor/bin/phinx create MigrationName
  ```
- **Run Migrations**:
  ```bash
  vendor/bin/phinx migrate
  ```
- **Create a Seeder**:
  ```bash
  vendor/bin/phinx seed:create SeederName
  ```
- **Run Seeders**:
  ```bash
  vendor/bin/phinx seed:run
  ```

### Components
#### `public/index.php`
The entry point of the application that initializes the session, autoloads dependencies, and routes the request using the `$router` object.

#### `config/`
Contains configuration files for the application, including database settings and application settings.

#### `bootstrap.php`
Sets up the application by creating a new `Container` instance and binding the `Database` class to it.

#### `routes.php`
Defines the application routes using the `Router` class.

#### `Core/Router.php`
Resolves and handles routes based on a given URI and method.

#### `Core/Session.php`
Manages PHP sessions, including starting and destroying sessions, checking if a session key exists, and managing flash messages.

#### `Core/Middleware/Middleware.php`
An abstract class that defines a `handle` method to be implemented by middleware classes.

#### `Http/Controllers`
Contains controllers that handle requests and return responses.

#### `Http/Models`
Contains model classes that interact with the database.

#### `Http/Validators`
Contains validator classes that validate input data.

#### `resources/views`
Contains view files that are rendered by controllers.

#### `resources/css`
Contains CSS files that can be included in views.

#### `utils/helperFunctions.php`
Contains helper functions used throughout the application.

### Testing Guide
- **Install Dependencies**:
  ```bash
  composer install
  ```
- **Install PHPUnit**:
  ```bash
  composer require --dev phpunit/phpunit ^10.0
  ```
- **Configuration**: Ensure you have a `phpunit.xml` file in the root of your project.
- **Writing Tests**: Create test files in the `tests` directory.
- **Running Tests**:
  ```bash
  vendor/bin/phpunit
  ```

### Contribution
To contribute to this project, please follow these steps:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes and commit them (`git commit -m 'Add new feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Create a new Pull Request.

### Author
- [Mai Trần Tuấn Kiệt](https://github.com/mttk2004)

**Last Updated**: December 15, 2024
