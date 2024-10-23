<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeMeeting extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'me_id',                // Unique meeting ID
        'user_id',              // Foreign key for the user who created the meeting
        'title',                // Title of the meeting
        'description',          // Description of the meeting
        'date_and_time',        // Date and time of the meeting
        'location',             // Location of the meeting
        'path_attachment',      // Path to any attachment for the meeting
        'meeting_status',       // Status: Digital or Manual
        'status',               // Lock or Unlock status of the meeting
    ];

    public function agendaItems()
    {
        return $this->hasMany(CommitteeMeetingAgendaItem::class);
    }



    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



}
