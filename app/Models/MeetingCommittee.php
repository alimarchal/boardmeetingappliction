<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingCommittee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function members()
    {
        return $this->hasMany(CommitteeMember::class, 'committee_id');
    }

    public function meetings()
    {
        return $this->hasMany(CommitteeMeeting::class, 'committee_id');
    }
}
