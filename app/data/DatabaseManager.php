<?php

namespace App\DB;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DatabaseManager
{
    private static $instance = null;
    private Connection $connection;

    /**
     * Private constructor to prevent direct instantiation.
     */
    private function __construct()
    {
        $env = $_ENV;
        $config = [
            'host' => $env['DB_HOST'],
            'user' => $env['DB_USER'],
            'password' => $env['DB_PASS'],
            'dbname' => $env['DB_DATABASE'],
            'driver' => $env['DB_DRIVER'] ?? 'pdo_mysql',
        ];

        $this->connection = DriverManager::getConnection($config);
    }

    /**
     * Singleton pattern: Get the single instance of Database.
     *
     * @return DatabaseManager
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Get the underlying Doctrine DBAL Connection instance.
     *
     * @return Connection
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }
}
