@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body text-center">
                <a href="{{ route('notices.home') }}" class="text-nowrap logo-img">
                    <img src="{{ asset('assets/images/logos/logo.png') }}"  style="margin: auto; object-fir: contain;" width="200" height="200" alt="" />
                </a>
                <h5 class="card-title fw-semibold mb-4">¡Bienvenido!</h5>
                <p>
                    Gracias por unirte a nuestro sitio. A continuación, encontrarás tus credenciales de inicio de sesión:
                </p>
                <ul>
                    <li><strong>Correo electrónico:</strong> {{ $correo ?? NULL }}</li>
                    <li><strong>Contraseña:</strong> {{ $password ?? NULL }}</li>
                </ul>
                <p>
                    Por favor, inicia sesión utilizando estas credenciales y disfruta de todos nuestros servicios.
                </p>
                <a href="{{ route('login') }}">Ingresa aquí</a>
            </div>
        </div>
    </div>
@endsection
