<?php

class History extends Eloquent {

    public function getGuildLocalLink()
    {
        $guild = History::where('server', '=', $this->server)
                        ->where('batch', '=', $this->batch)
                        ->where('tag', '=', $this->tag)
                        ->where('url', 'LIKE', 'profile.aspx?guild=%')
                        ->first();

        if ($guild->isEmpty) {
            return $this->tag;
        } else {
            $index = strrpos($guild->url, '=');
            return '<a href="'.URL::action('ServerController@getGuild', array($this->server, substr($guild->url, $index + 1))).'">'.$this->tag.'</a>';
        }
    }

    public function getNonLocalisedValue()
    {
        return str_replace(',', '', $this->value);
    }

    public function getPlayerId()
    {
        $index = strrpos($this->url, '=');
        return substr($this->url, $index + 1);
    }

    public function getRecordJavascriptDateString()
    {
        $date = $this->updated_at;

        return 'new Date('
            .$date->year.', '
            .($date->month - 1).', ' // JavaScript month is 0 indexed.
            .$date->day.', '
            .$date->hour.', '
            .$date->minute.', '
            .$date->second.
        ')';
    }

}
