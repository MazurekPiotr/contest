<?php

namespace App\Contest;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{

    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'active', 'winner_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function users() {
        return $this->belongsToMany('App\User\User');
    }
}
