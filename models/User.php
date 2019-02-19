<?php
/**
 * Created by PhpStorm.
 * UserManager: ebouvier
 * Date: 2019-02-08
 * Time: 20:13
 */

class User
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $verifiedAt;
    private $emailHash;
    private $passwordHash;
    private $createdAt;
    private $receiveEmails;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
    public function getVerifiedAt()
    {
        return $this->verifiedAt;
    }

    /**
     * @param mixed $verifiedAt
     */
    public function setVerifiedAt($verifiedAt): void
    {
        $this->verifiedAt = $verifiedAt;
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

    /**
     * @return mixed
     */
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    /**
     * @param mixed $passwordHash
     */
    public function setPasswordHash($passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getReceiveEmails()
    {
        return $this->receiveEmails;
    }

    /**
     * @param mixed $receiveEmails
     */
    public function setReceiveEmails($receiveEmails): void
    {
        $this->receiveEmails = $receiveEmails;
    }
}