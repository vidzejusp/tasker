<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Note extends Model
{
    use HasFactory, LogsActivity;

    protected static $logAttributes = ["*"];
    protected static $logFillable = true;

    public $fillable = [
        'name',
        'description',
        'category',
        'created_by',
        'important',
    ];

    public function Category()
    {
        return $this->belongsTo(NotesCategory::class, 'category');
    }

    public function Author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
