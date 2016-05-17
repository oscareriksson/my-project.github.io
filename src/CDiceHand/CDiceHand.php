<?php

 // A hand of dices, with graphical representation, to roll.

class CDiceHand {


   // Properties

  private $dices;
  private $numDices;
  private $sum;
  private $sumRound;
  private $save;
  private $totalScore;


  /**
   * Constructor
   *
   * @param int $numDices the number of dices in the hand, defaults to six dices.
   */
  public function __construct($numDices = 1) {
     for($i=0; $i < $numDices; $i++) {
        $this->dices[] = new CDice();
    }
    $this->numDices = $numDices;
    $this->sum = 0;
    $this->sumRound = 0;
}



   // Roll all dices in the hand.

  public function Roll() {
      $this->sum = 0;
    for($i=0; $i < $this->numDices; $i++) {
      $roll = $this->dices[$i]->Roll(1);
      $this->sum += $roll;
      if($this->GetTotal() == 1) {
          $this->sumRound = 0;
      }
      else {
        $this->sumRound += $roll;
      }
    }
  }


  /**
   * Get the sum of the last roll.
   *
   * @return int as a sum of the last roll, or 0 if no roll has been made.
   */
  public function GetTotal() {
      return $this->sum;
  }


// Init Round


    public function InitRound() {
        $this->sumRound = 0;
  }

 // Save round
public function saveRound() {
    $this->totalScore += $this->GetRoundTotal();
    $this->sumRound = 0;
    $this->dices[0]->lastRoll = array();
}

// The total score
public function GetTotalScore() {
    return $this->totalScore;
}

public function youLost() {
    if ($this->sum == 1) {
        $this->sum = 0;
        $this->dices[0]->lastRoll = array();
        return"<p>Du fick en etta. Poängen förloras.</p>";
    }
}

public function youWin() {
    if ($this->totalScore >= 100) {
        $this->dices[0]->lastRoll = array();
        return "Du vann!<a href='movies.php'> Varsågod att väja en film ur vårat utbud.</a>";
    }
}

public function newStart() {
    if ($this->totalScore >= 100) {
        $this->totalScore = 0;
        $this->dices[0]->lastRoll = array();
    }
}

  /**
 * Get the accumulated sum of the round.
 *
 * @return int as a sum of the round, or 0 if no roll has been made.
 */
    public function GetRoundTotal() {
        return $this->sumRound;
}


  /**
   * Get the rolls as a serie of images.
   *
   * @return string as the html representation of the last roll.
   */
  public function GetRollsAsImageList() {
      $html = "<ul class='dice'>";
    foreach($this->dices as $dice) {
        /*$val = $dice->GetResults();
        for ($i = 0; $i < count($val); $i++) {
        $html .= "<li class='dice-{$val[$i]}'></li>";*/
        foreach($dice->GetResults() as $val) {
            $html .= "<li class='dice-{$val}'></li>";
        }
    }
    $html .= "</ul>";
    return $html;
  }
}
