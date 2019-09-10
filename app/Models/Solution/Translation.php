<?php

namespace App\Models\Solution;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    /**
     *  Table name in the database.
     *  @var string
     */
    protected $table = 'solution_translations';
    
    /**
     *  List of variables that cannot be mass assigned
     * @var array
     */
    protected $fillable = ['title', 'text', 'locale', 'solution_id'];

    public $timestamps = false;
}