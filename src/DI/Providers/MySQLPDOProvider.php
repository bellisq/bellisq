<?php

namespace Bellisq\Bellisq\DI\Providers;

use Bellisq\Bellisq\Configs\MySQLConfig;
use Bellisq\TypeMap\DI\Provider;
use Bellisq\TypeMap\DI\Transport\TypeRegister;
use PDO;


/**
 * [Class] MySQL PDO Provider
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 */
class MySQLPDOProvider
    extends Provider
{
    /** @var MySQLConfig */
    private $mySQLConfig;

    /**
     * MySQLPDOProvider constructor.
     *
     * @param MySQLConfig $mySQLConfig
     */
    public function __construct(MySQLConfig $mySQLConfig)
    {
        parent::__construct();
        $this->mySQLConfig = $mySQLConfig;
    }

    /**
     * @inheritdoc
     */
    protected static function registerTypes(TypeRegister $typeRegister): void
    {
        $typeRegister
            ->registerAsSingleton(PDO::class);
    }

    /**
     * @inheritdoc
     */
    protected function instantiateObject(string $type): object
    {
        $cf = $this->mySQLConfig;
        $pdo = new PDO(
            "mysql:host={$cf->host};charset=utf8mb4", $cf->user, $cf->pass,
            [
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION
            ]
        );
        $pdo->query("CREATE DATABASE IF NOT EXISTS {$cf->database} DEFAULT CHARACTER SET utf8mb4; USE {$cf->database};");
        return $pdo;
    }
}