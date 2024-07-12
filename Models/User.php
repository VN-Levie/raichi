<?php

namespace App\Models;



class User extends Model
{
    protected static $table = 'users';


    public $username;
    public $password;
   
}
