<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    protected $table = 'applicant';
    protected $guarded = [];
    protected $hidden = [];
}
