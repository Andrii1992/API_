@extends('layouts.admin_layout')
@section('title','Nowy użytkownik')

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-8">
            <div class="">


                <div class="mx-md-4">
                    <h2 class="col-md-6">Nowy użytkownik</h2>
                    <form action="{{ route('postCreateUserAdmin') }}" enctype="multipart/form-data" method="POST" role="form">
                        <div class="form-group">
                            <div class="form-group">
                                @csrf

                                <div class="form-group ">
                                    <label for="name" class="col-md-6">{{ __('Imię') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" placeholder="Imię" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-md-6">{{ __('Email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="password" class="col-md-6">{{ __('Hasło') }}</label>

                                    <div class="col-md-6">
                                        <input placeholder="********" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-6">{{ __('Potwierdź hasło') }}</label>

                                    <div class="col-md-6">
                                        <input placeholder="********" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputGroupSelect" class="col-md-6">Rola</label>
                                    <div class="input-group col-md-6">
                                        <select name="role" class="custom-select" id="inputGroupSelect">
                                            <option selected="selected" value="user">Użytkownik</option>
                                            <option value="admin">Admin</option>
                                            <option value="brak">brak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" value="Ok" class="btn btn-dark px-5">
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')