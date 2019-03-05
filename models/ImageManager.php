<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-05
 * Time: 13:37
 */

require_once 'Db.php';
require_once 'Image.php';

class ImageManager
{
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function save(Image $image)
    {
        $query = $this->db->getConnection()->prepare('INSERT INTO camagru.images (path, created_at, user_id) 
                            VALUES (:path, :created_at,:user_id)');
        $query->bindValue(':path', $image->getPath(), PDO::PARAM_STR);
        $query->bindValue(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $query->bindValue(':user_id', $image->getUser(), PDO::PARAM_INT);
        $query->execute();
    }

    public function get(int $id): ?Image
    {
        $query = $this->db->getConnection()->prepare('SELECT * FROM camagru.images WHERE id=:id');
        $query->execute(['id' => $id]);
        $image = $query->fetch(PDO::FETCH_ASSOC);
        if (!$image) {
            return null;
        }
        return new Image($image);
    }

    public function delete(Image $image)
    {
        $query = $this->db->getConnection()->prepare('DELETE FROM camagru.images WHERE id=:id');
        $query->bindParam(':id', $image->getId(), PDO::PARAM_INT);
        $query->execute();
    }
}