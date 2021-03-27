<?php
namespace Democvidev\Model;

require_once 'DataBase.php';

class MessagesManager extends DataBase
{
    public function getDatabase()
    {
        return $this->database;
    }

    public function setDatabase($database)
    {
        $this->database = $database;
    }


    public function insertMessage(Messages $messages)
    {
        $request = 'INSERT INTO messages (author_name, mess_author, mess_subject, mess_content) VALUES(:author_name, :mess_author, :mess_subject, :mess_content)';
        $insert = $this->dbConnect()->prepare($request);
        $insert = $insert->execute([
            'author_name' => $messages->getAuthor_name(),
            'mess_author' => $messages->getMess_author(),
            'mess_subject' => $messages->getMess_subject(),
            'mess_content' => $messages->getMess_content()
        ]);
    }


}