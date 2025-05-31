@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset ('css/mypage.css') }}" >
@endsection

@section('header')
<div class="header__inner">
    <div class="header-utilities">
        <a class="header__logo" href="/">
        {{ $user->name }}さんのページ
        </a>
        <nav>
           <ul class ="header-nav">
            @if (Auth::check())
             <li class="header-nav__item">
                <a class="header-nav__link" href="/mypage">マイページ</a>
             </li>
             <li class="header-nav__item">
                <form class="form" action="/logout" method="post">
                @csrf
                <button class="header-nav__button">ログアウト</button>
                </form>
             </li>
            @endif
           </ul>
        </nav>
    </div>
 </div>
@endsection

@section('content')
<div class="container">
    <h2 class=contents__tittle>コンテンツ</h2>
</div>

<ul class="list-nav">
    <li class="list-nav__item">
        <a href="{{ route('todos.index') }}">Todoリスト</a></li>
    <li class="list-nav__item">
        <a href="{{ route('diary.index') }}">日記</a></li>
    <li class="list-nav__item">
        <a href="{{ route('contact.contact') }}">お問い合わせフォーム</a>
    </li>
    <li class="list-nav__item" >
        <a href="{{ route('quiz.show') }}">Status Quiz</a>
    </li>
</ul>



@endsection



