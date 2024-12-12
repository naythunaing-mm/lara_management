<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
