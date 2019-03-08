<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-08
 * Time: 15:22
 */

class Like
{
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function save(Like $like)
    {
        $query = $this->db->getConnection()->prepare('INSERT INTO camagru.images_has_likes (user_id, 
                                      image_id) 
                            VALUES (:path, :user_id)');
        $query->bindValue(':path', $like->getPath(), PDO::PARAM_STR);
        $query->bindValue(':user_id', $like->getUser(), PDO::PARAM_INT);
        $query->execute();
    }

    public function get(int $id): ?Like
    {
        $query = $this->db->getConnection()->prepare('SELECT * FROM camagru.images WHERE id=:id');
        $query->execute(['id' => $id]);
        $like = $query->fetch(PDO::FETCH_ASSOC);
        if (!$like) {
            return null;
        }
        return new Like($like);
    }

    public function delete(Like $like)
    {
        $query = $this->db->getConnection()->prepare('DELETE FROM camagru.images WHERE id=:id');
        $query->bindParam(':id', $like->getId(), PDO::PARAM_INT);
        $query->execute();
    }
}