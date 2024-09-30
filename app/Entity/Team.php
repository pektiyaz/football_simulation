<?php

namespace App\Entity;

class Team
{
    private string $name;

    private int $points = 0;
    private int $matches = 0;
    private int $wins = 0;
    private int $draw = 0;
    private int $losses = 0;

    private int $goals = 0;
    private int $goalsAgainst = 0;
    private int $prediction = 0;


    public function __construct(string $name)
    {
        $this->name = $name;
    }



    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }



    public function getPoints(): int
    {
        return $this->points;
    }
    public function addPoints(int $point): void
    {
        $this->points += $point;
    }



    public function getMatches(): int
    {
        return $this->matches;
    }

    public function incMatches(): void
    {
        $this->matches++;
    }

    public function getWins(): int
    {
        return $this->wins;
    }

    public function incWins(): void
    {
        $this->wins++;
    }

    public function getDraw(): int
    {
        return $this->draw;
    }

    public function incDraw(): void
    {
        $this->draw++;
    }

    public function getLosses(): int
    {
        return $this->losses;
    }

    public function incLosses(): void
    {
        $this->losses++;
    }

    public function getGoalDifference(): int
    {
        return $this->goals - $this->goalsAgainst;
    }



    public function getGoals(): int
    {
        return $this->goals;
    }

    public function setGoals(int $goals): void
    {
        $this->goals = $goals;
    }

    public function getGoalsAgainst(): int
    {
        return $this->goalsAgainst;
    }

    public function setGoalsAgainst(int $goal): void
    {
        $this->goalsAgainst = $goal;
    }
    public function getLeagueTable(): array
    {
        return [
            'Team' => $this->getName(),
            'PTS' => $this->getPoints(),
            'P' => $this->getMatches(),
            'W' => $this->getWins(),
            'D' => $this->getDraw(),
            'L' => $this->getLosses(),
            'GD' => $this->getGoalDifference()
        ];
    }

    public function getPrediction(): int
    {
        return $this->prediction;
    }

    public function setPrediction(int $prediction): void
    {
        $this->prediction = $prediction;
    }















}
