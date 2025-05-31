@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/result.css') }}">
@endsection

@section('header')
<div class="header__inner">
    <div class="header-utilities">
        <a  class="header__logo"  href="/">
        Result
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
<div class="result__content">
    <div class="result">
        @if($isCorrect)
        <h2 class="result__text--correct">正解</h2>
        @else
        <h2 class="result__text--incorrect">不正解</h2>
        @endif
    </div>

    <div class="answer-table">
        <table class="answer-table__inner">
            <tr class="answer-table__row">
                <th class="answer-table__header">あなたの回答</th>
                <td class="answer-table__text">{{ $selected_code }}</td>
            </tr>
            <tr class="answer-table__row">
                <th class="answer-table__header">正解のステータスコード</th>
                <td class="answer-table__text">{{ $correctStatus['code'] }}</td>
            </tr>
            <tr class="answer-table__row">
                <th class="answer-table__header">意味</th>
                <td class="answer-table__text">{{ $correctStatus['meaning'] }}</td>
            </tr>
            <tr class="answer-table__row">
                <th class="answer-table__header">説明</th>
                <td class="answer-table__text">{{ $correctStatus['description'] }}</td>
            </tr>
        </table>
    </div>

    <div class="result__action">
        <a href="{{ route('quiz.show') }}" class="result__retry-button">もう一度挑戦する</a>
    </div>
</div>
@endsection