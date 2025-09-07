@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/search.css')}}">
@endsection

@section('title', 'Product Search')

@section('content')
<div class="search-contact>
  <h2>商品検索</h2>

    <form class="search-form" action="{{ route('products.search') }}" method="GET">
      <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名を入力" class="search-input">
      <button type="submit" class="search-button">検索</button>
    </form>

    @if ($errors->any())
    <div class="error-box">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    @if(isset($keyword))
      <h3>“{{ $keyword }}”の商品一覧</h3>
    @endif

    <form method="GET" action="{{ route('products.search') }}" class="sort-form">
      <input type="hidden" name="keyword" value="{{ request('keyword') }}">
        <select name="sort" onchange="this.form.submit()" class="sort-select">
          <option value="">並び替え</option>
          <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>価格が安い順</option>
          <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>価格が高い順</option>
        </select>
    </form>

    <div class="product-grid">
      @forelse ($products as $product)
        <div class="product-card">
          <img src="{{ asset('storage/images/fruits-img/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
            <div class="product-info">
              <p class="product-name">{{ $product->name }}</p>
              <p class="product-price">¥{{ number_format($product->price) }}</p>
            </div>
        </div>
      @empty
        <p>該当する商品が見つかりませんでした。</p>
      @endforelse
    </div>

    <div class="pagination">
      {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection
