<?php

namespace Bellisq\Bellisq\Providers;

use Bellisq\Fundamental\Config\Standard\MySQLConfig;
use Bellisq\TypeMap\DI\Provider;
use Bellisq\TypeMap\DI\Transport\TypeRegister;
use PDO;


/**
 * [Class] MySQL PDO Provider
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 */
class MySQLPDOProvider
    extends Provider
{
    /** @var MySQLConfig */
    private $mySQLConfig;

    public function __construct(MySQLConfig $mySQLConfig)
    {
        parent::__construct();
        $this->mySQLConfig = $mySQLConfig;
    }

    protected static function registerTypes(TypeRegister $typeRegister): void
    {
        $typeRegister
            ->registerAsSingleton(PDO::class);
    }

    protected function instantiateObject(string $type): object
    {
        $cf = $this->mySQLConfig;
        return new PDO(
            "mysql:host={$cf->host};dbname={$cf->database};charset=utf8mb4", $cf->user, $cf->pass,
            [
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}