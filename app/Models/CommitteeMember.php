<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    use HasFactory;

    protected $fillable = ['committee_id', 'user_id', 'name', 'position'];

    public function committee()
    {
        return $this->belongsTo(MeetingCommittee::class, 'committee_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
