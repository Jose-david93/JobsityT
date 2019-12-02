<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HideTweets extends Model
{
    protected $fillable = [
        'tweet',
        'idUser'
    ];
}
