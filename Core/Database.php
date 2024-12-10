<?php

namespace Core;

use Exception;
use PDO;
use PDOStatement;

/**
 * Class Database
 *
 * This class provides methods to interact with a database using PDO.
 */
class Database
{
    /**
     * @var PDO $connection The PDO connection instance.
     */
    public PDO $connection;
    /**
     * @var PDOStatement $statement The PDO statement instance.
     */
    public PDOStatement $statement;

    /**
     * Database constructor.
     *
     * @param array  $config   The database configuration.
     * @param string $username The database username.
     * @param string $password The database password.
     */
    public function __construct(
        array $config,
        // TODO: Change the default username and password.
        string $username = 'kiet',
        string $password = 'password',
    ) {
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }

    /**
     * Prepares and executes a SQL query.
     *
     * @param string $sql    The SQL query.
     * @param array  $params The parameters to bind to the query.
     *
     * @return static The current instance for method chaining.
     */
    public function query(string $sql, array $params = []): static
    {
        $this->statement = $this->connection->prepare($sql);
        $this->statement->execute($params);

        return $this;
    }

    /**
     * Fetches a single result from the executed query.
     *
     * @return mixed The fetched result.
     */
    public function find(): mixed
    {
        return $this->statement->fetch();
    }

    /**
     * Fetches all results from the executed query.
     *
     * @return array|false The fetched results or false on failure.
     */
    public function findAll(): array|false
    {
        return $this->statement->fetchAll();
    }

    /**
     * Fetches a single result or aborts if no result is found.
     *
     * @return mixed The fetched result.
     * @throws Exception If no result is found.
     */
    public function findOrFail(): mixed
    {
        $result = $this->find();
        if (!$result) {
            abort(ResponseCode::NOT_FOUND);
        }

        return $result;
    }
}
