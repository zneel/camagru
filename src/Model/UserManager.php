<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-08
 * Time: 21:46
 */

namespace Camagru\Model;


use Camagru\Entity\User;

class UserManager extends Manager
{
    public function save(User $user)
    {
        $this->db->getConnection()->prepare('INSERT INTO `camagru`.users (username,
                             password, 
                             email, 
                             verified, 
                             email_hash, 
                             created_at, 
                             password_hash) 
                             VALUES ()');
    }
}