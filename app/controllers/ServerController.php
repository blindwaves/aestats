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
                        ->orderBy('id', 'ASC')
                        ->get();

        $economy = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_economy')
                        ->groupBy('value')
                        ->orderBy('id', 'ASC')
                        ->get();

        $level = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_level')
                        ->groupBy('value')
                        ->orderBy('id', 'ASC')
                        ->get();

        $experience = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_experience')
                        ->groupBy('value')
                        ->orderBy('id', 'ASC')
                        ->get();

        $technology = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_technology')
                        ->groupBy('value')
                        ->orderBy('id', 'ASC')
                        ->get();

        return View::make('server/player', array(
            'economy' => $economy,
            'experience' => $experience,
            'fleet' => $fleet,
            'level' => $level,
            'technology' => $technology,
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
