<?php

use Goutte\Client;

class HomeController extends BaseController {

    public function getIndex()
    {
        if (strcmp($_SERVER['HTTP_HOST'], '128.199.233.47') === 0) {
            return Redirect::away('http://fundnel.crashtesttheory.com/');
        } else {
            return View::make('home/index');
        }
    }

}
