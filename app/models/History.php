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

}
