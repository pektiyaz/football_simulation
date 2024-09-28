<?php
declare(strict_types=1);

namespace App\Game;

use App\Entity\Team;
use App\Exceptions\NoPlayableMatchesException;

class League {

    /**
     * @var array|Team[]
     */
    public array $teams = [];
    private array $matches = [];

    public int $week = 1;


    public function addTeam( Team $team ): self
    {
        $this->teams[] = $team;
        return $this;
    }

    public function calculateMatches(): int
    {
        $teams = count($this->teams);
        return $teams * ($teams - 1) / 2;
    }

    public function prepareMatch():  self
    {
        $offset = 1;
        $week = 1;
        $matchCount = 0;
        $maxMatches = $this->calculateMatches()*2;

        while ($week <= $maxMatches) {
            foreach($this->teams as $teamA){
                foreach($this->teams as $teamB){
                    if($teamA !== $teamB && !$this->isPlayed($teamA, $teamB)){
                        $this->matches[] = [
                            "week" => $week,
                            "match" => new Matches($teamA, $teamB)
                        ];

                        if ($offset % 2 === 0) {
                            $week++;
                        }

                        $offset++;
                        $matchCount++;

                        if ($matchCount === $maxMatches) {
                            $matchCount = 0;
                        }

                        if ($week > $maxMatches) {
                            break 2;
                        }
                    }
                }
            }
        }

        return $this;
    }






    public function isPlayed(Team $teamA, Team $teamB): bool
    {

        foreach($this->matches as $match){
            if( $match['match']->getTeamB() === $teamA && $match['match']->getTeamB() === $teamB ){
                return true;
            }
            if( $match['match']->getTeamA() === $teamB && $match['match']->getTeamB() === $teamA ){
                return true;
            }
        }
        return false;
    }


    public function calculatePredictionForTeam(Team $team): float
    {

        $matches = count($this->matches);

        $performanceScore = (
            ($team->getWins() * 3) +
            ($team->getDraw() * 1) +
            ($team->getPoints() / $matches) +
            ($team->getGoalDifference() / $matches)
        );

        $maxScore = $matches * 3;
        $winPercentage = ($performanceScore / $maxScore) * 100;
        return round(min(max($winPercentage, 0), 100), 2);
    }

    public function playAll(): void
    {
        foreach($this->matches as $match){
            $match['match']->simulateMatch();
        }
    }

    /**
     * @throws NoPlayableMatchesException
     */
    public function getLeagueTable(int $week): array
    {

        $this->playAll();

        throw_if( !in_array($week, array_column($this->matches, 'week')),
            new NoPlayableMatchesException('No playable match!') );

        $result  = [];
        $result["week"] = $week;

        foreach($this->teams as $team){
            $result['teams'][] = $team->getLeagueTable();
            $result['prediction'][] = ["Team" => $team->getName(), "Predict" => $this->calculatePredictionForTeam($team)];
        }
        foreach($this->matches as $match){
            if($match['week'] === $week){
                $result["matches"][] = [
                    "teamA" => $match['match']->getTeamA()->getName(),
                    "teamAGoals" => $match['match']->getTeamA()->getGoals(),
                    "teamB" => $match['match']->getTeamB()->getName(),
                    "teamBGoals" => $match['match']->getTeamB()->getGoals(),
                ];
            }
        }

        return $result;

    }
}
