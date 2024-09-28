<?php

namespace App\Http\Controllers;

use App\Entity\Team;
use App\Exceptions\NoPlayableMatchesException;
use App\Game\League;

class IndexController extends Controller
{

    public function index(int $week = 1)
    {
        $teamA = new Team("Chelsea");
        $teamB = new Team("Arsenal");
        $teamC = new Team("Manchester City");
        $teamD = new Team("Liverpool");


        $league = new League();
        $league
            ->addTeam($teamA)
            ->addTeam($teamB)
            ->addTeam($teamC)
            ->addTeam($teamD)
            ->prepareMatch();

        try {
            $data = $league->getLeagueTable($week);
        } catch (NoPlayableMatchesException $e) {
            return $e->getMessage();
        }
        return view('table', ['data' => $data]);
    }
}
