<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeMeetingComment extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'user_id',              // Foreign key for the user who made the comment
        'committee_meeting_id',           // Foreign key to the meeting this comment belongs to
        'committee_meeting_agenda_item_id',      // Foreign key to the agenda item this comment is related to (nullable)
        'description',          // The content of the comment
        'path_attachment',      // Path to any attachment related to the comment
    ];
    public function agendaItem()
    {
        return $this->belongsTo(CommitteeMeetingAgendaItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
