@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/thanks.css') }}">
@endsection

@section('header')

 <div class="header__inner">
    <div class="header-utilities">
        <a  class="header__logo"  href="/">
        Thanks Form
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
      <div class="thanks__content">
         <div class="thanks__heading">
            <h2>お問い合わせありがとうございます</h2>
         </div>
      </div>

@endsection