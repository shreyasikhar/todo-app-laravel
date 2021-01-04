<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Todo;
use App\Models\Step;

class TodoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        // $todos = auth()->user()->todos()->orderBy('completed', 'asc')->get();
        $todos = auth()->user()->todos->sortBy('completed');

        // $todos = Todo::orderBy('completed', 'asc')->get();    // for non logged-in users
        return view('todos.index')->with(['todos' => $todos]);
    }

    public function create() {
        return view('todos.create');
    }

    public function edit(Todo $todo) {
        // $todo = Todo::find($id);
        return view('todos.edit')->with(['todo' => $todo]);
    }

    public function update(TodoCreateRequest $request, Todo $todo) {
        $todo->update(['title' => $request->title, 'description' => $request->description]);
        if($request->stepName) {
            foreach($request->stepName as $key => $value) {
                $id = $request->stepId[$key];
                if(!$id) {
                    $todo->steps()->create(['name' => $value]);
                }
                else {
                    $step = Step::find($id);
                    $step->update(['name' => $value]);
                }
            }
        }
        return redirect(route('todo.index'))->with('message', 'Updated!');
    }

    public function complete(Todo $todo) {
        $todo->update(['completed' => true]);
        return redirect()->back()->with('message', 'Task marked as Completed');
    }

    public function incomplete(Todo $todo) {
        $todo->update(['completed' => false]);
        return redirect()->back()->with('message', 'Task marked as Not Completed');
    }

    public function destroy(Todo $todo) {
        // to delete steps
        $todo->steps->each->delete();
        // to delete todo
        $todo->delete();
        return redirect()->back()->with('message', 'Task Deleted');
    }
    
    public function show(Todo $todo)
    {
        return view('todos.show')->with(['todo' => $todo]);
    }

    public function store(TodoCreateRequest $request) {
        // $rules = [
        //     'title' => 'required|max:255'
        // ];
        // $messages = [
        //     'title.max' => 'Todo title should not be greater than 255 chars',
        //     'title.required' => 'Todo title is required'
        // ];
        // $validator = Validator::make($request->all(), $rules, $messages);
        // if($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // $request->validate([
        //     'title' => 'required|max:255'
        // ]);

        
        $todo = auth()->user()->todos()->create($request->all());
        if($request->step) {
            foreach($request->step as $step) {
                $todo->steps()->create(['name' => $step]);
            }
        }
        // $userId = auth()->id();
        // $request['user_id'] = $userId;
        // Todo::create($request->all());
        return redirect(route('todo.index'))->with('message', 'Todo created successfully');
    }
}
