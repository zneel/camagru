<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-18
 * Time: 14:04
 */

class CommentManager
{
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function save(Comment $comment)
    {
        $query = $this->db->getConnection()->prepare('INSERT INTO camagru.comments (comment, 
            user_id, 
            image_id) 
            VALUES (:comment, 
                  :user_id, 
                  :image_id)');
        $query->bindValue(':comment', $comment->getComment(), PDO::PARAM_STR);
        $query->bindValue(':user_id', $comment->getUser(), PDO::PARAM_INT);
        $query->bindValue(':image_id', $comment->getImage(), PDO::PARAM_INT);
        $query->execute();
    }

    public function get(int $id)
    {
        $query = $this->db->getConnection()->prepare('SELECT * FROM camagru.comments c
                                    WHERE c.id = :id');
        $query->execute(['id' => $id]);
        $image = $query->fetch(PDO::FETCH_ASSOC);
        if (!$image) {
            return null;
        }
        return $image;
    }

    public function getComments(int $image_id)
    {
        $query = $this->db->getConnection()->prepare('SELECT c.*, u.username FROM camagru.comments AS c
        JOIN camagru.users AS u ON c.user_id = u.id
        WHERE c.image_id = :image_id
        ORDER BY c.created_at DESC');
        $query->execute(['image_id' => $image_id]);
        $comments = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!$comments) {
            return null;
        }
        return $comments;
    }

    public function delete(int $id)
    {
        $query = $this->db->getConnection()->prepare('DELETE FROM camagru.comments WHERE id=:id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }
}
