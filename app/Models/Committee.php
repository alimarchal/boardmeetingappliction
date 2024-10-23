<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Committee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description'];

    public function members()
    {
        return $this->belongsToMany(User::class, 'committee_members')
            ->withPivot('role')
            ->withTimestamps();
    }


    public function meetings()
    {
        return $this->hasMany(CommitteeMeeting::class);
    }

}
