<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetingMinutes extends Model
{
    use HasFactory;
//    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'meeting_id',
        'user_id',
        'content',
        'deleted_at',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
