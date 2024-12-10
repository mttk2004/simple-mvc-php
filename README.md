# PHP Application

_This is a PHP application that uses a custom routing mechanism, session management, and middleware.
Below is an explanation of how the application works, starting from the `index.php` file._

### `public/index.php`

The `index.php` file is the entry point of the application. It performs the following tasks:

1. **Start Session**: Initializes the session using `session_start()`.
2. **Define Base Path**: Sets the base path of the project.
3. **Autoload Dependencies**: Includes the Composer autoload file to load dependencies.
4. **Load Helper Functions**: Includes a file with helper functions.
5. **Bootstrap the Application**: Includes the `bootstrap.php` file to set up the application.
6. **Load Routes**: Includes the `routes.php` file to define the application routes.
7. **Route the Request**: Gets the URI and method of the request and routes it using the `$router`
   object.
8. **Handle Exceptions**: Catches `ValidationException` and other exceptions to handle errors and
   redirect appropriately.
9. **End Flash Session**: Ends the flash session.

## Components

### `bootstrap.php`

The `bootstrap.php` file sets up the application by creating a new `Container` instance and binding
the `Database` class to it. It then sets the container instance in the `App` class.

### `routes.php`

The `routes.php` file defines the application routes using the `Router` class. It maps URIs to
controllers and can also specify middleware for routes. You can define routes for different HTTP
methods using the `get`, `post`, `put`, `patch`, and `delete` methods.

### `Core/Router.php`

The `Router` class provides a mechanism to resolve and handle routes based on a given URI and
method. It includes methods to add routes (`get`, `post`, `put`, `patch`, `delete`) and a `route`
method to route the request to the appropriate controller. It also includes methods to get the
previous URL and abort the request with a given HTTP status code.

### `Core/Session.php`

The `Session` class provides methods to manage PHP sessions, including starting and destroying
sessions, checking if a session key exists, setting and getting session keys, and managing flash
messages.

### `Core/ValidationException.php`

The `ValidationException` class represents a validation exception that contains errors and old input
data. It includes a static method `throwError` to throw a `ValidationException` with the given
errors and old input data.

### `Core/Middleware/Middleware.php`

The `Middleware` class is an abstract class that defines a `handle` method to be implemented by
middleware classes. It provides a mechanism to execute middleware before and after the request is
routed.

### `Core/Middleware/Auth.php`

The `Auth` middleware class checks if a user is authorized by verifying if a session key `user`
exists. If the user is not authorized, it responds with a `FORBIDDEN` status code.

### `Core/Middleware/Guest.php`

The `Guest` middleware class checks if a user is a guest by verifying if a session key `user` does
not exist. If the user is not a guest, it redirects to the home page.

### `Core/config.php`

The `config.php` file contains configuration settings for the application, such as database
connection details. Change these settings to match your environment.

### `Core/Database.php`

The `Database` class handles database connections and queries. It is bound to the container in
`bootstrap.php`. You can use this class to perform CRUD operations on the database.

### `Core/App.php`

The `App` class manages the application container. It provides methods to set and get the container
instance.

### `Http/controllers`

The `Http/controllers` directory contains controllers that handle requests and return responses.
You can create new controllers in this directory and define methods to handle different routes.

### `Http/Models`

The `Http/Models` directory contains model classes that interact with the database. You can
create new model classes in this directory to represent database tables and perform CRUD operations.

### `resources/views`

The `resources/views` directory contains view files that are rendered by controllers. You can create
new view files in this directory to display content to users.

### `resources/js`

The `resources/js` directory contains JavaScript files that can be included in views.

### `utils/helperFunctions.php`

This file contains helper functions used throughout the application. You can add more helper
functions as needed.

## How to Run the Application

1. **Install Dependencies**: Run `composer install` to install the required dependencies.
2. **Set Up Configuration**: Configure the application settings in `Core/config.php`.
3. **Start the Server**: Use a PHP server to run the application,
   e.g., `php -S localhost:8000 -t public`.

## Conclusion

_This README provides an overview of the application's structure and functionality. Each
component plays a crucial role in handling requests, managing sessions, and routing within the
application. By understanding how these components work together, you can extend and customize the
application to suit your needs._

## Author

- [Mai Trần Tuấn Kiệt](https://github.com/mttk2004)

#### Last updated: November 28, 2024