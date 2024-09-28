<?php

namespace Tests\Unit;

use App\Entity\Team;
use App\Exceptions\NoPlayableMatchesException;
use App\Game\League;
use PHPUnit\Framework\TestCase;

class LeagueTest extends TestCase
{

    private League $league;

    protected function setUp(): void
    {
        parent::setUp();
        $teamA = new Team("Chelsea");
        $teamB = new Team("Arsenal");
        $teamC = new Team("Manchester City");
        $teamD = new Team("Liverpool");

        $this->league = new League();
        $this->league
            ->addTeam($teamA)
            ->addTeam($teamB)
            ->addTeam($teamC)
            ->addTeam($teamD)
            ->prepareMatch();

    }

    public function test_over_match_weeks(): void
    {
        $this->expectException( NoPlayableMatchesException::class );
        $this->league->getLeagueTable(100);
    }

    public function test_under_match_weeks(): void
    {
        $this->expectException( NoPlayableMatchesException::class );
        $this->league->getLeagueTable(0);
    }

    public function test_get_league_table(): void
    {
        $data = $this->league->getLeagueTable(1);
        $this->assertIsArray($data);
    }

    public function test_calculate_matches(): void
    {
        $this->assertEquals(6, $this->league->calculateMatches());
    }



}
