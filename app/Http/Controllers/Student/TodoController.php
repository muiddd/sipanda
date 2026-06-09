<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return view('student.targetBelajar');
    }

    public function getTodos()
    {
        $todos = Todo::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($todos);
    }

    public function addTodo(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'tag' => 'required|string|in:Materi,Latihan,Penting',
        ]);

        $todo = Todo::create([
            'user_id' => auth()->id(),
            'text' => $request->text,
            'tag' => $request->tag,
            'done' => false,
        ]);

        return response()->json($todo);
    }

    public function toggleTodo($id)
    {
        $todo = Todo::where('user_id', auth()->id())->findOrFail($id);
        $todo->done = !$todo->done;
        $todo->save();

        return response()->json($todo);
    }

    public function deleteTodo($id)
    {
        $todo = Todo::where('user_id', auth()->id())->findOrFail($id);
        $todo->delete();

        return response()->json(['status' => 'success']);
    }
}
