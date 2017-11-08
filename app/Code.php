<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = [
        'code', 'contest_id', 'used_by'
    ];

    protected $table = 'codes';

}
