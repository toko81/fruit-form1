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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>商品一覧</h2>
        <a href="{{ route('products.create') }}" class="btn btn-success">+ 商品を追加</a>
    </div>
    <form action="{{ route('products.index') }}" method="get" class="mb-3 d-flex gap-2">
    @csrf
    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名で検索" class="form-control w-25">
        <button type="submit" class="btn btn-primary">検索</button>
        <select name="sort" onchange="this.form.submit()" class="form-select w-25">
            <option value="">価格順で表示</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>安い順に表示</option>
            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
        </select>
    </form>

    @if(request('sort'))
    <div class="mb-3">
        <span class="badge bg-info text-dark">
            並び替え: {{ request('sort') == 'asc' ? '安い順に表示' : '高い順に表示' }}
            <a href="{{ route('products.index', array_merge(request()->except('sort'))) }}" class="text-decoration-none text-dark ms-2">×</a>
        </span>
    </div>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($products as $product)
        <div class="col">
            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">¥{{ number_format($product->price) }}</p>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <p>該当する商品が見つかりませんでした。</p>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>        
        
@endsection