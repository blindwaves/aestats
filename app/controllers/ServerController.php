<?php

class ServerController extends BaseController {

    public function getPlayer($name, $id)
    {
        $history = History::where('server', '=', $name)->where('url', '=', 'profile.aspx?player='.$id)->get();

        return View::make('server/player', array(
            'history' => $history,
        ));
    }

}
