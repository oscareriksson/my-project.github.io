<?php

class CDiceView {


    //Properties

    public $html;
    private $destroy;
    private $save;
    private $roll;

    public function View() {
        // Demonstration of module CDice
        if (isset($_SESSION['dicehand'])) {
            //echo "Fortsätter med föregående spel.";
            $hand = $_SESSION['dicehand'];
        }
        else {
            //echo "Startar nytt spel.";
            $hand = new CDiceHand(1);
            $_SESSION['dicehand'] = $hand;
        }


        $roll = isset($_GET['roll']) ? true : false;
        $newgame = isset($_GET['newgame']) ? true : false;
        $save = isset($_GET['save']) ? true : false;


        if ($roll) {
            $hand->Roll();
        }
        else if ($save) {
            $hand->saveRound();
        }
        else if ($newgame) {
            if(isset($_GET['newgame'])) {
                $_SESSION = array();
            }
                // Finally, destroy the session.
                session_destroy();

            }

        $html='<div class="resultView">';
        // Display points
        if ($roll OR $save) {
            $html .= $hand->youWin();
            $html .= $hand->newStart();
            $html .= $hand->GetRollsAsImageList();
            $html .= "<p>Summa runda " . $hand->GetRoundTotal() . ".</p>";
            $html .= $hand->youLost();
            $html .= "<p>Säkrade poäng <b>" . $hand->GetTotalScore() . "</b>.</p>";
        }
        else {
            $html .= $hand->GetRollsAsImageList();
        }
        $html .= "</div>";
        return $html;
    }


}





?>
