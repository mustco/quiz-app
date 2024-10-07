@extends('layouts.admin')

@section('content')
<h4 class="text-dark mb-1">{{$quiz->quiz_name}}</h4>
<p class="text-dark mb-5">{{$quiz->description}}</p>
<p class="text-danger">Kuis ini sudah tidak bisa dikerjakan oleh siswa karena waktu pengerjaannya sudah selesai</p>
<div class="card border-0 mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Lengkap</th>
                        <th>Perolehan PG</th>
                        <th>Nilai PG</th>
                        <th>Nilai Total</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="align-middle">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->name}}</td>
                        <td> {{ $user->answers->where('is_correct', 'yes')->count() }}/{{$user->answers->count()}}</td>
                            <td>@php
                                $nilai = $user->answers->where('is_correct', 'yes')->count()/$user->answers->count() *100
                            @endphp
                                  {{ number_format($nilai, 2) }}
                            </td>
                        <td> {{ number_format($nilai, 2) }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <form action="{{ route('showByUserId', [$quiz->id, $user->id]) }}" method="post">
                                    @csrf
                                    <!-- Ganti nama untuk hidden input agar tidak bentrok dengan parameter URL -->
                                    <input type="hidden" value="{{ $quiz->quiz_name }}" name="form_quiz_name">
                                    <input type="hidden" value="{{ $quiz->description }}" name="form_quiz_desc">
                            
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Lihat
                                    </button>
                                </form>
                            </div>
                            
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <form action="{{route('kuis-completed.destroy',$user->id)}}" method="post" onsubmit="return confirm('Hapus?')">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                   Reset
                                </button>
                            </form>
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