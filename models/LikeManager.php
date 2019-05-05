<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-08
 * Time: 15:22
 */

class LikeManager
{
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function likeDislike(int $user_id, int $image_id)
    {
        try {
            $conn = $this->db->getConnection();
            $checkLike = $conn->prepare('SELECT COUNT(*) AS liked FROM camagru.images_has_likes 
                                                    WHERE user_id=:user_id 
                                                    AND image_id=:image_id');
            $checkLike->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $checkLike->bindValue(':image_id', $image_id, PDO::PARAM_INT);
            $checkLike->execute();
            $count = $checkLike->fetch(PDO::FETCH_ASSOC);
            if ((int)$count['liked'] == 0) {
                $query = $this->db->getConnection()->prepare('INSERT INTO camagru.images_has_likes (user_id, 
                                          image_id) 
                                VALUES (:user_id, :image_id)');
                $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                $query->bindValue(':image_id', $image_id, PDO::PARAM_INT);
                $query->execute();
            } else {
                $query = $this->db->getConnection()->prepare('DELETE FROM camagru.images_has_likes
                                WHERE user_id=:user_id
                                AND image_id=:image_id');
                $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                $query->bindValue(':image_id', $image_id, PDO::PARAM_INT);
                $query->execute();
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
