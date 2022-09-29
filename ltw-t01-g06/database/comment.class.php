<?php
  declare(strict_types = 1);

  class CommentRestaurant {
    public int $id_comment;
    public int $restaurant_id;
    public string $username;
    public float $score;
    public string $text;

    public function __construct(int $id, int $restaurant_id, string $username, float $score, string $text){
      $this->id_comment = $id;
      $this->restaurant_id = $restaurant_id;
      $this->username = $username;
      $this->score = $score;
      $this->text = $text;
    }

    function getCommentWithId(PDO $db, int $id_comment) : ?CommentRestaurant {
        $stmt = $db->prepare('SELECT * from CommentRestaurant where id_comment = ?');
        $stmt->execute(array($id_comment));
        
        if ($comment = $stmt->fetch()) {
          return new CommentRestaurant(
          (int)$comment['id_comment'],
          (int)$comment['restaurant_id'],
          $comment['username'],
          (real)$comment['score'],
          $comment['text']
          );
        } else return null;
    }

    function insertComment(PDO $db, int $restaurant_id, string $username, float $score, string $text) {
      $count = $db->prepare('SELECT id_comment FROM CommentRestaurant ORDER BY id_comment DESC LIMIT 1');
      $count->execute();
      $count = $count->fetchAll();
        $stmt = $db->prepare('INSERT INTO CommentRestaurant VALUES(?, ?, ?, ?, ?)');
        $stmt->execute(array($count[0]["id_comment"]+1, $restaurant_id, $username, $score, $text));
      }
      
      function getComments(PDO $db, int $restaurant_id) : array{
        $stmt = $db->prepare('SELECT * from CommentRestaurant where restaurant_id = ?');
        $stmt->execute(array($restaurant_id));
        
        $comments = array();
        while ($comment = $stmt->fetch()) {
            $comments[] = new CommentRestaurant(
            (int)$comment['id_comment'],
            (int)$comment['restaurant_id'],
            $comment['username'],
            (real)$comment['score'],
            $comment['comment']
            );
        }

        return $comments;
    }
  }

?>