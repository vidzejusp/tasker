<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class NotesCategory extends Model
{
    use HasFactory, LogsActivity;

    protected static $logAttributes = ["*"];
    protected static $logFillable = true;

    public $fillable = [
        'name',
        'company_id',
        'created_by',
    ];

    public function Notes()
    {
        return $this->hasMany(Note::class, 'category' );
    }


}
