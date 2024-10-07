
@extends('layouts.home')

@section('title')
<div class="mt-4">
    <h4>{{$quiz->quiz_name}}</h4> 
    <h5>{{$quiz->description}}</h5>
    <h5>Sisa Waktu: <span id="timer"></span></h5>

</div>
@endsection

@section('sidebar-content')
<div class="mt-3 mb-2 card border-0">
    <div class="card-title ps-5 pt-2 pb-0">Daftar Soal:</div>
    <div class="card-body pt-1 pb-2 d-flex flex-wrap justify-content-start">
        <div class="d-flex overflow-auto">
            
            @foreach ($questionAll as $item)

            <a href="{{ route('kuis.pertanyaan', ['quiz_id' => $quiz_id, 'question_id' => $item->id]) }}" class="btn m-1 {{ $item->answers->isNotEmpty() && $item->answers->where('user_id', Auth::user()->id)->first() !== null ? 'btn-success' : 'border' }}">
                <span class="number">{{ $loop->iteration }}</span>
            </a>
            
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card border-0">
    <div class="card-body">
        <h5 class="text-dark mb-5">{{$questionNumber}}. {{$question->question}}</h5>
        <form action="{{ route('kuis.pertanyaan.store', ['quiz_id' => $quiz_id, 'question_id' => $question->id]) }}" method="post">
            @csrf
            @method('POST')
            <input type="hidden" name="quiz_id" value="{{$quiz_id}}">
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input border-secondary" type="radio" name="answer" id="answer_a" value="a" 
                        {{ $answer_checked === 'a' ? 'checked' : '' }}>
                    <label class="form-check-label" for="answer_a">
                        {{$question->answer_a}}
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input border-secondary" type="radio" name="answer"
                        id="answer_b" value="b" {{ $answer_checked === 'b' ? 'checked' : '' }}>
                    <label class="form-check-label" for="answer_b">
                        {{$question->answer_b}}
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input border-secondary" type="radio" name="answer"
                        id="answer_c" value="c" {{ $answer_checked === 'c' ? 'checked' : '' }}>
                    <label class="form-check-label" for="answer_c">
                        {{$question->answer_c}}
                    </label>
                </div>
            </div>
            <div class="mb-5">
                <div class="form-check">
                    <input class="form-check-input border-secondary" type="radio" name="answer"
                        id="answer_d" value="d" {{ $answer_checked === 'd' ? 'checked' : '' }}>
                    <label class="form-check-label" for="answer_d">
                        {{$question->answer_d}}
                    </label>
                </div>
            </div>
            <div class="button d-flex align-items-center justify-content-between">
                <input type="hidden" id="actionInput" name="action">
                @if (!$prev_question)
                <button style="visibility: hidden;" class="btn btn-primary"></button>
                @else
                <button class="btn btn-primary" type="submit" onclick="document.getElementById('actionInput').value= 'prev';">
                    {{$prev_question ? 'Sebelumnya' : '' }}
                </button>
                @endif
             
                <button class="btn btn-primary" type="submit" onclick="document.getElementById('actionInput').value='next';">
                    {{$next_question ? 'Selanjutnya' : 'Kirim' }}
                </button>
                @if(session('alert'))
                <div class="alert alert-danger m-0 ms-2" role="alert">
                    {{session('alert')}}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger m-0 ms-2">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var remainingTime = @json($remaining_time); // Dalam detik
        
        function updateTimer() {
            if (remainingTime <= 0) {
                document.getElementById('timer').innerHTML = 'Waktu habis!';
                window.location.href = "{{route('kuis.berhasil',['quiz_id'=>$quiz_id])}}"
                return;
            }
            var hours = Math.floor(remainingTime / 3600);  
            var minutes = Math.floor((remainingTime % 3600) / 60);  
            var seconds = remainingTime % 60;  

            document.getElementById('timer').innerHTML =
                (hours < 10 ? '0' : '') + hours + ':' +
                (minutes < 10 ? '0' : '') + minutes + ':' +
                (seconds < 10 ? '0' : '') + seconds;

            remainingTime--;

        }

        setInterval(updateTimer, 1000);
    });
</script>