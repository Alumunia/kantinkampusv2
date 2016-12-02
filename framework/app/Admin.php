<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

/**
 * Description of Admin
 *
 * @author alumunia
 */
class Admin extends Authenticable {

    protected $table = 'admin';
    protected $fillable = array('username','password');

}
