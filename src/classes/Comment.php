<?php

require_once 'Generique.php';

class Comment extends Generique
{
    private $id;
    private $com_author;
    private $com_content;
    private $com_date_creation;
    private $article_id;

    public function __construct(array $data)
    {
        if ($data) {
            parent::__construct($data);
        }
    }


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of com_author
     */
    public function getCom_author()
    {
        return $this->com_author;
    }

    /**
     * Set the value of com_author
     *
     * @return  self
     */
    public function setCom_author($com_author)
    {
        $this->com_author = $com_author;

        return $this;
    }

    /**
     * Get the value of com_content
     */
    public function getCom_content()
    {
        return $this->com_content;
    }

    /**
     * Set the value of com_content
     *
     * @return  self
     */
    public function setCom_content($com_content)
    {
        $this->com_content = $com_content;

        return $this;
    }

    /**
     * Get the value of com_date_creation
     */
    public function getCom_date_creation()
    {
        return $this->com_date_creation;
    }

    /**
     * Set the value of com_date_creation
     *
     * @return  self
     */
    public function setCom_date_creation($com_date_creation)
    {
        $this->com_date_creation = $com_date_creation;

        return $this;
    }

    /**
     * Get the value of article_id
     */
    public function getArticle_id()
    {
        return $this->article_id;
    }

    /**
     * Set the value of article_id
     *
     * @return  self
     */
    public function setArticle_id($article_id)
    {
        $this->article_id = $article_id;

        return $this;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}