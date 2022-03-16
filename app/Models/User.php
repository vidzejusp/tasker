<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'current_company',
        'current_employee',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
//    protected $appends = [
//        'profile_photo_url',
//    ];

    public function Relation()
    {
        return $this->hasMany(Relation::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'current_company');
    }

    public function CurrentCompany()
    {
        $company_id = $this->current_company;
        return Company::find($company_id);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'relations');
    }

    public function companyRole()
    {
        $relation = Relation::where('company_id', Auth::user()->current_company)->where('user_id', $this->id)->first();
        return $relation->role;
    }

    public function relations()
    {
        return Relation::where('user_id', $this->id);//->where('company_id', '!=', $this->CurrentCompany()->id);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'current_employee');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'user_id');
//        $employees = Employee::where('user_id', $this->id)->get();
//        return $employees;
    }

    public function HasEmployees()
    {
        return Employee::where('user_id', Auth::id())->exists();
    }

    public function CurrentEmployee()
    {
        return Employee::find($this->current_employee);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id');
    }

    public function taskArchives()
    {
        return $this->hasMany(TaskArchive::class, 'user_id');
    }

    public function Notes()
    {
        return $this->hasMany(Note::class, 'created_by');
    }
}
