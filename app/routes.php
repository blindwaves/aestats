<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('job', function() {
    $genericUrl = 'http://{server}.astroempires.com/ranks.aspx?view={category}&see={page}';
    $servers = array('andromeda');
    $categories = array(
        //'', 'ply_economy', 'ply_fleet', 'ply_technology', 'ply_experience',
        'guilds_level', 'guilds_economy', 'guilds_fleet', 'guilds_technology', 'guilds_experience'
    );
    //$pages = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
    $pages = array('1');
    $batch = uniqid();

    foreach($servers as $server) {
        $pageUrl = str_replace('{server}', $server, $genericUrl);

        foreach($categories as $category) {
            $pageUrl = str_replace('{category}', $categories[0], $pageUrl);

            foreach($pages as $page) {
                if (strpos($category, 'guilds_') == 0 && $page == '3') {
                    // Guild only have 2 pages.
                    break;
                }

                $pageUrl = str_replace('{page}', $pages[0], $pageUrl);

                Queue::push('AeStatsParserService', array('batch' => $batch, 'category' => $category, 'server' => $server, 'url' => $pageUrl));
            }
        }
    }
});

Route::controller('server/{name}', 'ServerController');
Route::controller('/', 'HomeController');
