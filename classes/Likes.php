<?php

require_once 'Generique.php';

class Likes extends Generique {

    private $id_like;
    private $like_author;
    private $like_article;

    /**
     * Likes constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }

    /**
     * @return mixed
     */
    public function getId_like()
    {
        return $this->id_like;
    }

    /**
     * @param mixed $id_like
     */
    public function setId_like($id_like)
    {
        $this->id_like = $id_like;
    }

    /**
     * @return mixed
     */
    public function getLike_author()
    {
        return $this->like_author;
    }

    /**
     * @param mixed $like_author
     */
    public function setLike_author($like_author)
    {
        $this->like_author = $like_author;
    }

    /**
     * @return mixed
     */
    public function getLike_article()
    {
        return $this->like_article;
    }

    /**
     * @param mixed $like_article
     */
    public function setLike_article($like_article)
    {
        $this->like_article = $like_article;
    }


}
