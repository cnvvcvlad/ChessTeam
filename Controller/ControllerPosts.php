<?php

namespace Democvidev\App;

use Democvidev\App\ArticleManager;

class ControllerPosts {

    
    public function getListe()
    {
        $art_manager = new ArticleManager();
        $posts = $art_manager->affichageArt();
        return $posts;
        
    }
    
    public function getLastArticles()
    {
        $art_manager = new ArticleManager();
        $posts = $art_manager->affichageRecentes();
        return $posts;
    }
    
    public function getLastArticle_one()
    {
        $art_manager = new ArticleManager();
        $post = $art_manager->affichageLastOne();
        return $post;
    }
    
    public function getArticlesOfCategory($category_id)
    {
        $art_manager = new ArticleManager();
        $posts = $art_manager->affichageParCategorie($category_id);
        return $posts;
    }
    
    public function getOneArticle($art_id)
    {
        $art_manager = new ArticleManager();
        $post = $art_manager->affichageOne($art_id);
        return $post;
    }
    
    public function isAuthor($art_author)
    {
        if (isset($_SESSION['id_user'])) {
            $art_manager = new ArticleManager();
            $art_manager = $art_manager->AffichageMyArticles($art_author);
            foreach ($art_manager as $key => $value) {
                $value->getArt_author();
            }
            if ($_SESSION['id_user'] == $value->getArt_author()) {
                return true;
            }
            return false;
        }
        return;
    }
    
    public function getMyArticles($id_user)
    {
        $art_manager = new ArticleManager();
        $posts = $art_manager->AffichageMyArticles($id_user);
        return $posts;
    }
    
    public function deleteMyArticle($id_article)
    {
        $art_manager = new ArticleManager();
        $art_manager->deleteArticle($id_article);
        header('location:index.php?action=allArticles');
    }
    
    
}