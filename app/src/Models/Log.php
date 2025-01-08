<?php

namespace App\Models;

class Log extends Model
{

    function __construct(){}

    public function getUser()
    {
        return User::find($this->user_id);
    }

}
