<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException, PDOStatement;

class Database
{

    private PDO $conncection;
    private PDOStatement $stmt;

    public function __construct(string $driver, array $config, string $username, string $password)
    {
        $config = http_build_query(data: $config, arg_separator: ';');

        $dsn = "{$driver}:{$config}";

        try {
            $this->conncection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Unable to connect to database!");
        }
    }
    public function query(string $query, array $params = []): Database
    {
        $this->stmt = $this->conncection->prepare($query);

        if (!$this->stmt->execute($params)) {
            throw new PDOException();
        }

        return $this;
    }

    public function count()
    {
        return $this->stmt->fetchColumn();
    }

    public function getData()
    {
        return $this->stmt->fetch();
    }

    public function getAllData()
    {
        return $this->stmt->fetchAll();
    }

    public function getUserId()
    {
        return $this->conncection->lastInsertId();
    }
}
