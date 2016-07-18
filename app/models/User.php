<?php

/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 20/06/16
 * Time: 15:44
 */

namespace model;

class Model_User extends \RedBean_SimpleModel
{
    public $name;
    public $timestamps = false;
    protected $fillable =[
        'name',
        'email'
    ];


}