@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/productld.css') }}">
@endsection

@section('link')
<form action="/register" method="post">
  @csrf
  <input class="header__link" type="submit" value="">
</form>
@endsection

@section('content')
<div class="detail__content">
    <h2>商品画像の登録</h2>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="name">商品名:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="description">商品説明:</label>
        <textarea name="description" id="description" required>{{ old('description') }}</textarea>

        <label for="image">画像ファイル:</label>
        <input type="file" name="image" id="image" accept="image/*" required>

        <button type="submit">変更を保存</button>
        <a href="{{ route('products.index') }}" class="back-button">戻る</a>
    </form>

    @if (isset($product) && $product->image)
        <div class="image-preview">
            <p>登録済み画像:</p>
            <img src="{{ asset('storage/images/fruits-img/' . $product->image) }}" alt="商品画像">
        </div>
    @endif
</div>
@endsection

    <div class="detail-cards">
        <div class="detail-card">
            <div class="detail-card__img-wrapper">
                <img class="detail-card__img" src="img/" alt="果物" >
            </div>
            <div class="detail-card__body">
                <p class="detail-card__fruit"></p>
                <p class="detail-card__price"></p>
            </div>
        </div>
        
    </div>
</div>