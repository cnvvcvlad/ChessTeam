<?php

namespace Democvidev\ChessTeam\Form;

class CoachForm
{
    public function coachForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['city'])) {
                header('location:index.php?action=streetMap');
                exit();
            }
        }
    }
}
