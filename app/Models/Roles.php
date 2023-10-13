<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    //fillable roles
    protected $fillable = [
        'name',
    ];

    //relation to users
    public function users()
    {
        return $this->hasMany(User::class, 'id_role');
    }
}
