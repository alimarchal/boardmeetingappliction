<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use HasFactory;
    use HasUuids;
    use softDeletes;

    protected $fillable = ['id', 'title', 'me_id','user_id', 'description', 'path_attachment', 'date_and_time', 'location', 'status','meeting_status'];



    public function getSlugAttribute()
    {
        $id = $this->me_id;
        if (is_numeric($id)) {
            $lastDigit = $id % 10;
            $suffix = match ($lastDigit) {
                1 => 'st',
                2 => 'nd',
                3 => 'rd',
                default => 'th',
            };
            return $id . $suffix;
        } else {
            return $id;
        }
    }


    public function agenda_items(): HasMany
    {
        return $this->hasMany(AgendaItems::class, 'meeting_id');
    }
}
