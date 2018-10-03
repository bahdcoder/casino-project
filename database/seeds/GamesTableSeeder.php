<?php

use Casino\Game;
use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Game::create([
          'settings' => json_encode([
            'game_name' => 'awesome_game_1',
            'win_rate' => 5221,
            'credits' => 100
          ])
        ]);

        Game::create([
          'settings' => json_encode([
            'game_name' => 'awesome_game_2',
            'win_rate' => 1221,
            'credits' => 100
          ])
        ]);

        Game::create([
          'settings' => json_encode([
            'game_name' => 'awesome_game_3',
            'win_rate' => 4531,
            'credits' => 1000
          ])
        ]);
    }
}
