<?php

namespace Democvidev\ChessTeam\Model;

use Democvidev\ChessTeam\Classes\Comment;
use Democvidev\ChessTeam\Model\AbstractModel;

class CommentsManager extends AbstractModel
{
    protected $table = 'comment';
   /**
    * Insère un commentaire dans la base de données
    *
    * @param Comment $comment
    * @return void
    */
    public function insertComment(Comment $comment): void
    {
        $request = 'INSERT INTO ' . $this->table . '(com_author, com_content, article_id) VALUES(:com_author, :com_content, :article_id)';
        $insert = $this->db->getPDO()->prepare($request);        
        $insert = $insert->execute([
            'com_author' => $comment->getCom_author(),
            'com_content' => $comment->getCom_content(),
            'article_id' => $comment->getArticle_id()
        ]);
    }

    /**
     * Met à jour un commentaire dans la base de données
     * 
     * @param Comment $comment
     * @param int $id
     * @return void
     */
    public function updateComment($id, Comment $comment) {
        $request = 'UPDATE ' . $this->table . ' SET com_content = :com_content WHERE id =:id';
        $update = $this->db->getPDO()->prepare($request);
        $update = $update->execute([
            'id' => $id,
            'com_content' => $comment->getCom_content()
        ]);
    }

    /**
     * Affiche les commentaires d'un article
     *
     * @param int $article_id
     * @return array
     */
    public function showCommentsOfArticle($article_id): array
    {
        $request = 'SELECT *, DATE_FORMAT(com_date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS com_date_creation FROM ' . $this->table . ' WHERE article_id = :article_id';
        $select = $this->db->getPDO()->prepare($request);
        $select->execute(["article_id" => $article_id]);
        $comments = [];
        while ($data = $select->fetch()) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    /**
     * Récupère tous les commentaires
     *
     * @return array
     */
    public function allComments(): array
    {
        $request = 'SELECT *, DATE_FORMAT(com_date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS com_date_creation FROM ' . $this->table . ' ORDER BY id DESC';
        $select = $this->db->getPDO()->query($request);
        $comments = [];
        while ($data = $select->fetch()) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    /**
     * Récupère un commentaire
     * 
     * @param int $id
     * @return array
     */
    public function commentId($id): array
    {
        $request = 'SELECT *, DATE_FORMAT(com_date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS com_date_creation FROM ' . $this->table . ' WHERE id = :id';
        $select = $this->db->getPDO()->prepare($request);
        $select->execute(["id" => $id]);
        $comment[] = new Comment($select->fetch());
        return $comment;
    }

    /**
     * Supprime un commentaire
     *
     * @param int $id
     * @return void
     */
    public function deleteCom($id): void
    {
        $request = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $delete = $this->db->getPDO()->prepare($request);
        $delete->execute(["id" => $id]);
    }
}
