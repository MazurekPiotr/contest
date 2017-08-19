<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{

    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'question', 'answer', 'winner_id'
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
        return $this->belongsToMany('App\User');
    }

    public function winner($id) {
        $users = User::all();
        $user = $users->where('id', $id)->first();
        return $user;
    }
}
