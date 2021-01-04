@extends('todos.layout')

@section('content')
    <div class="flex justify-between my-2 border-b pb-4 px-4">
        <h1 class="text-2xl">All Your Todos</h1>
        <a class="mx-5 text-2xl text-blue-400 cursor-pointer text-white" href="{{route('todo.create')}}"><span class="fas fa-plus-circle"></span></a>
    </div>
    <ul class="my-5">
        <x-alert />
        @if($todos->count() > 0)
            @foreach($todos as $todo)
                <li class="flex justify-between p-2">
                    @include('todos.complete-button')
                    @if($todo->completed)
                    <p class="line-through">{{$todo->title}}</p>
                    @else
                    <a class="cursor-pointer" href="{{route('todo.show', $todo->id)}}">{{$todo->title}}</p>
                    @endif
                    <div>
                        <a href="{{route('todo.edit', $todo->id)}}" class="rounded cursor-pointer text-white"><span class="fas fa-pen text-yellow-500 px-2"></span></a>
                        
                        <span onclick="
                            event.preventDefault();
                            if(confirm('Are you really want to delete?')) {
                                document.getElementById('form-delete-{{$todo->id}}').submit()
                            }    
                        " class="fas fa-times text-red-500 px-2 cursor-pointer"></span>

                        <form style="display:none" id="{{'form-delete-'.$todo->id}}" action="{{route('todo.destroy', $todo->id)}}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                </li>
            @endforeach  
        @else
                <p>No task available, create new</p>
        @endif
    </ul>
@endsection