<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Committee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id','name', 'description'];

//    public function members()
//    {
//        return $this->belongsToMany(User::class, 'committee_members')
//            ->withTimestamps();
//    }


    public function members(): HasMany
    {
        return $this->hasMany(CommitteeMember::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function meetings()
    {
        return $this->hasMany(CommitteeMeeting::class);
    }

}
