<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'uid',
        'company_name',
        'contact_person',
        'email',
        'phone_number',
        'address',
        'city',
        'province',
        'country',
        'postal_code',
        'logo',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getLogoUrlAttribute()
    {
        $path = Storage::url('merchant/' . $this->logo);
        return url($path);
    }
}
