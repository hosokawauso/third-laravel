@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/quiz.css') }}">
@endsection

@section('header')
<div class="header__inner">
    <div class="header-utilities">
        <a  class="header__logo"  href="/">
        Status Quiz 
        </a>
        <nav>
            <ul class="header-nav">
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
<div class="quiz__content">
    <div class="question">
        <p class="question__text">Q.以下の内容に当てはまるステータスコードを選んでください</p>
        <p class="question__text">{{ $question }} </p>
    </div>
    <form class="quiz-form" action="{{ route('quiz.check') }}" method="post">
    @csrf
      {{-- 正解のコード（hiddenで送信 --}}
      <input type="hidden" name="correct_code" value="{{ $correct_code }}">

       @foreach($choices as $index => $choice)
         <div class="quiz-form__item">
           <div class="quiz-form__group">
            <input class="quiz-form__radio" id="choice_{{ $index }}" type="radio" name="selected_code" value="{{ $choice['code'] }}" required>
            <label class="quiz-form__label" for="choice_{{ $index }}">
              {{$choice['code'] }} {{--  - {{$choice['meaning'] }} --}}
            </label>
           </div>
         </div>
        @endforeach

        <div class="quiz-form__button">
            <button class="quiz-form__button-submit" type="submit">
                回答
            </button>
        </div>     
    </form>
</div>
@endsection

