@extends('todos.layout')

@section('content')
    <div class="flex justify-between my-2 border-b pb-4 px-4">
        <h1 class="text-2xl">What next you need To-Do</h1>
        <a class="mx-5 text-2xl text-gray-400 cursor-pointer text-white" href="{{route('todo.index')}}"><span class="fas fa-arrow-left"></span></a>
    </div>

    <x-alert />
    <form action="{{route('todo.store')}}" method="POST" class="py-5">
        @csrf
        <div class="py-1">
            <input type="text" name="title" class="p-2 rounded border" placeholder="Title"/>
        </div>
        <div class="py-1">
            <textarea name="description" class="p-2 rounded border" placeholder="Description"></textarea>
        </div>
        <div class="py-2">

            @livewire('step')
            
        </div>
        <div class="py-1">
            <input type="submit" value="Create" class="p-2 border rounded"/>
        </div>
    </form>

    {{-- @livewire('counter') --}}
    {{-- <livewire:counter /> --}}

@endsection