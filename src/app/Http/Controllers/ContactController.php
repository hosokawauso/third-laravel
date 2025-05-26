<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact() {

        //一意のトークンを作る
        // 64文字のランダム文字列 bin2hex()は人間が読めるように16進数(0~9,a~f)に変化する関数
        //random_bytes()は24から32までの数字を引数にしています。
        $token = bin2hex(random_bytes(32));         
        session(['contact_token' => $token]); // セッションに保存

        return view('contact.contact', compact('token'));

    }

    public function confirm(ContactRequest $request) {

        $contact = $request -> only(['name','email','tel', 'content']);
        $token = $request->input('contact_token'); // トークンを取得して渡す
        
        return view('contact.confirm', compact('contact', 'token'));
    }

    public function thanks(ContactRequest $request) {


        $token = $request->input('contact_token');
        $sessionToken = session('contact_token');

        // トークンが一致しない or すでに使われていたら拒否
        if(!$token || $token !== $sessionToken) {

            return redirect()->route('contact.contact')->withErrors(['form' => '無効な送信です']);
        }

        //登録処理
        $contact = $request -> only(['name', 'email', 'tel', 'content']);
        Contact::create($contact);


         // トークンを破棄して二重送信を防止
        session()->forget('contact_token');

        // 完了画面へ
        return redirect()->route('contact.thanks')->with('message', 'お問い合わせありがとうございました。');
    }

    public function showThanks() {
        return view('contact.thanks');
    }

    
}

