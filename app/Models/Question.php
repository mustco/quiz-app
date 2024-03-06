<?php

namespace App\Models;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;

class Question extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['quiz_id', 'question', 'answer_a', 'answer_b', 'answer_c', 'answer_d', 'correct'];

    public function quiz() {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }

    public function answers() {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
    
}
