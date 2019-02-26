<?php
/**
 * Created by PhpStorm.
 * UserManager: ebouvier
 * Date: 2019-02-12
 * Time: 18:33
 */
require_once 'Db.php';
require_once 'User.php';

class UserManager
{
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function save(User $user)
    {
        $query = $this->db->getConnection()->prepare('INSERT INTO camagru.users (username,
                             password, 
                             email,
                             email_hash, 
                             created_at, 
                             password_hash) 
                             VALUES (:username, 
                                     :password,
                                     :email,
                                     :email_hash, 
                                     :created_at, 
                                     :password_hash)');
        $query->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $query->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $query->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':email_hash', $user->getEmail_Hash(), PDO::PARAM_STR);
        $query->bindValue(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $query->bindValue(':password_hash', $user->getPassword_Hash(), PDO::PARAM_STR);
        $query->execute();
    }

    public function get(int $id): ?User
    {
        $query = $this->db->getConnection()->prepare('SELECT * FROM camagru.users WHERE id=:id');
        $query->execute(['id' => $id]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            return null;
        }
        return new User($user);
    }

    public function delete(User $user)
    {
        $query = $this->db->getConnection()->prepare('DELETE FROM camagru.users WHERE id=:id');
        $query->bindParam(':id', $user->getId(), PDO::PARAM_INT);
        $query->execute();
    }

    public function activateUser(string $username, string $emailHash)
    {
        $query = $this->db->getConnection()->prepare('UPDATE camagru.users SET 
                         camagru.users.email_hash = NULL, 
                         camagru.users.verified_at = :verified_at 
                        WHERE camagru.users.username = :username
                        AND camagru.users.email_hash= :email_hash');
        $query->bindValue(':verified_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->bindValue(':email_hash', $emailHash, PDO::PARAM_STR);
        $query->execute();
    }

    public function resetPassword()
    {
        // TODO
    }

    public function getUserByUsername(string $username)
    {
        $query = $this->db->getConnection()->prepare('SELECT * FROM camagru.users WHERE camagru.users.username=:username');
        $query->execute(['username' => $username]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (empty($user)) {
            return null;
        }
        return new User($user);
    }

    public function updateProfile(int $id, array $values, bool $updatePwd)
    {
        $user = $this->get($id);
        $user->setUsername($values['username']);
        if ($updatePwd) {
            $user->setPassword($values['password']);
        }
        $user->setEmail($values['email']);
        $user->setReceive_Emails($values['receive_emails'] == 'on' ? 1 : 0);
        $query = $this->db->getConnection()->prepare('UPDATE camagru.users SET
                         camagru.users.username = :username,
                         camagru.users.email = :email,
                         camagru.users.password = :password,
                         camagru.users.receive_emails = :receive_emails
                        WHERE camagru.users.id = :id');
        $query->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $query->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $query->bindValue(':receive_emails', $user->getReceive_Emails(), PDO::PARAM_STR);
        $query->bindValue(':id', $user->getId(), PDO::PARAM_STR);
        $query->execute();
        return $this->get($id);
    }

    public function getUserByEmail(string $email)
    {
        $query = $this->db->getConnection()->prepare('SELECT * FROM camagru.users WHERE email=:email');
        $query->execute(['email' => $email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (empty($user)) {
            return null;
        }
        return new User($user);
    }

    public function generatePasswordHash(int $id, string $hash)
    {
        $query = $this->db->getConnection()->prepare('UPDATE camagru.users SET 
                         camagru.users.password_hash = :hash
                        WHERE camagru.users.id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':hash', $hash, PDO::PARAM_STR);
        $query->execute();
    }

    public function getUserByUsernameAndPasswordHash(string $username, string $hash)
    {
        $query = $this->db->getConnection()->prepare('SELECT * FROM camagru.users 
                    WHERE username=:username
                    AND password_hash=:password_hash');
        $query->execute(['username' => $username, 'password_hash' => $hash]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (empty($user)) {
            return null;
        }
        return new User($user);
    }

    public function changePassword(User $user)
    {
        $query = $this->db->getConnection()->prepare('UPDATE camagru.users SET 
                         camagru.users.password_hash = NULL,
                         camagru.users.password = :password
                        WHERE camagru.users.id = :id');
        $query->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $query->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $query->execute();
    }
}