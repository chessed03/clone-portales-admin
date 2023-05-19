@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"><strong>Login</strong></div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">

                @csrf

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Correo</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <br>
                
                <div class="row mb-0">
                    <div class="col-12 text-right">

                        <button type="submit" class="btn btn-primary elevation-2">
                            <strong><i class='bx bx-fw bx-log-in'></i> Iniciar sesión</strong>
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
 
@endsection
