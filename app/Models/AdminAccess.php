<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class AdminAccess extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    protected $table = 'admin_access';
    protected $guarded = [];
    protected $hidden = [];

    
}
