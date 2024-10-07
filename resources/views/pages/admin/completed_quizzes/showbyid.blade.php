@extends('layouts.admin')

@section('content')
<h4 class="text-dark mb-1">{{$quiz_name}}</h4>
<p class="text-dark mb-5">{{$quiz_desc}}</p>
<div class="card border-0 mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quiz as $pertanyaan)
                    @foreach ($pertanyaan->questions as $tanya)
                    <tr>
                     
                        <td>{{$loop->iteration}}</td>
                        <td>{{$tanya->question}}</td>
                        <td>
                            <ol type="A">
                                <li class="{{$tanya->correct == 'a' ? 'text-success fw-bold' : ''}} {{ $tanya->answers->first()?->answer == 'a' && $tanya->correct != 'a' ? 'text-danger fw-bold' : '' }}">{{$tanya->answer_a}}</li>
                                <li class="{{$tanya->correct == 'b' ? 'text-success fw-bold' : ''}} {{ $tanya->answers->first()?->answer == 'b' && $tanya->correct != 'b' ? 'text-danger fw-bold' : '' }}">{{$tanya->answer_b}}</li>
                                <li class="{{$tanya->correct == 'c' ? 'text-success fw-bold' : ''}} {{ $tanya->answers->first()?->answer == 'c' && $tanya->correct != 'c' ? 'text-danger fw-bold' : '' }}">{{$tanya->answer_c}}</li>
                                <li class="{{$tanya->correct == 'd' ? 'text-success fw-bold' : ''}} {{ $tanya->answers->first()?->answer == 'd' && $tanya->correct != 'd' ? 'text-danger fw-bold' : '' }}">{{$tanya->answer_d}}</li>
                            </ol>
                            
                        </td>
                    </tr>
                    @endforeach
                       
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection