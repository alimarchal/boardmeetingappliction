<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeMeeting extends Model
{
    use HasFactory;

    protected $fillable = ['committee_id', 'meeting_date', 'title','user_id'];

    public function committee()
    {
        return $this->belongsTo(MeetingCommittee::class, 'committee_id');
    }
}
