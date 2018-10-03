<?php

namespace Casino\Http\Controllers;

use Casino\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Casino\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return view('games.show')->withGame($game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Casino\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Casino\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        $this->validate($request, [
          'game_name' => 'required',
          'win_rate' => 'required',
          'credits' => 'required'
        ]);

        $data = $request->all();

        $game->update([
          'settings' => json_encode([
            'game_name' => $data['game_name'],
            'win_rate' => $data['win_rate'],
            'credits' => $data['credits']
          ])
        ]);

        return response()->json([
          'message' => 'Settings saved successfully.',
          'game' => $game
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Casino\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
