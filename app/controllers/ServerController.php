<?php

class ServerController extends BaseController {

    public function getPlayer($serverName, $id)
    {
        $profile = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_level')
                        ->groupBy('name', 'tag')
                        ->orderBy('id', 'DESC')
                        ->get();

        $fleet = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_fleet')
                        ->groupBy('value')
                        ->orderBy('id', 'DESC')
                        ->get();

        return View::make('server/player', array(
            'fleet' => $fleet,
            'profile' => $profile,
            'serverName' => $serverName,
        ));
    }

    public function getSearch($serverName)
    {
        $results = History::where('server', '=', $serverName)
                        ->where('name', 'LIKE', '%'.Input::get('terms').'%')
                        ->orWhere('url', '=', 'profile.aspx?player='.Input::get('terms'))
                        ->groupBy('name')
                        ->orderBy('id', 'DESC')
                        ->get();

        return View::make('server/search', array(
            'results' => $results,
            'serverName' => $serverName,
        ));
    }

}
