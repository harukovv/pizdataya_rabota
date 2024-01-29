<?php
    session_start();

    function pdo(): PDO
    {
        static $pdo;

        if (!$pdo) 
        {
            $pdo = new PDO("mysql:host=localhost; dbname=Poseidon", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $pdo;
    }
    function check_auth(): bool
    {
    return !!($_SESSION['usr_id'] ?? false);
    }

?>