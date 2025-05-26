@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/confirm.css') }}">
@endsection

@section('header')

 <div class="header__inner">
    <div class="header-utilities">
        <a  class="header__logo"  href="/">
        Confirm Form
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
        <div class="confirm__content">
          <div class ="confirm__heading">
            <h2>お問い合わせ内容確認</h2>
          </div>
          <form class="form" action="{{ route('contact.thanks.post' )}}" method="post">
              @csrf
              <input type="hidden" name="contact_token" value="{{ $token }}">
              <div class="confirm-table">
                <table class="confirm-table__inner">
                  <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                      {{ $contact['name'] }}
                      <input type="hidden" name="name" value="{{ $contact['name'] }}">
                    </td>
                  </tr>
                  <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                      {{ $contact['email'] }}
                      <input type="hidden" name="email" value="{{ $contact['email'] }}">
                    </td>
                  </tr>
                  <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                      {{ $contact['tel'] }}
                      <input type="hidden" name="tel" value="{{ $contact['tel'] }}" >
                    </td>
                  </tr> 
                  <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                      {{ $contact['content'] }}
                      <input type="hidden" name="content" value="{{ $contact['content'] }}" >
                    </td>
                  </tr>
                </table>
           </div>

           <div class="form-button">
            <button class="form__button-submit" type="submit">送信</button>
           </div>
          </form>
        </div>
@endsection