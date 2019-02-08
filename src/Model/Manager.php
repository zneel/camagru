<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-08
 * Time: 21:53
 */

namespace Camagru\Model;


use Camagru\Services\Database\Database;

abstract class Manager
{
    protected $db;

    /**
     * Manager constructor.
     * @param Database $db
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
}