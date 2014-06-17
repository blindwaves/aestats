<?php

class ServerController extends BaseController {

    public function getIndex()
    {
        return View::make('server/index', array(
            
        ));
    }

}
