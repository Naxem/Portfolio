<?php
    function connexion_bdd()
    {
        $host = 'localhost:3306';
        $db   = 'ap2';
        $user = 'root';
        $pass = '';
        $dsn = "mysql:host=$host;dbname=$db";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        }
        catch (\PDOException $e) {
            print"ERREUR:".$e;
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        return $pdo;
    }//fin connexion_bdd
?>