@extends('layouts.app')

@section('titulo')
    Inicia Sesión en DevStagram
@endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-10 md:items-center">

        <div class="md:w-8/12">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-10 rounded-lg shadow-lg">
            <form action="{{ route('login') }}" method="post" novalidate>
                @csrf

                @if (session('mensaje'))
                    <p class="bg-red-700 text-white text-sm p-2 rounded-lg mb-2"> {{ session('mensaje') }} </p>
                @endif

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold"> Correo de registro </label>
                    <input type="email" id="email" name="email" class="border p-3 w-full rounded-lg @error('email') border-red-700 @enderror" placeholder="Correo" value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-700 text-white text-sm p-2 rounded-lg mt-2"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold"> Contraseña </label>
                    <input type="password" id="password" name="password" class="border p-3 w-full rounded-lg @error('password') border-red-700 @enderror" placeholder="Contraseña" value="{{ old('password') }}">
                    @error('password')
                        <p class="bg-red-700 text-white text-sm p-2 rounded-lg mt-2"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember"> Mantener mi sesión abierta </label>
                </div>

                <input type="submit" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" value="Iniciar Sesión">
            </form>
        </div>

    </div>
    
@endsection