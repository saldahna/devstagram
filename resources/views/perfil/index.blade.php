@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')

    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6 rounded-lg">
            <form method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold"> Username </label>
                    <input 
                        type="text"
                        id="username" 
                        name="username" 
                        class="border p-3 w-full rounded-lg @error('username') border-red-700 @enderror"
                        placeholder="Username"
                        value="{{ auth()->user()->username }}"
                    />
                    @error('username')
                        <p class="bg-red-700 text-white text-sm p-2 rounded-lg mt-2"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold"> Correo </label>
                    <input 
                        type="text"
                        id="email" 
                        name="email" 
                        class="border p-3 w-full rounded-lg @error('email') border-red-700 @enderror"
                        placeholder="Correo"
                        value="{{ auth()->user()->email }}"
                    />
                    @error('email')
                        <p class="bg-red-700 text-white text-sm p-2 rounded-lg mt-2"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold"> Imagen Perfil </label>
                    <input 
                        type="file" 
                        id="imagen" 
                        name="imagen" 
                        class="border p-3 w-full rounded-lg"
                        value=""
                        accept=".jpg, .jpeg, .png"
                    />
                </div>

                <input 
                    type="submit"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                    value="Guardar Cambios"
                />

            </form>
        </div>
    </div>
    
@endsection