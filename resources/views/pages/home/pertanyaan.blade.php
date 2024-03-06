@extends('layouts.home')

@section('content')
<section class="pt-5 pb-3">
                    <h4 class="fw-bold">{{$question->quiz->quiz_name}}</h4>
                    <p class="text-secondary">
                        {{$question->quiz->description}}
                        {{$answer_checked}}
                    </p>
                </section>
              
                <section>
                    <div class="card border-0">
                        <div class="card-body">
                            <h5 class="text-dark mb-5">{{$question->question}}</h5>

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
                                <div class="button d-flex align-items-center">
                                <button class="btn btn-primary" type="submit">
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
                </section>
@endsection