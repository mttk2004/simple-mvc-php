## Database Migrations and Seeding

This application uses Phinx for database migrations and seeding. Follow the steps below to manage your database schema and seed data.

### Prerequisites

Ensure you have installed all dependencies using Composer:

```bash
composer install
```

### Configuration

Before running migrations or seeds, ensure your database configuration is set correctly in the `phinx.php` file. This file should contain the correct database connection details.

### Running Migrations

1. **Create a Migration**: To create a new migration, use the following command:
   ```bash
   vendor/bin/phinx create MigrationName
   ```
   Replace `MigrationName` with a descriptive name for your migration.

2. **Write Migration**: Open the newly created migration file in `db/migrations` and define the changes you want to make to the database schema.

3. **Run Migrations**: To apply the migrations and update your database schema, run:
   ```bash
   vendor/bin/phinx migrate
   ```

### Rolling Back Migrations

If you need to undo the last migration, use the following command:
```bash
vendor/bin/phinx rollback
```

### Seeding the Database

1. **Create a Seeder**: To create a new seeder, use the following command:
   ```bash
   vendor/bin/phinx seed:create SeederName
   ```
   Replace `SeederName` with a descriptive name for your seeder.

2. **Write Seeder**: Open the newly created seeder file in `db/seeds` and define the data you want to insert into the database.

3. **Run Seeders**: To insert the seed data into your database, run:
   ```bash
   vendor/bin/phinx seed:run
   ```
   To run a specific seeder, use:
   ```bash
   vendor/bin/phinx seed:run -s SeederName
   ```

### Additional Resources

For more detailed information on using Phinx, refer to the [Phinx documentation](https://book.cakephp.org/phinx/0/en/index.html).

---

By following these steps, you can effectively manage your database schema and seed data using Phinx in this PHP application.

### Author

- [Mai Trần Tuấn Kiệt](https://github.com/mttk2004)

#### Last updated: November 28, 2024
