<?php

use Goutte\Client;

class AeStatsParserService {

    public function fire($job, $data)
    {
        $client = new Client();
        $crawler = $client->request('GET', $data['url']);
        $content = $crawler->filter('.layout.listing.tbllisting1 tr:not(.listing-header) td')->each(function ($node) {
            $anchors = $node->filter('a')->extract(array('href'));

            $item = array();
            $item['text'] = $node->text();
            $item['href'] = (count($anchors) > 0) ? $anchors[0] : '';
            return $item;
        });;

        for($i = 0; $i < count($content); $i++) {
            $history = new History;
            $history->batch = $data['batch'];
            $history->category = $data['category'];
            $history->server = $data['server'];

            if ($data['category'] == '' || strpos($data['category'], 'ply_') === 0) {
                // All player's rank table has 3 columns: RANK | PLAYER | LEVEL/ECONOMY/ETC...
                $history->rank = $content[$i]['text'];
                $i++;

                $tagIndex = strpos($content[$i]['text'], ']  ');
                if ($tagIndex === false) {
                    $history->name = $content[$i]['text'];
                    $history->tag = '';
                } else {
                    $history->name = substr($content[$i]['text'], $tagIndex + 3);
                    $history->tag = substr($content[$i]['text'], 0, $tagIndex + 1);
                }
                
                $history->url = $content[$i]['href'];

                $i++;
                $history->value = $content[$i]['text'];
            } else {
                // All guild's rank table has 6 columsn: RANK | GUILD | NAME | LEVEL/ECONOMY/ETC... | MEMBERS | AVG.
                $history->rank = $content[$i]['text'];
                $i++;
                $history->tag = $content[$i]['text'];
                $i++;
                $history->name = $content[$i]['text'];
                $history->url = $content[$i]['href'];
                $i++;

                // "|" delimiter for value|members|avg
                $history->value = $content[$i]['text'];
                $i++;
                $history->value .= '|'.$content[$i]['text'];
                $i++;
                $history->value .= '|'.$content[$i]['text'];
            }

            $history->save();
        }

        $job->delete();
    }

}
