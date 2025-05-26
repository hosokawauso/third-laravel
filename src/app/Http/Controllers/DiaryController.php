<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DiaryRequest;
use App\Models\Diary;

class DiaryController extends Controller
{
    public function index ()
    {
        $user=Auth::user();
        $diary = Diary::where('user_id', $user->id)->latest()->first();

        return view('diary.index', compact('user', 'diary'));
    }
    
    public function store(DiaryRequest $request)
    {       
        $data = $request -> only(['title', 'body']);
        $data['user_id'] = auth()->id();

        //画像保存がある場合
        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image_path'] = $path;
            
        }

        $diary = Diary::create($data);

        return redirect()->route('diary.index')->with([
            'path' => $diary->image_path,
            'title' => $diary->title,
            'body' => $diary->body,
        ]);
    }

}
