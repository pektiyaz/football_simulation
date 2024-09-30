<?php

namespace App\Services;

use App\Entity\Team;

class Matches
{
    private Team $teamA;
    private Team $teamB;

    public function __construct(Team $teamA, Team $teamB)
    {
        $this->teamA = $teamA;
        $this->teamB = $teamB;
    }

    public function getTeamA(): Team
    {
        return $this->teamA;
    }

    public function getTeamB(): Team
    {
        return $this->teamB;
    }




    public function simulateMatch(): void
    {
        $score = rand(0, 4);
        $score2 = rand(0, 4);

        $this->teamA->incMatches();
        $this->teamB->incMatches();

        $winGoal = rand(0, 31);
        $losGoal = rand(0, 30);

        if ($score > $score2) {

            $this->teamA->incWins();
            $this->teamA->setGoals($winGoal);
            $this->teamA->setGoalsAgainst($losGoal);
            $this->teamA->addPoints(3);

            $this->teamB->incLosses();
            $this->teamB->setGoals($losGoal);
            $this->teamB->setGoalsAgainst($winGoal);
            $this->teamA->addPoints(0);

        } elseif ($score < $score2) {
            $this->teamA->incLosses();
            $this->teamA->setGoals($losGoal);
            $this->teamA->setGoalsAgainst($winGoal);
            $this->teamA->addPoints(0);

            $this->teamB->incWins();
            $this->teamB->setGoals($winGoal);
            $this->teamB->setGoalsAgainst($losGoal);
            $this->teamB->addPoints(3);

        } else {
            $this->teamA->incDraw();
            $this->teamA->setGoals($winGoal);
            $this->teamA->setGoalsAgainst($winGoal);
            $this->teamA->addPoints(1);

            $this->teamB->incDraw();
            $this->teamB->setGoals($winGoal);
            $this->teamB->setGoalsAgainst($winGoal);
            $this->teamA->addPoints(1);
        }
    }




}
