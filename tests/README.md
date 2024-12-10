## PHP Application Testing Guide

This guide provides instructions on how to write and execute tests using PHPUnit in this PHP application.

### Prerequisites

Ensure you have installed all dependencies using Composer, including PHPUnit:

```bash
composer install
```


### Setting Up PHPUnit

1. **Install PHPUnit**: PHPUnit should already be installed as a development dependency. If not, you can add it using:
   ```bash
   composer require --dev phpunit/phpunit ^10.0
   ```

2. **Configuration**: Ensure you have a `phpunit.xml` file in the root of your project. This file should look like this:
   ```xml
   <?xml version="1.0" encoding="UTF-8"?>
   <phpunit bootstrap="vendor/autoload.php"
            colors="true"
            verbose="true">
       <testsuites>
           <testsuite name="Application Test Suite">
               <directory>tests</directory>
           </testsuite>
       </testsuites>
   </phpunit>
   ```

### Writing Tests

1. **Create a Test File**: All test files should be placed in the `tests` directory. Test files should have the suffix `Test.php`.

2. **Example Test**: Here is an example of a simple test case:
   ```php
   <?php

   use PHPUnit\Framework\TestCase;

   class ExampleTest extends TestCase
   {
       public function testExample()
       {
           $this->assertTrue(true);
       }
   }
   ```

3. **Test Structure**: Each test class should extend `PHPUnit\Framework\TestCase`. Each test method should be public and start with the word `test`.

### Running Tests

1. **Execute Tests**: Run all tests using the following command:
   ```bash
   vendor/bin/phpunit
   ```

2. **Run Specific Test**: To run a specific test file, provide the path to the test file:
   ```bash
   vendor/bin/phpunit tests/ExampleTest.php
   ```

### Best Practices

- **Test Coverage**: Aim to cover all critical parts of your application with tests.
- **Naming Conventions**: Use descriptive names for test methods to clearly indicate what is being tested.
- **Assertions**: Use a variety of assertions provided by PHPUnit to validate different conditions.

### Additional Resources

For more detailed information on using PHPUnit, refer to the [PHPUnit documentation](https://phpunit.de/documentation.html).

### Conclusion

By following this guide, you can effectively write and execute tests for your PHP application, ensuring code quality and reliability.

### Author

- [Mai Trần Tuấn Kiệt](https://github.com/mttk2004)

#### Last updated: December 10, 2024
