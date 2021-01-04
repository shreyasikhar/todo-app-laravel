@if($todo->completed)
<span onclick="event.preventDefault();document.getElementById('form-incomplete-{{$todo->id}}').submit()" class="fas fa-check text-green-400 px-2 cursor-pointer"></span>

<form style="display:none" id="{{'form-incomplete-'.$todo->id}}" action="{{route('todo.incomplete', $todo->id)}}" method="post">
    @csrf
    @method('put')
</form>

@else
<span onclick="event.preventDefault();document.getElementById('form-complete-{{$todo->id}}').submit()" class="fas fa-check text-gray-300 px-2 cursor-pointer"></span>

<form style="display:none" id="{{'form-complete-'.$todo->id}}" action="{{route('todo.complete', $todo->id)}}" method="post">
    @csrf
    @method('put')
</form>

@endif