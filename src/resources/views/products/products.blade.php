@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('link')
<form action="/register" method="post">
  @csrf
  <input class="header__link" type="submit" value="">
</form>
@endsection

@section('content')

<div class="contact-form">
    <div class="contact-form__heading">
        <h2>商品一覧</h2>
    </div>
    <form action="/register" method="post">
        @csrf
        <input class="header__link" type="submit" value="+商品を追加">
    </form>
    <div class="form-group__content">
        <div class="form-input__text">
          <input type="text" name="name" placeholder="商品名で検索" value="{{ old('name') }}" />
        </div>
        <div class="form__error">
          @error('name')
          {{ $message }}
          @enderror
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">検索</button>
        </div>  

        <div class="contact-form__group">
            <h4>価格順で表示</h4>
            <select class="search-form__product-select" name="sort_order" id="">
                <option disabled selected>価格で並べ替え</option>
                <option value="desc" {{ old('sort_order') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                <option value="asc" {{ old('sort_order') == 'asc' ? 'selected' : '' }}>低い順に表示</option>
            </select>
            @if(request('sort_order') == 'desc')
            <div class="selected-tag">高い順に表示
                <span class="remove-tag">✕</span>
            </div>
            @elseif(request('sort_order') == 'asc')
            <div class="selected-tag">低い順に表示
                <span class="remove-tag">✕</span>
            </div>
            @endif
        </div>
        
@endsection