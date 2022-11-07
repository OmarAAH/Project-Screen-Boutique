@extends('layouts.template')

@section('content')

<div class="vh-100 body__login--color">
    <div class="container position-absolute top-50 start-50 translate-middle" >
        <div class="card w-100">
            <div class="row g-0">
                <div class="col-md-6 col-lg-6 d-none d-md-block imagen__background--color">
                    <img src="{{ asset('images/logo.png')}}" alt="login form" class="position-relative top-50 start-50 translate-middle" width="75%"/> 
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="card-body p-4 p-lg-5">
                        <form method="post">
                            @csrf
                            <div class="row">
                                <div class="col-5 mb-3 login__titulo--border">
                                    <h4>Inicio de Sesión</h4>
                                </div>
                                <div class="col-10 mb-3">
                                    <label class="form-label" for="inputUser">Usuario</label>
                                    <input type="text" name="user" id="inputUser" class="form-control" placeholder="Nombre de Usuario" value="{{old('user')}}">
                                    @error('user') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-10 mb-5">
                                    <label class="form-label" for="inputPassword">Contraseña</label>
                                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" maxlength="8">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-10 mb-5">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-outline-success" type="button">Iniciar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>

@endsection
