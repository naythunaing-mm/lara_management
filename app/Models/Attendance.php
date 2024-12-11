<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'created_at',
        'updated_at',
    ];
    public function getUserID()
    {
        return $this->belongsTo(User::class);
    }
}
