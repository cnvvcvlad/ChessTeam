<?php

namespace Democvidev\ChessTeam\Controller\Admin;

use Democvidev\ChessTeam\Model\MemberManager;
use Democvidev\ChessTeam\Controller\AbstractController;

class UserController extends AbstractController
{
    private $memberManager;

    public function __construct()
    {
        $this->memberManager = new MemberManager($this->getDatabase());
    }

    public function members()
    {
        $this->isAdmin();
        $members = $this->memberManager->showAllUsers();
        $this->view('admin.members.index', [
            'members' => $members
        ]);
    }
}