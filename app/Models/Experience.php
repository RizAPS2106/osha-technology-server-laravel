<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    protected $table = 'experience';
    protected $guarded = [];
    protected $hidden = [];

    public function applicant()
    {
        return $this->belongsTo('App\Models\Applicant');
    }

    public function jobdesc()
    {
        return $this->hasMany('App\Models\JobDesc');
    }
}
