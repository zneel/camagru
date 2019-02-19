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
                             emailHash, 
                             createdAt, 
                             passwordHash) 
                             VALUES (:username, 
                                     :password, 
                                     :email,
                                     :emailHash, 
                                     :createdAt, 
                                     :passwordHash)');
        $query->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $query->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $query->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':emailHash', $user->getEmailHash(), PDO::PARAM_STR);
        $query->bindValue(':createdAt', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $query->bindValue(':passwordHash', $user->getPasswordHash(), PDO::PARAM_STR);
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
                         camagru.users.emailHash = NULL, 
                         camagru.users.verifiedAt = :verifiedAt 
                        WHERE camagru.users.username = :username
                        AND camagru.users.emailHash= :emailHash');
        $query->bindValue(':verifiedAt', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->bindValue(':emailHash', $emailHash, PDO::PARAM_STR);
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