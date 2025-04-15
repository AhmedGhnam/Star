<?php

class DbCon {
    
    protected function SqlServerCon() {
        // Connect To Main SQl Server
        $serverName = "82.208.22.49,1433";
        $database = "Test";
        $dbusername  = "TestUser";
        $password = "Tt$%^&***@@#mmmG";
        $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        try {
            $con = new PDO("sqlsrv:Server=$serverName;Database=$database;TrustServerCertificate=true", $dbusername, $password, $option);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        }

        catch(PDOException $e) {
            echo 'Failed To Connect' . $e->getMessage(
            );
        }
    }

    protected function StarCon() {
        
        // Connect To Star DataBase
        $dsn = 'mysql:host=localhost;dbname=star-market';
        $user = 'root';
        $pass = '';
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );

        try {
            $starCon = new PDO($dsn, $user, $pass, $options);
            $starCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $starCon;
        }

        catch(PDOException $e) {
            echo 'Failed To Connect' . $e->getMessage();
        }
    }
       

}