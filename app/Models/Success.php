<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Success extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['user_id', 'quiz_id', 'completed'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function quizes() {
        return $this->hasMany(Quiz::class);
    }
}

