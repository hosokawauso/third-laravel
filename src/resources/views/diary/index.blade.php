@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/diary.css') }}">
@endsection

@section('header')
<div class="header__inner">
    <div class="header-utilities">
        <a class="header__logo" href="/diary">
           日記
        </a>
        <nav>
            <ul class ="header-nav">
            @if(Auth::check())
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
<form class="document-form" action="{{ route('diary.store') }}" method="post" enctype="multipart/form-data">
@csrf
  <div class="document-form__title">
     <input  type="text" name="title" placeholder="タイトル"><br>
     <textarea class="document-form__body" name="body" placeholder="本文"></textarea><br>
     <label>画像を選択</label>
    <input type="file" name="image" accept="image/*">
  </div>
  <div>
    <button class="image-upload" type="submit">アップロード</button>
  </div>
</form>


@if(session('title'))
 <p class="document-form__title--label">タイトル:{{ session('title') }}</p>
@endif

@if(session('body'))
 <p class="document-form__body--label">本文:{{ session('body') }}</p>
@endif

@if(session('path'))
 <p>アップロードされた画像:</p>
 <img src="{{ asset('storage/' .session('path')) }}" width="300">
@endif

@endsection