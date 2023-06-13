<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCertificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'c_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function certeficate()
    {
        return $this->belongsTo(Certificate::class, 'c_id', 'id');
    }
}
