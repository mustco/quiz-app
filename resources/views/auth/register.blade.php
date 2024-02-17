@extends('layouts.auth')

@section('content')
                        <h5 class="text-dark fw-bold mb-4">Sign Up</h5>
                        <form method="POST" action="{{ route('register') }}">
                        @csrf

                            <div class="mb-3">
                                <label for="name" class="mb-1">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Tulis nama kamu"
                                    autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="mb-1">Alamat Email</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Tulis alamat email kamu">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="mb-1">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="masukan password kamu">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>
                            <button class="btn btn-primary d-block w-100 mb-3" type="submit">Sign Up</button>
                            <p class="mb-0 text-secondary text-center">
                                Sudah memiliki akun? <a href="{{ route('login') }}">Login</a>
                            </p>
                        </form>
@endsection