<?php

namespace Democvidev\App;

require_once 'Generique.php';

// use Democvidev\App\Generique;
class Messages extends Generique
{

    private $id;
    private $author_name;
    private $mess_author;
    private $mess_subject;
    private $mess_content;
    private $mess_date_creation;


    public function __construct(array $data)
    {
        if ($data) {
            parent::__construct($data); // heritage du constructeur de la classe Generique
        }

//        $this->mess_date_creation = new \DateTime(); // on etablie la date d'aujourd'hui
    }


    public function getId()
    {
        return $this->id;
    }


    public function getAuthor_name()
    {
        return $this->author_name;
    }


    public function setAuthor_name($author_name)
    {
        $this->author_name = $author_name;
    }


    public function getMess_author()
    {
        return $this->mess_author;
    }


    public function setMess_author($mess_author)
    {
        $this->mess_author = $mess_author;
    }


    public function getMess_subject()
    {
        return $this->mess_subject;
    }


    public function setMess_subject($mess_subject)
    {
        $this->mess_subject = $mess_subject;
    }


    public function getMess_content()
    {
        return $this->mess_content;
    }


    public function setMess_content($mess_content)
    {
        $this->mess_content = $mess_content;
    }


    public function getMess_date_creation()
    {
        return $this->mess_date_creation;
    }


    public function setMess_date_creation($mess_date_creation)
    {
        $this->mess_date_creation = $mess_date_creation;
    }


}