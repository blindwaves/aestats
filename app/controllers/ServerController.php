<?php

class ServerController extends BaseController {

    public function getPlayer($name, $id)
    {
        $profile = History::where('server', '=', $name)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_level')
                        ->groupBy('name', 'tag')
                        ->orderBy('id', 'DESC')
                        ->get();

        $fleet = History::where('server', '=', $name)
                        ->where('url', '=', 'profile.aspx?player='.$id)
                        ->where('category', '=', 'ply_fleet')
                        ->groupBy('value')
                        ->orderBy('id', 'DESC')
                        ->get();

        return View::make('server/player', array(
            'fleet' => $fleet,
            'profile' => $profile,
        ));
    }

}
