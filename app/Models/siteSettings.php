<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siteSettings extends Model
{
    use HasFactory;
    protected $fillable = [
                            'id',
                            'name',
                            'email',
                            'address',
                            'checkin',
                            'checkout',
                            'online_phone',
                            'outline_phone',
                            'size_unit',
                            'occupancy',
                            'price_unit',
                            'logo',
                            'deleted_by'
                        ];
}
