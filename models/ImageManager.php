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
        $query = $this->db->getConnection()->prepare('INSERT INTO camagru.images (path, user_id) 
                            VALUES (:path, :user_id)');
        $query->bindValue(':path', $image->getPath(), PDO::PARAM_STR);
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

    public function get6(int $limit, int $current)
    {
        $offset = ($current - 1) * $limit;
        $query = $this->db->getConnection()->prepare('SELECT
                                    img.id,
                                    img.path,
                                    img.created_at,
                                    img.user_id,
                                    COUNT(ihl.image_id) AS likes,
                                    u.username FROM camagru.images img
                                    LEFT JOIN users u ON u.id = img.user_id
                                    LEFT JOIN images_has_likes ihl ON img.id = ihl.image_id
                                    GROUP BY img.id
                                    ORDER BY img.created_at DESC
                                    LIMIT :limit OFFSET :offset');
        $query->bindParam('limit', $limit, PDO::PARAM_INT);
        $query->bindParam('offset', $offset, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }

    public function countImages()
    {
        $query = $this->db->getConnection()->prepare('SELECT COUNT(id) FROM camagru.images');
        $query->execute();
        return $query->fetchColumn();
    }
}