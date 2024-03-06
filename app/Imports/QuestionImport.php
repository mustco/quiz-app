<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $quiz_id;

    public function __construct($quiz_id)
    {
        $this->quiz_id = $quiz_id;
    }
    public function model(array $row)
    {
        // dd($row);
        return new Question([
            'quiz_id' => $this->quiz_id,
            'question' => $row[1],
            'answer_a' => $row[2],
            'answer_b' => $row[3],
            'answer_c' => $row[4],
            'answer_d' => $row[5],
            'correct' => $row[6]
        ]);
    }
    
}
