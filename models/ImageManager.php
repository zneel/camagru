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

    public function get(int $id): ?array
    {
        $query = $this->db->getConnection()->prepare('SELECT
                                    img.id,
                                    img.path,
                                    img.created_at,
                                    img.user_id,
                                    COUNT(ihl.image_id) AS likes,
                                    u.username FROM camagru.images img
                                    LEFT JOIN users u ON u.id = img.user_id
                                    LEFT JOIN images_has_likes ihl ON img.id = ihl.image_id
                                    WHERE img.id = :id
                                    GROUP BY img.id');
        $query->execute(['id' => $id]);
        $image = $query->fetch(PDO::FETCH_ASSOC);
        if (!$image) {
            return null;
        }
        return $image;
    }

    public function delete(int $id)
    {
        $query = $this->db->getConnection()->prepare('DELETE FROM camagru.images WHERE id=:id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
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

    public function getUserFromImageId(int $id)
    {
        $query = $this->db->getConnection()->prepare('SELECT img.*, u.email, u.receive_emails
                                    FROM camagru.images img
                                    LEFT JOIN users u ON u.id = img.user_id
                                    WHERE img.id = :id');
        $query->execute(['id' => $id]);
        $image = $query->fetch(PDO::FETCH_ASSOC);
        if (!$image) {
            return null;
        }
        return $image;
    }

    public function getImagesByUserId(int $user_id)
    {
        $query = $this->db->getConnection()->prepare('SELECT * FROM camagru.images
                                    WHERE camagru.images.user_id= :user_id
                                    ORDER BY camagru.images.created_at DESC');
        $query->execute(['user_id' => $user_id]);
        $image = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!$image) {
            return null;
        }
        return $image;
    }
}