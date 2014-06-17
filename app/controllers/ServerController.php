<?php

use Goutte\Client;

class ServerController extends BaseController {

    public function getIndex()
    {
        $genericUrl = 'http://{server}.astroempires.com/ranks.aspx?view={category}&see={page}';
        $servers = array('andromeda');
        $categories = array('', 'ply_economy', 'ply_fleet', 'ply_technology', 'ply_experience');
        $pages = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');

        $client = new Client();

        $pageUrl = str_replace('{server}', $servers[0], $genericUrl);
        $pageUrl = str_replace('{category}', $categories[0], $pageUrl);
        $pageUrl = str_replace('{page}', $pages[0], $pageUrl);

        $crawler = $client->request('GET', $pageUrl);

        $content = $crawler->filter('#ranks_table-players .layout a')->each(function ($node) {
            return $node->text()."\n";
        });

        return View::make('server/index', array(
            'content' => $content,
        ));
    }

}
