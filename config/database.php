<?php

require "constants.php";

$conn = null;

function getConnection()
{
    global $conn;

    if ($conn == null) {
        $conn = new PDO(
            "mysql:host=" . HOST . ";dbname=" . DB_NAME,
            USER_NAME,
            USER_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]
        );
    }
    return $conn;
}

function request(string $sql, ?array $params = null)
{
    try {
        if ($params == null)
            $result = GetConnection()->query($sql);
        else {
            $result = GetConnection()->prepare($sql);
            $result->execute($params);
        }
    } catch (PDOException $e) {
        die($e->getMessage() . "\n");
    }
    return $result;
}
