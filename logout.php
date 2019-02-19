<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-14
 * Time: 18:32
 */

if (isset($_SESSION['user'])) {
    session_destroy();
    header("Location: /login.php");
    exit();
}