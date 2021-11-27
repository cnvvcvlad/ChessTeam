<?php

namespace Democvidev\ChessTeam\Model;

use Democvidev\ChessTeam\Model\DataBase;
use Democvidev\ChessTeam\Classes\Messages;

class MessagesManager extends DataBase
{
    /**
     * Insère un message dans la base de données
     *
     * @param Messages $messages
     * @return void
     */
    public function insertMessage(Messages $messages): void
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
