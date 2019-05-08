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
    public function setId($id)
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
    public function setUsername($username)
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
    public function setPassword($password)
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
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getVerified_At()
    {
        return $this->verifiedAt;
    }

    /**
     * @param mixed $verifiedAt
     */
    public function setVerified_At($verifiedAt)
    {
        $this->verifiedAt = $verifiedAt;
    }

    /**
     * @return mixed
     */
    public function getEmail_Hash()
    {
        return $this->emailHash;
    }

    /**
     * @param mixed $emailHash
     */
    public function setEmail_Hash($emailHash)
    {
        $this->emailHash = $emailHash;
    }

    /**
     * @return mixed
     */
    public function getPassword_Hash()
    {
        return $this->passwordHash;
    }

    /**
     * @param mixed $passwordHash
     */
    public function setPassword_Hash($passwordHash)
    {
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return mixed
     */
    public function getCreated_At()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreated_At($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getReceive_Emails()
    {
        return $this->receiveEmails;
    }

    /**
     * @param mixed $receiveEmails
     */
    public function setReceive_Emails($receiveEmails)
    {
        $this->receiveEmails = $receiveEmails;
    }
}