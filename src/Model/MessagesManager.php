<?php

namespace Democvidev\ChessTeam\Model;

use Democvidev\ChessTeam\Classes\Messages;
use Democvidev\ChessTeam\Model\AbstractModel;

class MessagesManager extends AbstractModel
{
    protected $table = 'message';
    /**
     * Insère un message dans la base de données
     *
     * @param Messages $messages
     * @return bool
     */
    public function insertMessage(Messages $messages): bool
    {
        $request = 'INSERT INTO ' . $this->table . ' (author_name, mess_author, mess_subject, mess_content) VALUES(:author_name, :mess_author, :mess_subject, :mess_content)';
        $insert = $this->db->getPDO()->prepare($request);
        $insert = $insert->execute([
            'author_name' => $messages->getAuthor_name(),
            'mess_author' => $messages->getMess_author(),
            'mess_subject' => $messages->getMess_subject(),
            'mess_content' => $messages->getMess_content()
        ]);
        return $insert;
    }
}
