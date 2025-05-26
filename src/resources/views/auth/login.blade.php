@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header')
<div class="header__inner">
  <div class="header-utilities">
      <a class="header__logo" href="/">
      Attendance Management
      </a>
@endsection

@section('content')
<div class="login-form__content">
  <div class="login-form__heading">
    <h2>ログイン</h2>
  </div>
  <form class="form" action="/login" method="post">
    @csrf
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">メールアドレス</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="email" name="email" value="{{ old('email') }}" />
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">パスワード</span>
      </div>
      <div class="form__group-content" style="position: relative;">
        <div class="form__input--text">
          <input type="password" name="password" id="password" />   {{-- id="password"を追加して目のマークをいれる準備 --}}

          <span id="togglePassword"
            style="position: absolute; right: 10px; top: 30%; transform: translateY(-50%); cursor: pointer;">
        👁
      </span>

        </div>
        <div class="form__error">
          @error('password')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__button">
      <button class="form__button-submit" type="submit">ログイン</button>
    </div>
  </form>
  <div class="register__link">
    <a class="register__button-submit" href="/register">会員登録の方はこちら</a>
  </div>
</div>
@endsection

@section('script')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.textContent = type === 'password' ? '👁' : '🙈';
    });
  });
</script>

@endsection
