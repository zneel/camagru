<?php
/**
 * Created by PhpStorm.
 * UserManager: ebouvier
 * Date: 2019-02-05
 * Time: 21:42
 */

include 'database.php';
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname = ' . $DB_NAME . 'charset = utf8', $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->query("use " . $DB_NAME);
    echo "\033[31mCreating tables... 🔥\033[0m\n";
    echo "\033[31mCreating tables users... 🔥\033[0m\n";
    $pdo->query($DB_USERS);
    echo "\033[31mCreating tables images... 🔥\033[0m\n";
    $pdo->query($DB_IMAGES);
    echo "\033[31mCreating tables images_has_likes... 🔥\033[0m\n";
    $pdo->query($DB_IMAGES_HAS_LIKES);
    echo "\033[31mCreating tables comments... 🔥\033[0m\n";
    $pdo->query($DB_COMMENTS);
    echo "\033[32mDone! 🙆‍♂️\033[0m\n";
} catch (Exception $e) {
    echo $e->getMessage();
}
