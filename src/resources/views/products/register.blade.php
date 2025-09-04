@extends('layouts.app')

@section('title', 'Product Registration')

@section('content')
    <h2>商品登録</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="contact-form__group contact-form__name-group">
            <label class="contact-form__label" for="name">商品名
                <span class="contact-form__required">必須</span>
            </label>
            <input class="contact-form__input contact-form__name-input" type="text" name="name" id="name"
            value="{{ old('name') }}" placeholder="商品名を入力">
            <p class="contact-form__error-message">
                @error('name')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="contact-form__group">
            <label class="contact-form__label" for="price">値段
                <span class="contact-form__required">必須</span>
            </label>
            <input class="contact-form__input" type="price" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力してください">
            <p class="contact-form__error-message">
                @error('price')
                {{ $message }}
                @enderror
            </p>
        </div>

        <form action="/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="contact-form__group">
            <label class="contact-form__label" for="image">商品画像      <span class="contact-form__required">必須</span>
                <input type="file" name="image">
                @if (!empty($filename))
                <img src="{{ asset('storage/images/fruits-img/' . $filename ??'') }}" alt="商品画像">
                @endif
            </label>
            <p class="contact-form__error-message">
                @error('image')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="contact-form__group">
            <label class="contact-form__label">季節
                <span class="contact-form__required">必須</span>
            </label>
            <lavel class="contact-form__choice">複数選択可</lavel>
            <div class="contact-form__season-option">
                <input type="checkbox" name="season[]" value="1" {{ in_array('1', old('season', [])) ? 'checked' : '' }}>
                <span class="contact-form__season-text">春</span>
            </div>
            <div class="contact-form__season-option">
                <input type="checkbox" name="season[]" value="2" {{ in_array('2', old('season', [])) ? 'checked' : '' }}>
                <span class="contact-form__season-text">夏</span>
            </div>
            <div class="contact-form__season-option">
                <input type="checkbox" name="season[]" value="3" {{ in_array('3', old('season', [])) ? 'checked' : '' }}>
                <span class="contact-form__season-text">秋</span>
            </div>
            <div class="contact-form__season-option">
                <input type="checkbox" name="season[]" value="4" {{ in_array('4', old('season', [])) ? 'checked' : '' }}>
                <span class="contact-form__season-text">冬</span>
            </div>
            <p class="contact-form__error-message">
                @error('season')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="contact-form__group">
            <label class="contact-form__label" for="description">商品説明
                <span class="contact-form__required">必須</span>
            </label>
            <textarea class="contact-form__textarea" name="description" id="" cols="30" rows="10"
          placeholder="商品説明を入力">{{ old('description') }}</textarea>
            <p class="contact-form__error-message">
            @error('description')
            {{ $message }}
            @enderror
            </p>
        </div>
        <div class="contact-form__btn-inner">
            <input class="contact-form__return-btn btn" type="submit" value="戻る" name="return">
            <input class="contact-form__register-btn" type="submit" value="登録" name="register">
        </div>
    </form>
@endsection
