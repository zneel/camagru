<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-08
 * Time: 21:46
 */

namespace Camagru\Model;


use Camagru\Entity\User;
use DateTime;
use PDO;

class UserManager extends Manager
{
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
        $query->bindValue(':verified', $user->getVerified(), PDO::PARAM_BOOL);
        $query->bindValue(':email_hash', $user->getEmailHash(), PDO::PARAM_STR);
        $query->bindValue(':created_at', new DateTime('NOW'), PDO::PARAM_STR);
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
}