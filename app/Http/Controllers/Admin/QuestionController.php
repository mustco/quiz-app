<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\QuestionImport;
use App\Models\Question;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    public function store(Request $request) {
        $data = $request->all();
        Question::create($data);

        return redirect()->back();
    }
    public function destroy(string $id) {
        Question::find($id)->delete();

        return redirect()->back();
    }

    public function import_excel(Request $request) {
       // validasi 
 $this->validate($request, [
    'file' => 'required|mimes:csv,xls,xlsx'
    ]);
    $quiz_id = $request->quiz_id;

    
    // menangkap file excel
    $file = $request->file('file');
    
    // membuat nama file unik 
    $nama_file = rand().$file->getClientOriginalName();
    
    // upload ke folder file_siswa di dalam folder public
    $file->move('file_siswa',$nama_file);
    
    // import data
    $data = Excel::toArray(new QuestionImport($quiz_id), public_path('/file_siswa/'.$nama_file));
    // dd($data);
    $datas= $data[0];
    // dd($datas);
  foreach($datas as $dataa) {
    // dd($datas);
    if ($dataa[1] == 'question') {
        continue;
    }
    Question::create([
        'quiz_id' => $quiz_id,
        'question' => $dataa[1],
        'answer_a' => $dataa[2],
        'answer_b' => $dataa[3],
        'answer_c' => $dataa[4],
        'answer_d' => $dataa[5],
        'correct' =>$dataa[6]
    ]);
  }
    // Excel::import(new QuestionImport($quiz_id), public_path('/file_siswa/'.$nama_file));
    
    
        return redirect()->back();
    }
    public function download() 
    {
        
    }
}
