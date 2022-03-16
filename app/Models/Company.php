<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'prefix',
        'owner',
    ];

    public function Relations()
    {
        return $this->hasMany(Relation::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'relations');
    }

    public function User()
    {
        return $this->hasMany(User::class);
    }

    public function Employees()
    {
        return $this->users()->Employees()->get();
//        $users = $this->Users();
//        $employees = [];
//        foreach($users as $user)
//        {
//            array_push($employees, $user);
//        }
//        return $employees;
    }
}
