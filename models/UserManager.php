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
        $query = $this->db->getConnection()->prepare('INSERT INTO `camagru`.users (username,
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
        $query->bindValue(':email_hash', $user->getEmailHash(), PDO::PARAM_STR);
        $query->bindValue(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $query->bindValue(':password_hash', $user->getPasswordHash(), PDO::PARAM_STR);
        $query->execute();
    }

    public function get($id)
    {
        $query = $this->db->getConnection()->prepare('SELECT * FROM camagru.users WHERE id=:id');
        $query->bindParam(':id', $id);
        $user = $query->fetch(PDO::FETCH_ASSOC);
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
            return [];
        }
        return new User($user);
    }
}