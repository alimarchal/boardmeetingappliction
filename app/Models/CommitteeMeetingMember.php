<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeMeetingMember extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['created_by_id', 'committee_meeting_id', 'user_id'];
}
