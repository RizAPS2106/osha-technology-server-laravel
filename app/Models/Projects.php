<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projects extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    protected $table = 'work_projects';
    protected $guarded = [];
    protected $hidden = [];

    public function experience()
    {
        return $this->belongsTo('App\Models\Experience');
    }
}
