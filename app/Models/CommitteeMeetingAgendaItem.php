<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeMeetingAgendaItem extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    protected $fillable = [
        ' committee_meeting_id',       // Foreign key to the meeting this agenda item belongs to
        'user_id',          // Foreign key for the user who created this agenda item
        'title',            // Title of the agenda item
        'description',      // Description of the agenda item
        'order',            // Order in which this agenda item appears in the meeting
    ];

    public function committeeMeeting()
    {
        return $this->belongsTo(CommitteeMeeting::class);
    }

    public function comments()
    {
        return $this->hasMany(CommitteeMeetingComment::class);
    }
}