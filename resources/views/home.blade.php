@extends('layouts.app')

@section('titulo')
    Home
@endsection

@section('contenido')

    {{-- En la etiqueta, si no se pone la '/' ( <x-listar-post /> )
        significa que el componente no soporta $slots
    --}}

    <x-listar-post :posts="$posts" />

   {{--  <x-listar-post>
        @slot('titulo')
            <header> Esto es un header </header>
        @endslot
        <h1> Mostrando Post desde Slot </h1>
    </x-listar-post> --}}

    {{-- Código equivalente al ifelse y foreach --}}
    {{-- @forelse ($posts as $post)
        <h1> {{ $post->titulo }} </h1>
    @empty
        <p> No hay posts </p>
    @endforelse --}}

@endsection