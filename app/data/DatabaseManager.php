<?php

namespace App\DB;

use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;

class DatabaseManager
{
    private static $instance = null;
    private EntityManager $entityManager;

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

        $ORMConfig = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . '/entities'],
            isDevMode: true
        );

        $ORMConfig->setProxyDir('/Applications/XAMPP/xamppfiles/htdocs/LearnerSpace/app/data/DoctrineORMModule/Proxy');
        $ORMConfig->setProxyNamespace('App\Proxy');
        $ORMConfig->setAutoGenerateProxyClasses(true);

        $connection = DriverManager::getConnection($config, $ORMConfig);
        $this->entityManager = new EntityManager($connection, $ORMConfig);
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
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}
