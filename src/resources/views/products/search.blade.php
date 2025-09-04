@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/search.css')}}">
@endsection

@section('title', 'Product Search')

@section('content')
    <h2>商品一覧</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="contact-form__inner">
    <form action="{{ route('products.search') }}" method="GET">
        @csrf

        <div class="contact-form__group contact-form__name-group">
            <label class="contact-form__label" for="name">商品名
          </label>
          <input class="contact-form__input contact-form__name-input" type="text" name="name" id="name"
            value="{{ old('name') }}" placeholder="商品名を入力">
        </div>
        <div class="contact-form__error-message">
          @if ($errors->has('first_name'))
          <p class="contact-form__error-message-first-name">{{$errors->first('first_name')}}</p>
          @endif
          @if ($errors->has('last_name'))
          <p class="contact-form__error-message-last-name">{{$errors->first('last_name')}}</p>
          @endif
        </div>
      </div>
        <tr class="confirm-form__row">
          <th class="confirm-form__label">メールアドレス</th>
          <td class="confirm-form__data">{{ $contacts['email'] }}</td>
          <input type="hidden" name="email" value="{{ $contacts['email'] }}">
        </tr>

        <label>商品名</label>
        <input type="text" name="name" value="{{ old('name') }}">

        <label>値段</label>
        <input type="number" name="price" value="{{ old('price') }}" min="0" max="100000">

        <label>Grade</label><br>
        <input type="radio" name="grade" value="elementary"> Elementary
        <input type="radio" name="grade" value="middle"> Middle
        <input type="radio" name="grade" value="high"> High

        <label>Product Description (max 120 characters)</label>
        <textarea name="description" maxlength="120">{{ old('description') }}</textarea>

        <button type="submit">Search</button>
        <a href="{{ route('products.index') }}">Back</a>
    </form>
@endsection
