<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
       $user = Auth::user();
       $todos = $user->todos()->get();
       
        //$todos = Auth::user()->todos()->get(); うまく作動した
        //$todos = Todo::all();  ユーザー認証なし、全部見られる

        return view('todos.index',compact('todos','user'));
    }


    public function store(TodoRequest $request)
    {
       $todo = $request->only(['content']);
       Auth::user()->todos()->create($request->only('content'));

        return redirect('/todos')->with('message', 'Todoを作成しました');
    }

    public function update(TodoRequest $request)
    {
        $todo = Todo::find($request->id);
      
      
       if(!$todo) 
       {
        return redirect('/')->with('error', '指定されたTodoが見つかりません');
       } 

       $todo->update($request->only('content'));

      return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {

        Todo::find($request->id)->delete();

        return redirect('/')->with('message', 'Todoを削除しました');
    }
}