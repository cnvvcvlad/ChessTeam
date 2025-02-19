<?php

namespace Democvidev\ChessTeam\Model;

use Democvidev\ChessTeam\Classes\Article;
use Democvidev\ChessTeam\Model\AbstractModel;
use Democvidev\ChessTeam\Classes\ArticleStatut;
use Democvidev\ChessTeam\Exception\NotFoundException;

class ArticleManager extends AbstractModel
{
    protected $table = 'article';

    /**
     * Insère un article dans la base de données
     *
     * @param Article $article
     * @return bool
     */
    public function insertArticle(Article $article): bool
    {
        $request =
            'INSERT INTO ' .
            $this->table .
            '(
                art_title, art_description, art_content, 
                art_image, art_author, category_id, art_statut) 
            VALUES(:art_title, :art_description, :art_content, 
            :art_image, :art_author, :category_id, :art_statut)';
        $insert = $this->db->getPDO()->prepare($request);
        $insert->bindValue(
            ':art_title',
            $article->getArt_title(),
            \PDO::PARAM_STR
        );
        $insert->bindValue(
            ':art_description',
            $article->getArt_description(),
            \PDO::PARAM_STR
        );
        $insert->bindValue(
            ':art_content',
            $article->getArt_content(),
            \PDO::PARAM_STR
        );
        $insert->bindValue(
            ':art_image',
            $article->getArt_image(),
            \PDO::PARAM_STR
        );
        $insert->bindValue(
            ':art_author',
            $article->getArt_author(),
            \PDO::PARAM_STR
        );
        $insert->bindValue(
            ':category_id',
            $article->getCategory_id(),
            \PDO::PARAM_INT
        );
        $insert->bindValue(
            ':art_statut',
            ArticleStatut::DRAFT,
            \PDO::PARAM_STR
        );
        $insert = $insert->execute();
        return $insert;
    }

    /**
     * Met à jour un article dans la base de données
     *
     * @param int $id
     * @param Article $article
     * @return bool
     */
    public function updateArticle($id, Article $article): bool
    {
        $request =
            'UPDATE ' .
            $this->table .
            ' 
            SET art_title = :art_title, 
            art_description = :art_description, 
            art_content = :art_content, 
            art_image = :art_image, 
            art_author = :art_author, 
            category_id = :category_id 
            WHERE id =:id';
        $update = $this->db->getPDO()->prepare($request);
        $update->bindValue(':id', $id, \PDO::PARAM_INT);
        $update->bindValue(
            ':art_title',
            $article->getArt_title(),
            \PDO::PARAM_STR
        );
        $update->bindValue(
            ':art_description',
            $article->getArt_description(),
            \PDO::PARAM_STR
        );
        $update->bindValue(
            ':art_content',
            $article->getArt_content(),
            \PDO::PARAM_STR
        );
        $update->bindValue(
            ':art_image',
            $article->getArt_image(),
            \PDO::PARAM_STR
        );
        $update->bindValue(
            ':art_author',
            $article->getArt_author(),
            \PDO::PARAM_STR
        );
        $update->bindValue(
            ':category_id',
            $article->getCategory_id(),
            \PDO::PARAM_INT
        );
        $result = $update->execute();
        return $result;
    }

    /**
     * Compter le nombre d'articles dans la base de données
     *
     * @return int
     * @var mixed
     */
    public function countArticles($art_statut): int
    {
        $request = 'SELECT COUNT(*) AS nb_art FROM ' . $this->table . ' WHERE art_statut LIKE :art_statut';
        $stmt = $this->db->getPDO()->prepare($request);
        $stmt->bindValue(':art_statut', $art_statut, \PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return (int) $result['nb_art'];
    }

    public function countMyArticles(int $id): int
    {
        $request = 'SELECT COUNT(*) AS nb_art FROM ' . $this->table . ' WHERE art_author = :id';
        $stmt = $this->db->getPDO()->prepare($request);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return (int) $result['nb_art'];
    }

    /**
     * Récupère tous les articles de la base de données
     *
     * @return array
     */
    public function getAllPosts(): array
    {
        $stmt = $this->requestAll();
        $posts = $this->returnPosts($stmt);
        return $posts;
    }

    /**
     * Encapsule les données d'un article dans un objet Article
     * et le stocke dans un tableau
     *
     * @param \PDOStatement $stmt
     * @return array
     */
    private function returnPosts(\PDOStatement $stmt): array
    {
        $art = [];
        while ($donnees = $stmt->fetch()) {
            $art[] = new Article($donnees);
        }
        return $art;
    }

    /**
     * Retourne une date formatée
     * 
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (new \DateTime($this->date_creation))->format('Y-m-d H:i:s');
    }

    /**
     * Retourne le nom de l'auteur
     *
     * @param [type] $user
     * @return string
     */
    public function getNameAuthor($user): string
    {
        $request = 'SELECT login FROM user WHERE id_user = :id';
        $stmt = $this->db->getPDO()->prepare($request);
        $stmt->bindValue(':id', $user, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result ? $result['login'] : 'Directeur';
    }

    /**
     * Retourne le nom de la catégorie
     *
     * @param [type] $category
     * @return string
     */
    public function getNameCategory($category): string
    {
        $request = 'SELECT title FROM category WHERE id = :id';
        $stmt = $this->db->getPDO()->prepare($request);
        $stmt->bindValue(':id', $category, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['title'];
    }

    /**
     * Retourne un extrait de contenu
     *
     * @return string
     */
    public function getExcerpt()
    {
        $content = $this->art_content;
        $excerpt = substr($content, 0, 200) . '...';
        return $excerpt;
    }

    /**
     * Affichage de tous les articles compris entre deux identifiants
     *
     * @param int $firstArticle
     * @param int $nbArticlesPerPage
     * @return array
     */
    public function affichageArt($firstArticle, $nbArticlesPerPage): array
    {
        // $query = 'SELECT *, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM articles ORDER BY id DESC';
        $query =
            'SELECT *, 
            DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
            AS date_creation 
            FROM ' .
            $this->table .
            ' WHERE art_statut LIKE :art_statut
            LIMIT :firstArticle, :nbArticlesPerPage ';

        $select = $this->db->getPDO()->prepare($query);
        $select->bindValue(':firstArticle', $firstArticle, \PDO::PARAM_INT);
        $select->bindValue(
            ':nbArticlesPerPage',
            $nbArticlesPerPage,
            \PDO::PARAM_INT
        );
        $select->bindValue(':art_statut', ArticleStatut::PUBLISHED, \PDO::PARAM_STR);
        $select->execute();
        $posts = $this->returnPosts($select);
        return $posts;
    }

    public function affichageMyArt($firstArticle, $nbArticlesPerPage, $id): array
    {
        $query =
            'SELECT *, 
            DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
            AS date_creation 
            FROM ' .
            $this->table .
            ' 
            WHERE art_author = :id_user
            LIMIT :firstArticle, :nbArticlesPerPage';
        $select = $this->db->getPDO()->prepare($query);
        $select->bindValue(':id_user', $id, \PDO::PARAM_INT);
        $select->bindValue(':firstArticle', $firstArticle, \PDO::PARAM_INT);
        $select->bindValue(
            ':nbArticlesPerPage',
            $nbArticlesPerPage,
            \PDO::PARAM_INT
        );
        $select->execute();
        $posts = $this->returnPosts($select);
        return $posts;
    }

    /**
     * Affichage des derniers 5 articles
     *
     * @return array
     */
    public function affichageRecentes($offset = null, $limit = null): array
    {
        $query =
            'SELECT *, 
            DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
            AS date_creation 
            FROM ' .
            $this->table .
            ' WHERE id > ' .
            $offset .
            ' ORDER BY id DESC LIMIT ' .
            $limit;
        $select = $this->db->getPDO()->prepare($query);
        $select->execute();
        $posts = $this->returnPosts($select);
        return $posts;
    }

    /**
     * Affichage des articles en fonction de leur catégorie
     *
     * @param int $category_id
     * @return array
     */
    public function affichageParCategorie($category_id): array
    {
        $query =
            'SELECT *, 
            DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
            AS date_creation 
            FROM ' .
            $this->table .
            ' 
            WHERE category_id = :category_id AND art_statut LIKE :art_statut';
        $select = $this->db->getPDO()->prepare($query);
        $select->bindValue(':category_id', $category_id, \PDO::PARAM_INT);
        $select->bindValue(':art_statut', ArticleStatut::PUBLISHED, \PDO::PARAM_STR);
        $select->execute();
        $posts = $this->returnPosts($select);
        return $posts;
    }

    /**
     * Affichage d'un article en fonction de son identifiant
     *
     * @param int $art_id
     * @return array
     */
    public function affichageOne($art_id): array
    {
        $query =
            'SELECT *, 
            DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
            AS date_creation 
            FROM ' .
            $this->table .
            ' WHERE id = :art_id';
        $select = $this->db->getPDO()->prepare($query);
        $select->bindValue(':art_id', $art_id, \PDO::PARAM_INT);
        $select->execute();
        if ($select->rowCount() > 0) {
            $art[] = new Article($select->fetch());
            return $art;
        } else {
            throw new NotFoundException('Article non trouvé');
        }
    }

    /**
     * Affiche les articles en fonction de leur auteur
     *
     * @param int $id_user
     * @return array
     */
    public function affichageMyArticles($id_user): array
    {
        $query =
            'SELECT *, 
            DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
            AS date_creation 
            FROM ' .
            $this->table .
            ' 
            WHERE art_author = :id_user';
        $select = $this->db->getPDO()->prepare($query);
        $select->bindValue(':id_user', $id_user, \PDO::PARAM_INT);
        $select->execute();
        $posts = $this->returnPosts($select);
        return $posts;
    }

    /**
     * Suppression d'un article en fonction de son identifiant
     *
     * @param int $id_article
     * @return void
     */
    public function deleteArticle($id_article): void
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id_article';
        $delete = $this->db->getPDO()->prepare($query);
        $delete->bindValue(':id_article', $id_article, \PDO::PARAM_INT);
        $delete->execute();
    }

    /**
     * Recherche d'un article en fonction de la chaîne de caractères
     *
     * @param string $search
     * @return array
     */
    public function searchArticles($search): array
    {
        $query =
            'SELECT *, 
            DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
            AS date_creation 
            FROM ' .
            $this->table .
            ' 
            WHERE art_title 
            LIKE :search OR art_description 
            LIKE :search OR art_content 
            LIKE :search OR art_author 
            LIKE :search';
        $select = $this->db->getPDO()->prepare($query);
        $select->execute(['search' => '%' . $search . '%']);
        $posts = $this->returnPosts($select);
        return $posts;
    }

    /**Récupérer les articles selon leur statut
     * 
     * @param string $status
     * @return array
     */
    public function getArticlesByStatus($status): array
    {
        if (!in_array($status, ArticleStatut::getAllTypes())) {
            return []; // Retourne un tableau vide si le statut est invalide
        }

        $query = 'SELECT * FROM ' . $this->table . ' WHERE art_statut = :status ORDER BY date_creation DESC';
        $select = $this->db->getPDO()->prepare($query);
        $select->execute(['status' => $status]);
        $posts = $this->returnPosts($select);
        return $posts;
    }

    /**
     * Changer le statut d'un article
     *
     * @param int $id
     * @param string $status
     * @return void
     */
    public function changeStatus($id, $status): void
    {
        $query = 'UPDATE ' . $this->table . ' SET art_statut = :status WHERE id = :id';
        $update = $this->db->getPDO()->prepare($query);
        $update->execute(['status' => $status, 'id' => $id]);
    }
}
