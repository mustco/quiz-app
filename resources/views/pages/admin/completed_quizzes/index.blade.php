@extends('layouts.admin')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-5">
                <h4 class="text-dark">Kuis Selesai</h4>
               
            </div>

            <div class="card border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Kuis</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes as $key => $item) 
                                <tr class="align-middle">
                                    <td>{{++$key}}</td>
                                    <td>{{$item->quiz_name}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{route('kuis-completed.show', $item->id)}}" class="btn btn-sm btn-info text-white">
                                                <i class="bx bx-file"></i> Lihat
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="deleteKuis{{$item->id}}" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Hapus {{$item->quiz_name}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <form action="{{route('kuis.destroy', $item->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            

         
@endsection
