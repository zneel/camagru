<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-05
 * Time: 20:27
 */

namespace Camagru\Services\Database;

use PDO;

/**
 * Class Database
 * @package Camagru\Services\Database
 */
class Database
{
    protected $host;
    protected $dbName;
    protected $username;
    protected $password;

    /**
     * Database constructor.
     * @param string $host
     * @param string $dbName
     * @param string $username
     * @param string $password
     */
    public function __construct(string $host, string $dbName, string $username, string $password)
    {
        $this->username = $username;
        $this->host = $host;
        $this->dbName = $dbName;
        $this->password = $password;
    }

    /**
     * @return PDO
     */
    private function connect()
    {
        try {
            $pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName . ';charset=utf8', $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
        return $pdo;
    }
}