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
       $todos =$user->todos;
       
        //$todos = Auth::user()->todos()->get(); うまく作動した
        //$todos = Todo::all();  ユーザー認証なし、全部見られる

        return view('todos.index',compact('todos', 'user'));
    }


    public function store(TodoRequest $request)
    {
        // $todo = $request->only(['content']);
       //Auth::user()->todos()->create($request->only('content'));

        

       // $todo = $request->only(['content']);

        //Todo::find($request->id)->update($todo);

        $todo = $request ->only(['content']);
        Todo::create($todo);

        return redirect('/')->with('message', 'Todoを作成しました');

    }

    public function update(TodoRequest $request)
    {
        Log::debug('受け取った ID: ' . $request->id); 
        
        $todo -> update($request->only('content'));
        Todo::find($request->id)->update($todo);
      
      
       if(!$todo) 
       {
        return redirect('/todos')->with('error', '指定されたTodoが見つかりません');
       } 

      return redirect('/todos')->with('message', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {

        Todo::find($request->id)->delete();

        return redirect('/todos')->with('message', 'Todoを削除しました');
    }
}