<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['name','mobile','email','dob','create_at','update_at'];

    public function educations()
    {
        return $this->hasMany(Education::class);
    }
}
