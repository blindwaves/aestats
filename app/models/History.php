<?php

class History extends Eloquent {

    public function getPlayerId()
    {
        $index = strrpos($this->url, '=');
        return substr($this->url, $index + 1);
    }

}
