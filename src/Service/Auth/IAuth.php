<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-08
 * Time: 20:20
 */

namespace Camagru\Services\Auth;

use Camagru\Entity\User;

interface IAuth
{
    public function authenticate(User $user);

    public function register(User $user);

    public function resetPassword(User $user);

    public function hashPassword(string $password);
}