@extends('layouts.app')

@section('titulo')
    Registrate en DevStagram
@endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-10 md:items-center">

        <div class="md:w-8/12">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-10 rounded-lg shadow-lg">
            <form action="{{ route('register') }}" method="post" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold"> Nombre </label>
                    <input type="text" id="name" name="name" class="border p-3 w-full rounded-lg @error('name') border-red-700 @enderror" placeholder="Nombre" value="{{ old('name') }}">
                    @error('name')
                        <p class="bg-red-700 text-white text-sm p-2 rounded-lg mt-2"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold"> Nombre de Usuario </label>
                    <input type="text" id="username" name="username" class="border p-3 w-full rounded-lg @error('username') border-red-700 @enderror" placeholder="Nombre de Usuario" value="{{ old('username') }}">
                    @error('username')
                        <p class="bg-red-700 text-white text-sm p-2 rounded-lg mt-2"> {{ $message }} </p>
                    @enderror
                </div>

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
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold"> Repite tu Contraseña </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="border p-3 w-full rounded-lg @error('password') border-red-700 @enderror" placeholder="Repite tu contraseña">
                    @error('password')
                        <p class="bg-red-700 text-white text-sm p-2 rounded-lg mt-2"> {{ $message }} </p>
                    @enderror
                </div>

                <input type="submit" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" value="Crear Cuenta">
            </form>
        </div>

    </div>
    
@endsection