<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = [

        'name', 'description'
    ];
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_certificate', 'c_id', 'user_id');
    }
}
