<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     *  Table name in the database.
     * @var string
     */
    protected $table = 'team';
    
    /**
     * @param $data
     * @return Team
     *
     * Creating a new field in the table
     */
    static public function createTeam($data)
    {
        $team = new Team();
        $team->image    = $data['image'];
        $team->name     = $data['name'];
        $team->position = $data['position'];
        $team->enabled  = isset($data['enabled']) ? 1 : 0;
        $team->order    = isset($data['order']) ? $data['order'] : 0;
        
        return $team;
    }
    
    /**
     * @param $data
     *
     * Update values in a field
     */
    public function editTeam($data)
    {
        $this->image    = is_null($data['image']) ? $data['image'] : $this->image;
        $this->name     = $data['name'];
        $this->position = $data['position'];
        $this->enabled  = $data['enabled'];
    }
    
    /**
     * @param $query
     * @return mixed
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', 1);
    }
}
