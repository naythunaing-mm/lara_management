<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Department;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone',
        'nrc_number',
        'birthday',
        'gender',
        'address',
        'department_id',
        'date_of_join',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $keyType = 'int';
    public $incrementing = true;
    public function getFormattedIdAttribute()
    {
        return 'LMS-' . str_pad($this->id, 8, '0', STR_PAD_LEFT);
    }

    public function getDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function profilePath()
    {
        if ($this->profile) {
            return asset('Storage/employee/' . $this->profile);
        }
        return null;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
