<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Answer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'question_id', 'success_id', 'answer', 'is_correct'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function question() {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function success() {
        return $this->belongsTo(Success::class);
    }
}
