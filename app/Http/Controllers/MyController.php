<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class MyController extends Controller
{
    public function index()
    {
        $todos = Todo::orderBy('created_at', 'desc')->get();
        return view('welcome', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:500'
        ]);

        Todo::create([
            'text' => $request->text,
            'completed' => false
        ]);

        return redirect()->back();
    }

    public function complete(Todo $todo)
    {
        $todo->update([
            'completed' => true,
            'completed_at' => now()
        ]);

        return redirect()->back();
    }

    public function undo(Todo $todo)
    {
        $todo->update([
            'completed' => false,
            'completed_at' => null
        ]);

        return redirect()->back();
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back();
    }
}