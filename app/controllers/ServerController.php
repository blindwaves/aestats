<?php

class ServerController extends BaseController {

    public function getPlayer($serverName, $id)
    {
        $profile = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_level')
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

        $profileHistory = array();
        $profilePrevious = $profile[count($profile) - 1];
        array_push($profileHistory, $profilePrevious);

        for ($i = count($profile) - 2; $i > 0; $i--) {
            if (strcmp($profilePrevious->tag, $profile[$i]->tag) !== 0 ||
                strcmp($profilePrevious->name, $profile[$i]->name) !== 0) {
                    array_push($profileHistory, $profile[$i]);
            }

            $profilePrevious = $profile[$i];
        }

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
