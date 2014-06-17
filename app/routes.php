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
        'ply_level' => '', 'ply_economy' => 'ply_economy', 'ply_fleet' => 'ply_fleet', 'ply_technology' => 'ply_level', 'ply_experience' => 'ply_experience',
        'guilds_level' => 'guilds_level', 'guilds_economy' => 'guilds_economy', 'guilds_fleet' => 'guilds_fleet', 'guilds_technology' => 'guilds_technology', 'guilds_experience' => 'guilds_experience'
    );
    $pages = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
    $batch = uniqid();

    if (App::environment('local')) {
        $categories = array(
            'ply_level' => '', 'ply_economy' => 'ply_economy', 'ply_fleet' => 'ply_fleet', 'ply_technology' => 'ply_level', 'ply_experience' => 'ply_experience',
        );
        $pages = array('1');
    }

    foreach($servers as $server) {
        foreach($categories as $categoryKey => $categoryValue) {
            foreach($pages as $page) {
                if (strpos($categoryKey, 'guilds_') === 0 && $page === '3') {
                    // Guild only have 2 pages.
                    break;
                }

                $pageUrl = str_replace('{server}', $server, $genericUrl);
                $pageUrl = str_replace('{category}', $categoryValue, $pageUrl);
                $pageUrl = str_replace('{page}', $page, $pageUrl);
                
                Queue::push('AeStatsParserService', array('batch' => $batch, 'category' => $categoryKey, 'server' => $server, 'url' => $pageUrl));
            }
        }
    }
});

// Customise our route to allow quick replacement for current Eddie.
// http://faboo.org/eddie/andromeda/publicPlayer/playerid/874
Route::get('eddie/{name}/publicPlayer/playerid/{id}', 'ServerController@getPlayer');

Route::controller('server/{name}', 'ServerController');
Route::controller('/', 'HomeController');
