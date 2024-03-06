<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Success;

class Quiz extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'quiz_name',
        'description'
    ];
    public function questions() {
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }

    public function success() {
        return $this->belongsTo(Success::class);
    }
}
