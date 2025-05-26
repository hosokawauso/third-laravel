@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/contact.css') }}">
@endsection

@section('header')

 <div class="header__inner">
    <div class="header-utilities">
        <a  class="header__logo"  href="/">
        Contact Form
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
    <div class="contact-form__content">
        <div class="contact-form__heading">
            <h2>お問い合わせフォーム</h2>    
        </div>
        <form class="form" action="{{ route('contact.confirm') }}" method="post">
            @csrf
            <input type="hidden" name="contact_token" value="{{ $token }}"> 
            <div class="form__group">
                <div class="form__group--title">
                    <span class="form__label--item">お名前</span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="name" placeholder="テスト太郎" value="{{ old('name') }}">
                    </div>
                    <div class="form__error">
                        @error('name')
                        {{ $message }}
                        @enderror

                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group--title">
                    <span class="form__label--item">メールアドレス</span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                         <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}">
                    </div>
                    <div class="form__error">
                       @error('email')
                       {{ $message}}
                       @enderror
                       </div>
                 </div>
            </div>

            <div class="form__group">
                <div class="form__group--title">
                    <span class="form__label--item">電話番号</span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="tel" name="tel" placeholder="0123456789" value="{{ old('tel') }}" >
                    </div>
                    <div class="form__error">
                        @error('tel')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div> 

            <div class="form__group">
                <div class="form__group--title">
                    <span class="form__label--item">お問い合わせ内容</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--textarea">
                        <textarea name="content" placeholder="資料をいただきたいです。"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面へ</button>
            </div>
        </form>
    </div>

@endsection