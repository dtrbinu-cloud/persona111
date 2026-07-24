@extends('layouts.app')

@section('title', 'Register - EngPersona')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card ep-card">
            <div class="card-body p-4">
                <h3 class="fw-bold mb-1">Register</h3>
                <p class="text-secondary mb-4">Buat akun EngPersona</p>

                <form action="{{ route('register.store') }}" method="POST" class="d-grid gap-3">
                    @csrf
                    <div>
                        <label class="form-label">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" required>
                        @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button class="btn btn-primary">Register</button>
                </form>

                <p class="text-secondary mt-3 mb-0">
                    Sudah punya akun? <a href="{{ route('login') }}">Login</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
