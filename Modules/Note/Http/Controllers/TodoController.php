<?php

namespace Modules\Note\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Note\Entities\Todo;
use App\User;

class TodoController extends Controller
{

    public function index()
    {
        $todos = Todo::where('user_id', auth()->id())->first();
        if (!$todos) {
            $todos = Todo::create([
                'user_id' => auth()->id(),
                'todo' => '[]'
            ]);
        }
        return resHandel(['todos' => $todos->todo]);
    }


    public function update(Request $request)
    {
        $todo = Todo::where('user_id', auth()->id())->first();
        $todo->update(['todo' => $request->todos]);
        return resHandel();
    }
}
