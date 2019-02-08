<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-08
 * Time: 20:19
 */

namespace Camagru\Services;


use Camagru\Services\Auth\IAuth;
use Camagru\Entity\User;
use Camagru\Services\Database\Database;

/**
 * Class Auth
 * @package Camagru\Service
 */
class Auth implements IAuth
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function authenticate(User $user)
    {
        $this->db;
    }

    public function register(User $user)
    {
        // TODO: Implement register() method.
    }

    /**
     * @param User $user
     */
    public function resetPassword(User $user)
    {
        // TODO: Implement resetPassword() method.
    }

    public function hashPassword(string $password)
    {
        // TODO: Implement hashPassword() method.
    }
}