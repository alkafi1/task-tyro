<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'endpoint',
        'timestamp'
    ];

    // Optional: If you want to specify the table name
    protected $table = 'task_logs';
}
