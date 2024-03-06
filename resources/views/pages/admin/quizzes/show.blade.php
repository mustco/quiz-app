@extends('layouts.admin')
@include('pages.admin.quizzes.modal')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-5">
                <h4 class="text-dark">Pertanyaan Kuis {{$quiz->quiz_name}}</h4>
                <div class="button d-flex justify-content-center">
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-primary me-1">
                    <i class="bx bx-plus"></i> Tambah Pertanyaan
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#importExcel" class="btn btn-primary">
                    <i class="bx bx-plus"></i> Import Excel
                </button>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quiz->questions as $key => $value)
                                <tr class="align-middle">
                                    <td>{{++$key}}</td>
                                    <td>{{$value->question}}</td>
                                    <td>
                                        <ol class="ps-3" type="A">
                                            <li class="{{$value->correct == 'a' ? 'text-success fw-bold' : ''}}">{{$value->answer_a}}</li>
                                            <li class="{{$value->correct == 'b' ? 'text-success fw-bold' : ''}}">{{$value->answer_b}}</li>
                                            <li class="{{$value->correct == 'c' ? 'text-success fw-bold' : ''}}">{{$value->answer_c}}</li>
                                            <li class="{{$value->correct == 'd' ? 'text-success fw-bold' : ''}}">{{$value->answer_d}}</li>
                                            
                                        </ol>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-light">
                                                <i class="bx bx-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        
@endsection