@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset ('css/index.css') }}" >
@endsection

@section('header')
<div class="header__inner">
    <div class="header-utilities">
        <a class="header__logo" href="/todos">
        {{ $user->name ?? 'ゲスト' }} さんのTodoリスト
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
<div class="todo__alert">

  @if(session('message'))
  <div class="todo__alert--success">
        {{ session('message') }}
  </div>
  @endif

  @if ($errors->any())
    <div class="todo__alert--danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
</div>

<div class="todo__content">
    <form class="create-form" action="{{ route('todos.store') }}"  method="post">
        @csrf
      <div class="create-form__item">
        <input class="create-form__item-input" type="text" name='content' />
      </div>
      <div class="create-form__button">
        <button class="create-form__button-submit" type="submit">作成</button>
      </div>
    </form>

    <div class="todo-table">
        <table class="todo-table__inner">            
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
            </tr>
            @foreach($todos as $todo)
            <tr class="todo-table__row">                
                <td class="todo-table__item">
                    <form class="update-form" action="{{ route('todos.update') }}" method="post" >
                    @method('PATCH')
                    @csrf
                        <div class="update-form__item">
                            <input class="update-form__item-input" type="text" name="content"  value="{{ old('content', $todo['content']) }}">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button-submit">更新</button>
                        </div>
                    </form>
                </td>

                <td class="todo-table__item">
                    <form class="delete-form" action="{{ route('todos.destroy') }}"  method="post">
                    @method('DELETE')
                    @csrf
                        <div class="delete-form__button">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>
                    </form>                
                </td>            
            </tr>
            @endforeach
        </table>

    </div>
  </div>
</div>
@endsection
