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
                             verified, 
                             email_hash, 
                             created_at, 
                             password_hash) 
                             VALUES (:username, 
                                     :password, 
                                     :email, 
                                     :verified, 
                                     :email_hash, 
                                     :created_at, 
                                     :password_hash)');
        $query->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $query->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $query->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':verified', false, PDO::PARAM_BOOL);
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
        return new UserManager($user);
    }

    public function delete(User $user)
    {
        $query = $this->db->getConnection()->prepare('DELETE FROM camagru.users WHERE id=:id');
        $query->bindParam(':id', $user->getId(), PDO::PARAM_INT);
        $query->execute();
    }
}