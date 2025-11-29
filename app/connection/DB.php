<?php

declare(strict_types=1);


namespace App\Connection;

class DB {
    private static ?\PDO $pdo = null;
    // Connect To Star DataBase
    public static function starCon(): \PDO {

        if(!self::$pdo){

            $dotenv = parse_ini_file(__DIR__ . '/../../.env');
            $dsn = "mysql:host={$dotenv['DB_HOST']};dbname={$dotenv['DB_NAME']};charset=utf8";
            try {
                self::$pdo = new \PDO($dsn, $dotenv['DB_USER'], $dotenv['DB_PASS'],
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
            }
            catch(\PDOException $e) {
                echo 'Failed To Connect' . $e->getMessage();
            }

        }

        return self::$pdo;
    }
}

    // Connect To Main SQl Server
    // $serverName = "82.208.22.49,1433";
    // $database = "Test";
    // $username  = "TestUser";
    // $password = "Tt$%^&***@@#mmmG";
    // $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    // try {
    //     $con = new PDO("sqlsrv:Server=$serverName;Database=$database;TrustServerCertificate=true", $username, $password, $option);
    //     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // }

    // catch(PDOException $e) {
    //     echo 'Failed To Connect' . $e->getMessage(
    //     );
    // }


?>