<?php

namespace App\Models;

use App\Models\Model;

class User extends Model
{
    

    function __construct() {}

    /**
     * Get the value of name
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of surnames
     */
    function getSurnames()
    {
        return $this->surnames;
    }

    /**
     * Get the value of username
     */
    function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of password
     */
    function getPassword()
    {
        return $this->password;
    }


    /**
     * Get the value of role
     */
    function getRole()
    {
        return $this->role;
    }
}
