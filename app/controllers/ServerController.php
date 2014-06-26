<?php

class ServerController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter(function($route) {
            $serverName = $route->getParameter('serverName');
            $servers = App::make('supportedServers');

            if (! in_array($serverName, $servers)) {
                return Redirect::to('/');
            }
        });
    }

    public function getIndex($serverName)
    {
        return View::make('server/index', array(
            'serverName' => $serverName,
        ));
    }

    public function getGuild($serverName, $id)
    {
        $profile = History::where('server', '=', $serverName)
                        ->where('url', '=', 'guild.aspx?guild='.$id)
                        ->groupBy('batch')
                        ->orderBy('id', 'DESC')
                        ->get();
        
        $fleet = History::where('server', '=', $serverName)
                        ->where('url', '=', 'guild.aspx?guild='.$id)
                        ->where('category', '=', 'guilds_fleet')
                        ->groupBy('value')
                        ->orderBy('id', 'ASC')
                        ->get();
        /*
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
        */

        $profileHistory = array();

        if (count($profile) > 0) {
            $profilePrevious = $profile[count($profile) - 1];
            array_push($profileHistory, $profilePrevious);
        }

        if (count($profile) > 1) {
            for ($i = count($profile) - 2; $i > 0; $i--) {
                if (strcmp($profilePrevious->tag, $profile[$i]->tag) !== 0 ||
                    strcmp($profilePrevious->name, $profile[$i]->name) !== 0) {
                        array_push($profileHistory, $profile[$i]);
                }

                $profilePrevious = $profile[$i];
            }
        }

        return View::make('server/guild', array(
            //'economy' => $economy,
            //'experience' => $experience,
            'fleet' => $fleet,
            //'level' => $level,
            //'technology' => $technology,
            'profile' => $profileHistory,
            'serverName' => $serverName,
        ));
    }

    public function getPlayer($serverName, $id)
    {
        $profile = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->groupBy('batch')
                        ->orderBy('id', 'DESC')
                        ->get();

        $fleet = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_fleet')
                        ->groupBy('value')
                        ->orderBy('id', 'ASC')
                        ->paginate(80);

        $economy = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_economy')
                        ->groupBy('value')
                        ->orderBy('id', 'ASC')
                        ->paginate(80);

        $level = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_level')
                        ->groupBy('value')
                        ->orderBy('id', 'ASC')
                        ->paginate(80);

        $experience = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_experience')
                        ->groupBy('value')
                        ->orderBy('id', 'ASC')
                        ->paginate(80);

        $technology = History::where('server', '=', $serverName)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_technology')
                        ->groupBy('value')
                        ->orderBy('id', 'ASC')
                        ->paginate(80);

        $profileHistory = array();

        if (count($profile) > 0) {
            $profilePrevious = $profile[count($profile) - 1];
            array_push($profileHistory, $profilePrevious);
        }

        if (count($profile) > 1) {
            for ($i = count($profile) - 2; $i >= 0; $i--) {
                if (strcmp($profilePrevious->tag, $profile[$i]->tag) !== 0 ||
                    strcmp($profilePrevious->name, $profile[$i]->name) !== 0) {
                        array_push($profileHistory, $profile[$i]);
                }

                $profilePrevious = $profile[$i];
            }
        }

        return View::make('server/player', array(
            'economy' => $economy,
            'experience' => $experience,
            'fleet' => $fleet,
            'level' => $level,
            'technology' => $technology,
            'profile' => $profileHistory,
            'serverName' => $serverName,
        ));
    }

    public function getSearch($serverName)
    {
        $results = array();
        
        $terms = Input::get('terms');
        
        if (! empty($terms)) {
            $results = History::where('server', '=', $serverName)
                            ->where(function($query) use(&$terms)
                            {
                                // http://creative-punch.net/2013/12/implementing-laravel-4-full-text-search/
                                $query->whereRaw('MATCH (name) AGAINST (? IN BOOLEAN MODE)',
                                        array('+'.$terms.'*'))
                                      ->orWhere('url', '=', 'profile.aspx?player='.$terms);
                            })
                            ->groupBy('url')
                            ->orderBy('id', 'DESC')
                            ->get();
        }

        return View::make('server/search', array(
            'results' => $results,
            'serverName' => $serverName,
        ));
    }

}
