<?php

class History extends Eloquent {

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
