<?php
require_once 'model/DataBase.php';

class UsersManager extends DataBase
{

    public function ShowOneUser($user_id)
    {
        $request = 'SELECT * FROM users WHERE id_user = :id_user';
        $select = $this->dbConnect()->prepare($request);
        $select->execute(["id_user" => $user_id]);

        $member[] = new Users($select->fetch());

        return $member;
    }

    public function ShowAllUsers()
    {
        $request = 'SELECT * FROM users WHERE statut = 0  ORDER BY id_user DESC';
        $select = $this->dbConnect()->prepare($request);
        $select->execute();

        $members = [];

        while ($data = $select->fetch()) {
            $members[] = new Users($data);
        }
        return $members;
    }

    public function nameUser($user_id)
    {
        $request = 'SELECT login FROM users WHERE id_user = :id_user';
        $select = $this->dbConnect()->prepare($request);
        $select->execute(["id_user" => $user_id]);

        $member = $select->fetch();

        return $member;
    }

    public function deleteU($user_id) :void
    {
        $request = 'DELETE FROM users WHERE id_user = :id_user';
        $delete = $this->dbConnect()->prepare($request);
        $delete->execute(["id_user" => $user_id]);
    }
}
