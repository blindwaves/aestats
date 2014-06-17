<?php

use Goutte\Client;

class AeStatsParserService {

    public function fire($job, $data)
    {
        $client = new Client();
        $crawler = $client->request('GET', $data['url']);
        $content = $crawler->filter('.layout.listing.tbllisting1 tr:not(.listing-header) td')->each(function ($node) {
            return $node->text();
        });;

        for($i = 0; $i < count($content); $i++) {
            $history = new History;
            $history->batch = $data['batch'];
            $history->category = $data['category'];
            $history->server = $data['server'];

            if ($data['category'] == '' || strpos($data['category'], 'ply_') == 0) {
                // All player's rank table has 3 columns: RANK | PLAYER | LEVEL/ECONOMY/ETC...
                $history->rank = $content[$i];
                $i++;

                $space = strpos($content[$i], ' ');
                $history->name = substr($content[$i], $space + 2);
                $history->tag = substr($content[$i], 0, $space);;

                $i++;
                $history->value = $content[$i];
            } else {

            }

            $history->save();
        }
    }

}
