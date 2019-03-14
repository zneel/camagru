<?php
/**
 * Created by PhpStorm.
 * UserManager: ebouvier
 * Date: 2019-02-05
 * Time: 20:27
 */

class Db
{
    protected $host;
    protected $dbName;
    protected $username;
    protected $password;
    private $pdo = null;

    /**
     * Db constructor.
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
    public function getConnection()
    {
        try {
            $this->pdo = new PDO("mysql:dbname=$this->dbName;host=$this->host;;charset=utf8", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
        return $this->pdo;
    }
}