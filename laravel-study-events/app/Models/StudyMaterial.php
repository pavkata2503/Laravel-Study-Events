<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['study_event_id', 'path', 'original_name', 'title', 'file_type'];

    public function studyEvent()
    {
        return $this->belongsTo(StudyEvent::class);
    }
}