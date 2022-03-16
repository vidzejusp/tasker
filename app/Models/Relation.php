<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'role',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
