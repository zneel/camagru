<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-08
 * Time: 20:13
 */

namespace Camagru\Entity;

use Camagru\Services\Database\Database;

class User extends Database
{
    private $username;
    private $password;
    private $email;
    private $verified;
    private $emailHash;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {

        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * @param mixed $verified
     */
    public function setVerified($verified): void
    {
        $this->verified = $verified;
    }

    /**
     * @return mixed
     */
    public function getEmailHash()
    {
        return $this->emailHash;
    }

    /**
     * @param mixed $emailHash
     */
    public function setEmailHash($emailHash): void
    {
        $this->emailHash = $emailHash;
    }
}