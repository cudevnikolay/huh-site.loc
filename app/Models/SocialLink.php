<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    /**
     *  List of variables that cannot be mass assigned
     * @var array
     */
    protected $fillable = ['alias', 'link'];

    public $timestamps = false;
}
