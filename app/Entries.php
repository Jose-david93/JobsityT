<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entries extends Model
{
    protected $fillable = [
        'idUser', 'title', 'content'
    ];

    protected $hidden = [
        '_token'
    ];
}
