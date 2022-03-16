<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'company_id',
        'details',
        'date_start',
        'date_finish',
        'repeat_duration',
        'repeat_type',
        'status',
        'require_location',
        'finish_location',
        'location',
        'completed_by',
        'created_by'
    ];

    protected $casts = [
        'date_start' => 'datetime:Y-m-d H:i',
        'date_finish' => 'datetime:Y-m-d H:i',
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
